<?php

namespace App\Http\Controllers;

use App\CountryList;
use App\Lead;
use App\LeadPartnerPair;
use App\Mail\LeadSendEmail;
use App\Partner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeadPartnerPairController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if((auth()->user()->role == 1) || (auth()->user()->role == 2)){
                return $next($request);
            }else{
                return Redirect::back();
            }
        });
    }

    public function manageLeadPartnerPair(){

        $leadPartnerPairs = DB::table('lead_partner_pairs')->get();

        $leadList = array();
        $partnerList = array();
        $leadPartnerStatus = array();

        foreach($leadPartnerPairs as $leadPartner){
            $currentPartnerDetails = DB::table('partners')->where('partner_id', $leadPartner->partner_id)->first();
            if(isset($currentPartnerDetails)){

                $currentLeadDetails    = DB::table('leads')->where('lead_id', $leadPartner->lead_id)->first();
                if(isset($currentLeadDetails)){
                    array_push($partnerList, $currentPartnerDetails);
                    array_push($leadList, $currentLeadDetails);
                    array_push($leadPartnerStatus, $leadPartner->status);
                }
            }
        }
// dd($partnerList, $leadList);
        if((count($leadList) == 0) || (count($partnerList) == 0)){
            $leadList = array();
            $partnerList = array();
        }
        return view('lead-partner.manageLeadPartner')->with([
            'partners' => $partnerList,
            'leads' => $leadList,
            'status' => $leadPartnerStatus
            ]);
    }

    public function createLeadPartnerPair($id){

        $currentLead = Lead::find($id);
        $matchThese = ['lead_id' => $currentLead->lead_id, 'status' => 1];
        $clearSearches = LeadPartnerPair::where($matchThese)->get();

        foreach ($clearSearches as $search) {
            $search->delete();
        }
        if(!isset($currentLead)){
            return Redirect::back()->withErrors('Lead not found. Please try again.');
        }

        $partnerList = Partner::all();
        if(count($partnerList) == 0){
            return Redirect::back()->withErrors('No partners found. Please try again.');
        }

        if($currentLead->worldwide == 1){
            $leadTags = strtolower($currentLead->tags);
            $partnerCountTemp = 0;
            foreach(explode(',',$leadTags) as $currentLeadTag){
                $trimmedTag = trim($currentLeadTag);
                $matchThese = ['block_status' => 0];
                $getMathchedPartners = (Partner::query()
                                                    ->where($matchThese)
                                                    ->where('tags', 'LIKE', '%'. $trimmedTag .'%')
                                                    ->get());
                foreach($getMathchedPartners as $finalMatchedPartner){
		            $matchThese = ['partner_id' => $finalMatchedPartner->partner_id, 'lead_id' => $currentLead->lead_id];
                    $partnerData = LeadPartnerPair::where($matchThese)->first();
                    if(is_null($partnerData)){
                        $newPair = LeadPartnerPair::create([
                            'lead_id' => $currentLead->lead_id,
                            'partner_id' => $finalMatchedPartner->partner_id,
                            'status' => 1
                        ]);
                    }
                }
            }
            // array_push($partnerCount, $partnerCountTemp);
        }else{
            $partnerCountTemp = 0;
            $matchThese = array('block_status' => 0);
            if(isset($currentLead->city)){
                $currentLeadCity = trim($currentLead->city);
                if($currentLeadCity != ''){
                    $matchThese['city'] = $currentLeadCity;
                }
            }
            $matchThese['country'] = $currentLead->country;

            $leadTags = strtolower($currentLead->tags);

            foreach(explode(',',$leadTags) as $currentLeadTag){
                $trimmedTag = trim($currentLeadTag);
                $getMathchedPartners =  (Partner::query()
                                                        ->where($matchThese)
                                                        ->where('tags', 'LIKE', '%'. $trimmedTag .'%')
                                                        ->get());
            }
            foreach($getMathchedPartners as $finalMatchedPartner){
                $matchThese = ['partner_id' => $finalMatchedPartner->partner_id, 'lead_id' => $currentLead->lead_id];
                $partnerData = LeadPartnerPair::where($matchThese)->first();
                if(is_null($partnerData)){
                    $newPair = LeadPartnerPair::create([
                        'lead_id' => $currentLead->lead_id,
                        'partner_id' => $finalMatchedPartner->partner_id,
                        'status' => 1
                    ]);
                }
            }
        }


        $resultCount = count(LeadPartnerPair::where('lead_id', $currentLead->lead_id)->get());
        if($resultCount == 0){
            return Redirect::back()->with('status', 'No '. ' results found.');
        }
        return Redirect::back()->with('status', $resultCount. ' result(s) found.');
    }

    public function deleteLeadPartner($id){

        $currentLeadPartnerPair = LeadPartnerPair::where('partner_id', $id)->first();
        if(!(isset($currentLeadPartnerPair))){
            return Redirect::back()->withErrors('Invalid request. Please try again.');
        }else{
            $currentLeadPartnerPair->delete();
            return Redirect::back()->with('status', 'Record has been deleted successfully.');
        }
    }

    public function sendEmails(Request $request){

        $emailData = json_decode($request['emailData']);

        for ($index=0; $index < count($emailData); $index++) {
            $partnerName = $emailData[$index]->name;
            $partnerEmail = $emailData[$index]->email;
            $partnerId = $emailData[$index]->partnerId;
            $leadId = $emailData[$index]->leadId;
            $leadDetails = Lead::where('lead_id', $leadId)->first();
            $partnerDetails = Partner::where('partner_id', $partnerId)->first();

            $leadCountryRequest = new Request();
            $leadCountryRequest['country_id'] = $leadDetails->country;
            $leadCountry = CountryList::getCountryDetails($leadCountryRequest)->value;

            if(isset($leadDetails->city)){
                $leadCountry = $leadDetails->city . ', '. $leadCountry;
            }
            $partnerPercent = '15';
            $partnerCountries = ['IN', 'BD', 'LK', 'VN', 'ID'];
            if(in_array($partnerDetails->country, $partnerCountries)){
                $partnerPercent = '20';
            }

            $details = ["partnerName" => $partnerName,
                        "partnerEmail" => $partnerEmail,
                        "partnerId" => $partnerId,
                        'leadId' => $leadId,
                        'leadRequirement' => $leadDetails->requirement ?? 'N/A',
                        'leadAddress' => $leadCountry,
                        'partnerPercent' => $partnerPercent,
                        'initialRequirement' => $leadDetails->initial_requirement ?? 'N/A',
                        "subject" => 'MALHAR INFOWAY: New requirement'
                    ];

            Mail::to($partnerEmail, $partnerName)->queue(new LeadSendEmail($details));

            $getAllPairs = LeadPartnerPair::
                                    where('lead_id', $leadId)
                                    ->where('partner_id', $partnerId)
                                    ->get();
            foreach($getAllPairs as $currentPair){
                $currentPair->status = 3;
                $currentPair->save();
            }

        }
        return Redirect::back()->with('status', 'Email sent successfully.');
    }
}
