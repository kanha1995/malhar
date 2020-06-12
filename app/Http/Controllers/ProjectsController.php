<?php

namespace App\Http\Controllers;

use App\Lead;
use App\LeadPartnerPair;
use App\PartnerSearch;
use App\Project;
use App\projects;
use Illuminate\Http\Request;
use App\RandomString;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if((auth()->user()->role == 1) || (auth()->user()->role == 4)){
                return $next($request);
            }else{
                return Redirect::back();
            }
        });
    }

    public function index(){
        $allUsers = DB::table('projects')->get();
        return view('admin.manageProjects')->with(['users' => $allUsers]);
    }

    //
    public function createProject(Request $request){

        $projectData = json_decode($request['projectData']);


        $newParameterBag = new Request();
        $newParameterBag['start_date'] = $projectData->start_date;
        $newParameterBag['end_date'] = $projectData->end_date;
        $newParameterBag['lead_id'] = $projectData->lead_id;
        $newParameterBag['partner_id'] = $projectData->partner_id;

        $input = $newParameterBag->all();
        $validator = Validator::make($input, [
            'lead_id'          => ['required', 'string', 'exists:leads,lead_id'],
            'partner_id'       => ['required', 'string', 'exists:partners,partner_id'],
            'start_date'       => ['required', 'string'],
            'end_date'         => ['required', 'string']
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->all();
            return Redirect::back()->withErrors($errorMessage);
        }

        $matchThese = ['lead_id' => $projectData->lead_id, 'partner_id' => $projectData->partner_id];
        $projectDetails = Project::where($matchThese)->first();
        if(is_null($projectDetails)){
            $newProject = Project::create([
                'project_id'   => RandomString::generate(),
                'lead_id'   => $projectData->lead_id,
                'partner_id'   => $projectData->partner_id,
                'start_date'   => $projectData->start_date,
                'end_date'   => $projectData->end_date,
            ]);

            $currentLead = Lead::where('lead_id', $projectData->lead_id)->first();
            $currentLead->status = 4; //Converted to project
            $currentLead->save();

            $currentLeadPartner = LeadPartnerPair::where('lead_id', $projectData->lead_id)->get();
            foreach($currentLeadPartner as $leadPartner){
                $leadPartner->delete();
            }

            $currentPartnerSearch = PartnerSearch::where('lead_id', $projectData->lead_id)->get();
            foreach($currentPartnerSearch as $leadPartner){
                $leadPartner->delete();
            }


            return Redirect::back()->with('status', 'Project has been created successfully.');
        }else{
            return Redirect::back()->withErrors('Project is already exists.');
        }

    }
}
