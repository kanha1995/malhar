<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CountryList;
use App\LanguageList;
use App\Lead;
use App\Partner;
use App\RandomString;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\LeadPartnerPair;

class ManageLeadsController extends Controller
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

    //
    public function addLead(){
        return view('leads.addLead')->with([
            'countryData'   => CountryList::getCountryList(),
            'languageList'  => LanguageList::getLanguageList(),
        ]);
    }

    public function index(Request $request){

        $allUsers = DB::table('leads')->latest()
                                        ->where('status', '<>' ,'4')
                                        ->get();
        return view('leads.manageLeads')->with(['users' => $allUsers]);
    }

    public function getPartnerDetails($id){

        $user = Partner::find($id);
        return view('admin.addPartner')->with([
            'countryData' => CountryList::getCountryList(),
            'user' => $user
        ]);
    }

    public function updateLeadDetails(Request $request){


        $input = $request->all();
        $validator = Validator::make($input, [
            'name'                      => ['required', 'string', 'max:255'],
            'url'                       => ['url', 'nullable'],
            'city'                      => ['string', 'nullable'],
            'country'                   => ['required', 'string'],
            'worldwide'                  => ['boolean'],
            'language'                  => ['string'],
            'translation'               => ['boolean'],
            'initial_requirement'       => ['string', 'nullable'],
            'note_to_partner'           => ['string', 'nullable'],
            'partner_search_keywords'   => ['string', 'nullable'],
            'c2c'                       => ['boolean'],
            'tags'                      => ['string', 'nullable'],
            'description'               => ['string', 'nullable'],
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->all();
            return Redirect::back()->withErrors($errorMessage);
        }

        $currentPartner = Lead::find($input['id']);
        $currentPartner->name = $input['name'];
        $currentPartner->email = $input['email'];
        $currentPartner->url = $input['url'];
        $currentPartner->city = $input['city'];
        $currentPartner->country = $input['country'];

        if(isset($input['worldwide'])){
            $currentPartner->worldwide = $input['worldwide'];
        }else{
            $currentPartner->worldwide = 0;
        }
        if(isset($input['c2c'])){
            $currentPartner->c2c = $input['c2c'];
        }else{
            $currentPartner->c2c = 0;
        }
        if(isset($input['translation'])){
            $currentPartner->translation = $input['translation'];
        }else{
            $currentPartner->translation = 0;
        }

        if(isset($input['datepicker'])){
            $dbDate = date('Y-m-d', strtotime($input['datepicker']));
            $currentPartner->date_of_communicatin = $dbDate;
        }

        if(isset($input['description'])){

            $currentPartner->description = $input['description'];
        }

        $currentPartner->language = $input['language'];

        $currentPartner->initial_requirement = $input['initial_requirement'];
        $currentPartner->note_to_partner = $input['note_to_partner'];
        $currentPartner->partner_search_keywords = $input['partner_search_keywords'];

        $currentPartner->tags = $input['tags'];
        $currentPartner->save();
        return Redirect::back();

    }

    public function previewLead($id){

        $user = Lead::find($id);
        $countryRequest = new Request();
        $countryRequest['country_id'] = $user->country;
        $country = CountryList::getCountryDetails($countryRequest)->value;

        $languageRequest = new Request();
        $languageRequest['lang_code'] = $user->language;
        $language = LanguageList::getLanguageDetails($languageRequest)->value;

        return view('leads.previewLead')->with([
            'user' => $user,
            'countryData' => CountryList::getCountryList(),
            'languageList' => LanguageList::getLanguageList(),
            'country'=>$country,
            'language' => $language
            ]);
    }

    public function deleteLead($id){
        $currentPartner = Lead::find($id);
        if(!(isset($currentPartner))){
            return Redirect::back()->withErrors('Lead not found. Please try again.');
        }else{
            $currentLeadPartnerPair = LeadPartnerPair::where('lead_id', $currentPartner->lead_id);
            $currentLeadPartnerPair->delete();
            $currentPartner->delete();
            return Redirect::back()->with('status', 'Lead has been deleted successfully.');
        }
    }

    public function createLead(Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
            'name'                      => ['required', 'string', 'max:255'],
            'email'                     => ['required', 'string', 'email', 'max:255'],
            'url'                       => ['url', 'nullable'],
            'city'                      => ['string', 'nullable'],
            'country'                   => ['required', 'string'],
            'worldwide'                  => ['boolean'],
            'language'                  => ['string'],
            'translation'               => ['boolean'],
            'initial_requirement'       => ['string', 'nullable'],
            'note_to_partner'           => ['string', 'nullable'],
            'partner_search_keywords'   => ['string', 'nullable'],
            'c2c'                       => ['boolean'],
            'tags'                      => ['string', 'nullable'],
            'description'               => ['string', 'nullable'],
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->all();
            return Redirect::back()->withErrors($errorMessage);
        }

        if(!isset($input['translation'])){
            $input['translation'] = 0;
        }
        if(!isset($input['worldwide'])){
            $input['worldwide'] = 0;
        }
        if(!isset($input['c2c'])){
            $input['c2c'] = 0;
        }
        $newPartner = Lead::create([
            'lead_id'   => 'L' . RandomString::generate(),
            'name'      => $input['name'],
            'email'     => $input['email'],
            'url'       => $input['url'],
            'city'      => $input['city'],
            'country'   => $input['country'],
            'language'   => $input['language'],
            'translation'   => $input['translation'],
            'worldwide'  => $input['worldwide'],
            'initial_requirement' => $input['initial_requirement'],
            'note_to_partner' => $input['note_to_partner'],
            'partner_search_keywords' => $input['partner_search_keywords'],
            'c2c'       => $input['c2c'],
            'tags'      => $input['tags'],
            'description'      => $input['description']
        ]);

        //Send Email
        return redirect()->route('manageLeads');
    }

    public function emailPartner(Request $request){

        return view('admin.emailPartner');
        // $input = $request->all();
        // $validator = Validator::make($input, [
        //     'name'          => ['required', 'string', 'max:255', 'exists:users,name'],
        //     'email'         => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
        //     'subject'       => ['required', 'string'],
        //     'body'          => ['required', 'string']
        // ]);

        // if($validator->fails()){
        //     $errorMessage = $validator->errors()->all();
        //     return Redirect::back()->withErrors($errorMessage);
        // }
        // return redirect()->route('managePartners');
    }
}
