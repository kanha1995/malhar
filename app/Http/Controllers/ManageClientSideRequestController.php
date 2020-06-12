<?php

namespace App\Http\Controllers;
use App\CountryList;
use App\Lead;
use App\LeadPartnerPair;
use App\Mail\ProjectSendEmail;
use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ManageClientSideRequestController extends Controller
{
    public function index(Request $request){

        $messageStatus = '';
        $requetValue = $request->all();
        $action = '';
        if(md5(base64_encode('yes')) == $request['action_id']){
            $action = 'yes';
        }elseif(md5(base64_encode('no')) == $request['action_id']){
            $action = 'no';
        }elseif(md5(base64_encode('stop')) == $request['action_id']){
            $action = 'stop';
        }
        $lead_id = base64_decode($requetValue['lead_id']);
        $partner_id = base64_decode($requetValue['partner_id']);
        $partner_details = Partner::where('partner_id', $partner_id)->first();

        $currentRecord = LeadPartnerPair::where('partner_id', $partner_id)->where('lead_id', $lead_id)->first();

        if($action == 'stop'){
            $partner_details->block_status = 1;
            $partner_details->save();
            if(!is_null($currentRecord)){
                $currentRecord->delete();
            }

            $messageStatus = 'Thank you for your response. We will not disturb you again.';
        }elseif($action == 'no'){
            if(!is_null($currentRecord)){
                $currentRecord->delete();
            }
            $messageStatus = 'Thank you for your response.';
        }
        elseif($action == 'yes'){

            $currentLeadDetails = Lead::where('lead_id', $lead_id)->first();
            $currentLeadDetails->status = 5;
	    if(is_null($currentRecord)){
                $messageStatus = 'Sorry! You have already choosen an option.';
                return view('admin.clientsidepage')->with(['messageStatus'=> $messageStatus]);
            }
            $currentRecord->status = 2;
            $currentRecord->save();
            $currentLeadDetails->save();
            $messageStatus = 'Thank you for your response. We will shortly introduce you with your lead.';

            $partnerCountryRequest = new Request();
            $partnerCountryRequest['country_id'] = $partner_details->country;
            $partnerCountry = CountryList::getCountryDetails($partnerCountryRequest)->value;
            $partnerAddress = $partnerCountry;
            if(isset($partner_details->city)){
                $partnerAddress = $partner_details->city . ", " . $partnerCountry;
            }
            //Mail send
            $partnerName = $partner_details->name;
            $partnerEmail = $partner_details->email;
            $details = ["partnerName" => $partnerName,
                        "partnerEmail" => $partnerEmail,
                        'leadName' => $currentLeadDetails->name,
                        "leadRequirement" => $currentLeadDetails->requirement ?? 'N/A',
                        "partnerAddress" => $partnerAddress,
                        "subject" => 'MALHAR INFOWAY: New requirement'
                    ];


           
 	    $emailTo = [['email' => $partnerEmail, 'name' => $partnerName],
                        ['email' => $currentLeadDetails->email, 'name' => $currentLeadDetails->name]];
            Mail::to($emailTo)->send(new ProjectSendEmail($details));

        }

        return view('admin.clientsidepage')->with(['messageStatus'=> $messageStatus]);
    }

}
