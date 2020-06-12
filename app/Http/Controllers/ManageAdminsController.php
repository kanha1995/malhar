<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CountryList;
use App\LeadPartnerPair;
use App\Partner;
use App\RandomString;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;

class ManageAdminsController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if((auth()->user()->role == 1)){
                return $next($request);
            }else{
                return Redirect::back();
            }
        });
    }

    //
    public function addAdmin(){
        return view('admin.addAdmin');
    }

    public function getUserList($id){
        $allUsers = DB::table('users')->where('role', '=', $id)->get();
        return view('admin.adminList')->with([
            'users' => $allUsers,
            'superAdmins' => User::where('role', '1')->count(),
            'leadAdmins' => User::where('role', '2')->count(),
            'partnerAdmins' => User::where('role', '3')->count(),
            'projectManagers' => User::where('role', '4')->count(),
            'role' => $id
            ]);
    }
    public function index(){
        $allUsers = DB::table('users')->get();
        return view('admin.adminList')->with([
            'users' => $allUsers,
            'superAdmins' => User::where('role', '1')->count(),
            'leadAdmins' => User::where('role', '2')->count(),
            'partnerAdmins' => User::where('role', '3')->count(),
            'projectManagers' => User::where('role', '4')->count(),
            'role' => 0
            ]);
    }


    public function updateAdminDetails(Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'exists:users,email'],
            'adminRole'     => ['required', Rule::in(['1','2', '3', '4'])],
            'password'      => ['string', 'nullable']
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->all();
            return Redirect::back()->withErrors($errorMessage);
        }

        $currentPartner = User::find($input['id']);
        $currentPartner->name = $input['name'];
        $currentPartner->email = $input['email'];
        $currentPartner->role = $input['adminRole'];
        if(isset($input['password'])){
            $currentPartner->password = Hash::make($input['password']);
        }
        $currentPartner->save();
        return Redirect::back();

    }


    public function deletePartner($id){
        $currentPartner = User::find($id);
        if(!(isset($currentPartner))){
            return Redirect::back()->withErrors('Admin not found. Please try again.');
        }else{
            if((auth()->user()->role == 2) || (auth()->user()->role == 3) || (auth()->user()->role == 4)){
                return Redirect::back()->withErrors('You don\'t have access to delete anyone. Please contact your super admin.');
            }
            if(auth()->user()->id == $currentPartner->id){
                return Redirect::back()->withErrors('You cannot delete yourself. Please try again.');
            }
            $currentPartner->delete();
            return Redirect::back()->with('status', 'Admin has been deleted successfully.');
        }
    }

    public function createAdmin(Request $request){

        $input = $request->all();
        // dd($input);
        $validator = Validator::make($input, [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string', 'min:6'],
            'adminRole'          => ['required', Rule::in(['1', '2', '3', '4'])],
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->all();
            return Redirect::back()->withErrors($errorMessage);
        }

        $newPartner = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'role' => $input['adminRole'],
            'password' => Hash::make($input['password'])
        ]);
        //Send Email
        return redirect()->route('manageAdmins');
    }

    public function emailPartner(Request $request){

        return view('admin.emailPartner');
    }

    public function changePassword(Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
            'password'      => ['required', 'string', 'min:6', 'confirmed']
        ]);

        if($validator->fails()){
            $errorMessage = $validator->errors()->all();
            dd($errorMessage);
            return Redirect::back()->withErrors($errorMessage);
        }

        $currentUser = User::find(auth()->user()->id);
        $currentUser->password = Hash::make($input['password']);
        $currentUser->save();
        return Redirect::back()->with('status', 'Password has been changed successfully.');

    }
}
