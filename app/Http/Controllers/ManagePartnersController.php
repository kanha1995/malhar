<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CountryList;
use App\LeadPartnerPair;
use App\Mail\ContactPartner;
use App\Partner;
use App\RandomString;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ManagePartnersController extends Controller
{

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

    //
    public function addPartner(){
        return view('admin.addPartner')->with([
            'countryData' => CountryList::getCountryList()
        ]);
    }

    public function index(Request $request){

        $allUsers = DB::table('partners')->get();
        return view('admin.managePartners')->with(['users' => $allUsers]);
    }

    public function getPartnerDetails($id){

        $user = Partner::find($id);
        return view('admin.addPartner')->with([
            'countryData' => CountryList::getCountryList(),
            'user' => $user
        ]);
    }

    public function updatePartnerDetails(Request $request){


        $input = $request->all();
        $validator = Validator::make($input, [
            'name'          => ['required', 'string', 'max:255'],
            'phone'         => ['nullable', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'partnerType'   => ['required', Rule::in(['1', '2', '3'])],
            'city'          => ['nullable', 'string'],
            'country'       => ['required', 'string'],
            'linkedin'      => ['url', 'nullable'],
            'facebook'      => ['url', 'nullable'],
            'fiverr'        => ['url', 'nullable'],
            'twitter'       => ['url', 'nullable'],
            'c2c'           => ['boolean'],
            'teamSize'      => ['nullable', 'numeric'],
            'tags'          => ['nullable', 'string'],
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->all();
            return Redirect::back()->withErrors($errorMessage);
        }
        $currentPartner = Partner::find($input['id']);
        $currentPartner->name = $input['name'];
        $currentPartner->phone = $input['phone'];
        $currentPartner->type = $input['partnerType'];
        $currentPartner->city = $input['city'];
        $currentPartner->country = $input['country'];
        $currentPartner->linked_in = $input['linkedin'];
        $currentPartner->fb = $input['facebook'];
        $currentPartner->fiverr = $input['fiverr'];
        $currentPartner->twitter = $input['twitter'];
        $currentPartner->c2c = $input['c2c'];
        $currentPartner->team_size = $input['teamSize'];
        $currentPartner->tags = $input['tags'];
        $currentPartner->save();
        return Redirect::back();

    }

    public function previewPartner($id){

        $user = Partner::find($id);
        $countryRequest = new Request();
        $countryRequest['country_id'] = $user->country;
        $country = CountryList::getCountryDetails($countryRequest)->value;

        return view('admin.previewPartner')->with([
            'user' => $user,
            'countryData' => CountryList::getCountryList(),
            'country'=>$country]);
    }

    public function deletePartner($id){
        $currentPartner = Partner::find($id);
        if(!(isset($currentPartner))){
            return Redirect::back()->withErrors('Partner not found. Please try again.');
        }else{
            $currentLeadPartnerPair = LeadPartnerPair::where('partner_id', $currentPartner->partner_id);
            $currentLeadPartnerPair->delete();
            $currentPartner->delete();
            return Redirect::back()->with('status', 'Partner has been deleted successfully.');
        }
    }

    public function createPartner(Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:partners'],
            'phone'         => ['regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'nullable'],
            'partnerType'   => ['required', Rule::in(['1', '2', '3'])],
            'city'          => ['string', 'nullable'],
            'country'       => ['required', 'string'],
            'linkedin'      => ['url', 'nullable'],
            'facebook'      => ['url', 'nullable'],
            'fiverr'        => ['url', 'nullable'],
            'twitter'       => ['url', 'nullable'],
            'c2c'           => ['boolean'],
            'teamSize'      => ['numeric', 'nullable'],
            'tags'          => ['string', 'nullable'],
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->all();
            return Redirect::back()->withErrors($errorMessage);
        }

        $newPartner = Partner::create([
            'partner_id' => 'P' . RandomString::generate(),
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'city' => $input['city'],
            'country' => $input['country'],
            'type'  => $input['partnerType'],
            'linked_in' => $input['linkedin'],
            'fb' => $input['facebook'],
            'fiverr' => $input['fiverr'],
            'twitter' => $input['twitter'],
            'c2c' => $input['c2c'],
            'team_size' => $input['teamSize'],
            'tags' => $input['tags']
        ]);
        //Send Email
        return redirect()->route('managePartners');
    }

    public function emailPartner(Request $request){

        return view('admin.emailPartner');
    }

    public function sendEmails(Request $request){

        $emailData = json_decode($request['emailData']);
        $partnerContacts = $emailData->contacts;
        for ($index=0; $index < count($partnerContacts); $index++) {
            $partnerName = $partnerContacts[$index]->partnerName;
            $partnerEmail = $partnerContacts[$index]->partnerEmail;
            $partnerLocation = $partnerContacts[$index]->partnerLocation;
            $partnerBody = $partnerContacts[$index]->partnerBody;
            $partnerService = $partnerContacts[$index]->partnerService;
            $partnerPercent = $partnerContacts[$index]->partnerPercent;
            $details = ["partnerName" => $partnerName,
                        "partnerEmail" => $partnerEmail,
                        "partnerLocation" => $partnerLocation,
                        "partnerBody" => $partnerBody,
                        "partnerService" => $partnerService,
                        "partnerPercent" => $partnerPercent
                    ];
            Mail::to($partnerEmail, $partnerName)->queue(new ContactPartner($details));

        }
        return Redirect::back()->with('status', 'Email(s) sent successfully.');
    }

    function unblockPartner($id){
        $currentPartner = Partner::find($id);
        if(!(isset($currentPartner))){
            return Redirect::back()->withErrors('Partner not found. Please try again.');
        }else{
            $currentPartner->block_status = 0;
            $currentPartner->save();
            return Redirect::back()->with('status', 'Partner has been unblocked successfully.');
        }
    }

    function blockPartner($id){
        $currentPartner = Partner::find($id);
        if(!(isset($currentPartner))){
            return Redirect::back()->withErrors('Partner not found. Please try again.');
        }else{
            $currentPartner->block_status = 1;
            $currentPartner->save();
            return Redirect::back()->with('status', 'Partner has been blocked successfully.');
        }
    }
}
