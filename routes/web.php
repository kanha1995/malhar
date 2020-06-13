<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/logoutAction', function () {
    auth()->logout();
    return redirect('/');
})->name('logoutAction');

Auth::routes();
Route::get('/register', function () {
    return redirect('/login');
});
Route::get('/password/reset', function () {
    return redirect('/login');
});

Route::group(['middleware' => ['superAdmin']], function() {
    Route::get('/', function (){
        return redirect('home');
    });
    Route::get('managePartners', 'ManagePartnersController@index')->name('managePartners')->middleware('auth');
    Route::get('addPartner', 'ManagePartnersController@addPartner')->name('addPartner')->middleware('auth');
    Route::post('createPartner', 'ManagePartnersController@createPartner')->name('createPartner')->middleware('auth');
    Route::post('updatePartner', 'ManagePartnersController@updatePartnerDetails')->middleware('auth')->name('updatePartner');
    Route::get('previewPartner/{id}', 'ManagePartnersController@previewPartner')->middleware('auth');
    Route::get('previewMyPartner/{id}', 'ManagePartnersController@previewPartner')->middleware('auth');
    Route::get('editPartner/{id}', 'ManagePartnersController@getPartnerDetails')->middleware('auth');
    Route::get('deletePartner/{id}', 'ManagePartnersController@deletePartner')->middleware('auth')->name('deletePartner');
    Route::get('unblockPartner/{id}', 'ManagePartnersController@unblockPartner')->middleware('auth')->name('unblockPartner');
    Route::get('blockPartner/{id}', 'ManagePartnersController@blockPartner')->middleware('auth')->name('blockPartner');
    Route::get('contactPartners', 'ManagePartnersController@emailPartner')->middleware('auth')->name('contactPartners');
    Route::post('sendPartnerEmail', 'ManagePartnersController@sendEmails')->middleware('auth')->name('sendPartnerEmail');
    Route::get('/home', function (){
        if(auth()->user()->role == 1){
            return redirect('/manageAdmins');
        }elseif(auth()->user()->role == 2){
            return redirect('/manageLeads');
        }elseif(auth()->user()->role == 3){
            return redirect('/managePartners');
        }elseif(auth()->user()->role == 4){
            return redirect('/manageProjects');
        }
    })->name('home')->middleware('auth');


    Route::get('showClientPage', 'ManageClientSideRequestController@index')->name('showClientPage');

    // Manage Leads
    Route::get('manageLeads', 'ManageLeadsController@index')->name('manageLeads')->middleware('auth');
    Route::get('addLead', 'ManageLeadsController@addLead')->name('addLead')->middleware('auth');
    Route::post('createLead', 'ManageLeadsController@createLead')->name('createLead')->middleware('auth');
    Route::get('previewLead/{id}', 'ManageLeadsController@previewLead')->middleware('auth');
    Route::get('deleteLead/{id}', 'ManageLeadsController@deleteLead')->name('deleteLead')->middleware('auth');
    Route::post('updateLead', 'ManageLeadsController@updateLeadDetails')->name('updateLead')->middleware('auth');

    // Manage Lead Partner Combination
    Route::get('createLeadPartnerPair/{id}', 'LeadPartnerPairController@createLeadPartnerPair')->middleware('auth');
    Route::get('manageLeadPartner', 'LeadPartnerPairController@manageLeadPartnerPair')->name('manageLeadPartner')->middleware('auth');
    Route::get('deleteLeadPartner/{id}', 'LeadPartnerPairController@deleteLeadPartner')->name('deleteLeadPartner')->middleware('auth');
    Route::post('sendLeadEmail', 'LeadPartnerPairController@sendEmails')->name('sendLeadEmail')->middleware('auth');

    // Manage Partner Search Action
    Route::get('createPartnerSearch/{id}', 'PartnerSearchController@createPartnerSearchAction')->name('partnerSearchAction')->middleware('auth');
    Route::get('partnerSearchRequest', 'PartnerSearchController@partnerSearchRequest')->name('partnerSearchRequest')->middleware('auth');
    Route::get('finishAction/{id}', 'PartnerSearchController@finishAction')->name('finishAction')->middleware('auth');

    // Manage Admins
    Route::get('manageAdmins', 'ManageAdminsController@index')->name('manageAdmins')->middleware('auth');
    Route::get('manageAdmin/{id}', 'ManageAdminsController@getUserList')->name('manageAdmin')->middleware('auth');
    Route::get('deleteAdmin/{id}', 'ManageAdminsController@deletePartner')->name('deleteAdmin')->middleware('auth');
    Route::post('updateAdminDetails', 'ManageAdminsController@updateAdminDetails')->name('updateAdminDetails')->middleware('auth');
    Route::get('addAdmin', 'ManageAdminsController@addAdmin')->name('addAdmin')->middleware('auth');
    Route::post('createAdmin', 'ManageAdminsController@createAdmin')->name('createAdmin')->middleware('auth');
    Route::post('changePassword', 'ManageAdminsController@changePassword')->name('changePassword')->middleware('auth');

    Route::post('createProject', 'ProjectsController@createProject')->name('createProject');
    Route::get('manageProjects', 'ProjectsController@index')->name('manageProjects');
});
