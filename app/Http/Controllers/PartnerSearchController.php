<?php

namespace App\Http\Controllers;

use App\Lead;
use App\LeadPartnerPair;
use App\Partner;
use App\PartnerSearch;
use Illuminate\Http\Request;
use App\RandomString;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PartnerSearchController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if((auth()->user()->role == 1) || (auth()->user()->role == 3)){
                return $next($request);
            }else{
                return Redirect::back();
            }
        });
    }

    public function createPartnerSearchAction($id){

        $input = new Request();
        $input['leadID'] = $id;
        $input = $input->all();
        $validator = Validator::make($input, [
            'leadID'         => ['required', 'exists:leads,lead_id'],
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->all();
            return Redirect::back()->withErrors($errorMessage);
        }

        $currentPartnerSearch = PartnerSearch::where('lead_id', $id)->first();
        if(isset($currentPartnerSearch)){
            $currentPartnerSearch->delete();
        }
        $leadDetails = Lead::where('lead_id', $id)->first();
        //if($leadDetails->worldwide == 0){
            $newPartner = PartnerSearch::create([
                'search_id' => RandomString::generate(),
                'lead_id'   => $input['leadID']
            ]);
            $leadDetails->status = 3;
            $leadDetails->save();
            return Redirect::back()->with('status', 'Partner search action has been requested successfully.');
        //}


    }

    public function finishAction($id){
        $currentPartnerSearch = PartnerSearch::find($id);

        if(is_null($currentPartnerSearch)){
            return Redirect::back()->withErrors('Partner search action not found. Please try again.');
        }

        $currentLead = Lead::where('lead_id', $currentPartnerSearch->lead_id)->first();
     
        if(is_null($currentLead)){
            return Redirect::back()->withErrors('Lead not found. Please try again.');
        }
        $currentLead->status = 2; //Partner Searched
        $currentLead->save();
        $currentPartnerSearch->delete();
        return redirect()->back()->with('status', 'Partner search action has been completed successfully.');
    }

    public function partnerSearchRequest(){

        $allPartnerSearchData = PartnerSearch::all();
        $allLeadIDs = array();

        foreach($allPartnerSearchData as $searchData){
            array_push($allLeadIDs, $searchData->lead_id);
        }

        $getAllLeadData = Lead::whereIn('lead_id', $allLeadIDs)->get();
        $partnerCount = array();


        foreach($getAllLeadData as $lead){
            if($lead->worldwide == 1){
                $leadTags = strtolower($lead->tags);
                $partnerCountTemp = 0;
                foreach(explode(',',$leadTags) as $currentLeadTag){
                    $trimmedTag = trim($currentLeadTag);
                    $matchThese = ['block_status' => 0];

                    $partnerCountTemp = $partnerCountTemp + count(Partner::query()
                                                                            ->where($matchThese)
                                                                            ->where('tags', 'LIKE', '%'. $trimmedTag .'%')
                                                                            ->get());
                }
                array_push($partnerCount, $partnerCountTemp);
            }else{
                $partnerCountTemp = 0;
                $matchThese = array('block_status' => 0);
                if(isset($lead->city)){
                    $currentLeadCity = trim($lead->city);
                    if($currentLeadCity != ''){
                        $matchThese['city'] = $currentLeadCity;
                    }
                }
                $matchThese['country'] = $lead->country;

                $leadTags = strtolower($lead->tags);

                foreach(explode(',',$leadTags) as $currentLeadTag){
                    $trimmedTag = trim($currentLeadTag);
                    $partnerCountTemp = $partnerCountTemp + count(Partner::query()
                                                                            ->where($matchThese)
                                                                            ->where('tags', 'LIKE', '%'. $trimmedTag .'%')
                                                                            ->get());

                }


                array_push($partnerCount, $partnerCountTemp);
            }


            //array_push($partnerCount, count(LeadPartnerPair::where('lead_id', $lead->lead_id)->get()));
        }


        return view('admin.managePartnerSearchRequest')->with([
            'partnerSearchData' => $allPartnerSearchData,
            'leadData'          => $getAllLeadData,
            'partnerCount'      => $partnerCount
        ]);
    }

}
