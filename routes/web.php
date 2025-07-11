<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PDFprController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RequestPendingController;
use App\Http\Controllers\RequestPendingTechController;
use App\Http\Controllers\RequestApprovedController;
use App\Http\Controllers\RequestReturnController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\PpmpController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserController;


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
Route::group(['middleware'=>['guest']],function(){
    Route::get('/', function () {
        return view('login');
    });

    //Login
    Route::get('/login',[LoginController::class,'getLogin'])->name('getLogin');
    Route::post('/login',[LoginController::class,'postLogin'])->name('postLogin');
});

//Middleware
Route::group(['middleware'=>['login_auth', 'CheckMaintenanceMode']],function(){
    Route::get('/dashboard',[MasterController::class,'dashboard'])->name('dashboard');

    //View
    Route::prefix('/view')->group(function () {
        // Route::get('/', [ViewController::class, 'index'])->name('manage-index');
        Route::get('/category/list', [CategoryController::class, 'categoryRead'])->name('categoryRead');
        Route::get('/category/list/ajax', [CategoryController::class, 'getcategoryRead'])->name('getcategoryRead');
        Route::post('/category/list/add', [CategoryController::class, 'categoryCreate'])->name('categoryCreate');
        Route::post('/category/list/update', [CategoryController::class, 'categoryUpdate'])->name('categoryUpdate');
        Route::post('/category/list/delete{id}', [CategoryController::class, 'categoryDelete'])->name('categoryDelete');



        Route::get('/unit/list', [UnitController::class, 'unitRead'])->name('unitRead');
        Route::get('/unit/list/ajax', [UnitController::class, 'getunitRead'])->name('getunitRead');
        Route::post('/unit/list/add', [UnitController::class, 'unitCreate'])->name('unitCreate');
        Route::post('/unit/list/update', [UnitController::class, 'unitUpdate'])->name('unitUpdate');
        Route::post('/unit/list/delete{id}', [UnitController::class, 'unitDelete'])->name('unitDelete');


        Route::get('/item/list', [ItemController::class, 'itemRead'])->name('itemRead');
        Route::get('/item/list/ajax', [ItemController::class, 'getitemRead'])->name('getitemRead');
        Route::post('/item/list/add', [ItemController::class, 'itemCreate'])->name('itemCreate');
        Route::post('/item/list/update', [ItemController::class, 'itemUpdate'])->name('itemUpdate');
        Route::post('/item/list/delete{id}', [ItemController::class, 'itemDelete'])->name('itemDelete'); 
        Route::post('/item/list/delete/allnow', [ItemController::class, 'itemAllDelete'])->name('itemAllDelete'); 

        Route::get('/office/list', [OfficeController::class, 'officeRead'])->name('officeRead');
        Route::get('/office/list/ajax', [OfficeController::class, 'getofficeRead'])->name('getofficeRead');
        Route::post('/office/list/add', [OfficeController::class, 'officeCreate'])->name('officeCreate');
        Route::post('/office/list/update', [OfficeController::class, 'officeUpdate'])->name('officeUpdate');
        Route::get('/office/list/delete{id}', [OfficeController::class, 'officeDelete'])->name('officeDelete'); 
    });

    //Request
    Route::prefix('/request')->group(function () {
        Route::get('/purchaseRequest/shop', [RequestController::class, 'shop'])->name('shop');
        Route::get('/purchaseRequest/cat', [RequestController::class, 'getCategories'])->name('getCategories');

        Route::get('/purchaseRequest/cart', [RequestController::class, 'prPurposeRequest'])->name('prPurposeRequest');
        Route::post('/purchaseRequest/purpose/add', [RequestController::class, 'prPurposeRequestCreate'])->name('prPurposeRequestCreate');
        Route::get('/purchaseRequest/cart', [RequestController::class, 'prPurposeRequest'])->name('prPurposeRequest');
        Route::post('/purchaseRequest/update', [RequestController::class, 'prPurposeRequestUpdate'])->name('prPurposeRequestUpdate');
        Route::get('/purchaseRequest/cart/{id}', [RequestController::class,'mycartDelete'])->name('mycartDelete');

        Route::get('/selectprcategory/{purpose_Id}', [RequestController::class, 'selectItems'])->name('selectItems');
        Route::get('/selectprcategory/ajax/cartItem/{purpose_Id}', [RequestController::class, 'getcartitemListRead'])->name('getcartitemListRead');
        Route::post('/purchaseRequest/add', [RequestController::class, 'prCreate'])->name('prCreate');
        Route::get('get-items/{id}', [RequestController::class, 'getItemsByCategory'])->name('getItemsByCategory');
        Route::post('/purchaseRequest/add/save', [RequestController::class, 'savePR'])->name('savePR');
        Route::get('/purchaseRequest/delete/{id}', [RequestController::class, 'itemreqDelete'])->name('itemreqDelete');

        Route::get('/pendingPR_list', [RequestPendingController::class, 'pendingListRead'])->name('pendingListRead');
        Route::get('/pendingPR_list/ajaxviewreq', [RequestPendingController::class, 'getpendingListRead'])->name('getpendingListRead');
        Route::get('/pendingPR_list/view/{pid}', [RequestPendingController::class, 'pendingListView'])->name('pendingListView');
        Route::get('/pendingPR_list/pdf/{pid}', [RequestPendingController::class, 'PDFprPending'])->name('PDFprPending');
        Route::get('/pendingPR_list/rbaras/{pid}', [RequestPendingController::class, 'PDFrbarasPending'])->name('PDFrbarasPending');

        Route::get('/pendingPR/technician/list', [RequestPendingTechController::class, 'pendingTechCheckListRead'])->name('pendingTechCheckListRead');
        Route::get('/pendingPR/technician/list/ajaxview', [RequestPendingTechController::class, 'getpendingTechAllListRead'])->name('getpendingTechAllListRead');
        Route::get('/pendingPR/technician/list/view/{pid}', [RequestPendingTechController::class, 'pendingAllListTechView'])->name('pendingAllListTechView');

        Route::get('/pendingPR/list', [RequestPendingController::class, 'pendingAllListRead'])->name('pendingAllListRead');
        Route::get('/pendingPR/list/bud', [RequestPendingController::class, 'pendingAllBudgetListRead'])->name('pendingAllBudgetListRead');
        Route::get('/pendingPR/list/ajax', [RequestPendingController::class, 'getpendingAllListRead'])->name('getpendingAllListRead');
        // Route::get('/pendingPR/list/ajaxbud', [RequestPendingController::class, 'getpendingBudgetAllListRead'])->name('getpendingBudgetAllListRead');
        Route::get('/pendingPR/list/view/{pid}', [RequestPendingController::class, 'pendingAllListView'])->name('pendingAllListView');
        Route::get('/pendingPR/list/pdf/{pid}', [RequestPendingController::class, 'PDFprAllPending'])->name('PDFprAllPending');
        Route::get('/pendingPR/list/rbaras/{pid}', [RequestPendingController::class, 'PDFrbarasAllPending'])->name('PDFrbarasAllPending');
        Route::post('/pendingPR/list/checking', [RequestPendingController::class, 'checkingPR'])->name('checkingPR');
        Route::post('/pendingPR/list/approved', [RequestPendingController::class, 'approvedPR'])->name('approvedPR');

        Route::get('/notifications/fetch', [RequestPendingController::class, 'fetchNotifications'])->name('notifications.fetch');
        Route::post('/notifications/markAsRead', [RequestPendingController::class, 'markAsRead'])->name('notifications.markAsRead');


        Route::get('/approvedPR_list', [RequestApprovedController::class, 'approvedListRead'])->name('approvedListRead');

        Route::get('/approvedPR_list/ajax', [RequestApprovedController::class, 'getapprovedListRead'])->name('getapprovedListRead');
        Route::get('/approvedPR_list/receivedajax', [RequestApprovedController::class, 'getreceivedListRead'])->name('getreceivedListRead');
        Route::get('/approvedPR_list/canvassingajax', [RequestApprovedController::class, 'getcanvassingListRead'])->name('getcanvassingListRead');
        Route::get('/approvedPR_list/canvassedajax', [RequestApprovedController::class, 'getcanvassedListRead'])->name('getcanvassedListRead');
        Route::get('/approvedPR_list/philgepajax', [RequestApprovedController::class, 'getphilgepListRead'])->name('getphilgepListRead');
        Route::get('/approvedPR_list/postedajax', [RequestApprovedController::class, 'getpostedListRead'])->name('getpostedListRead');
        Route::get('/approvedPR_list/biddingajax', [RequestApprovedController::class, 'getbiddingListRead'])->name('getbiddingListRead');
        Route::get('/approvedPR_list/consolidategajax', [RequestApprovedController::class, 'getconsolidateListRead'])->name('getconsolidateListRead');
        Route::get('/approvedPR_list/awardedgajax', [RequestApprovedController::class, 'getawardedListRead'])->name('getawardedListRead');
        Route::get('/approvedPR_list/purchasegajax', [RequestApprovedController::class, 'getpurchaseListRead'])->name('getpurchaseListRead');
        
        Route::get('/approvedPR_list/view/{pid}', [RequestApprovedController::class, 'approvedListView'])->name('approvedListView');
        Route::get('/approvedPR_list/pdf/{pid}', [RequestApprovedController::class, 'PDFprApproved'])->name('PDFprApproved');
        Route::get('/approvedPR_list/rbaras/{pid}', [RequestApprovedController::class, 'PDFrbarasApproved'])->name('PDFrbarasApproved');

        Route::get('/pdfPRform/view', [PDFprController::class, 'PDFprRead'])->name('PDFprRead');
        Route::get('/pdfPRformTemplate/view', [PDFprController::class, 'PDFprShowTemplate'])->name('PDFprShowTemplate');

        Route::get('/pdfBARSform/view', [PDFprController::class, 'PDFbarsRead'])->name('PDFbarsRead');
        Route::get('/pdfBARSformTemplate/view', [PDFprController::class, 'PDFbarsShowTemplate'])->name('PDFbarsShowTemplate');
    });

    Route::prefix('/request')->group(function () {
        Route::get('/view/listpendingPR/list/bud', [RequestPendingController::class, 'pendingAllBudgetListRead'])->name('pendingAllBudgetListRead');
        Route::get('/view/pendingPR/list/ajaxbud', [RequestPendingController::class, 'getpendingBudgetAllListRead'])->name('getpendingBudgetAllListRead');
        Route::get('/view/pendingPR/list/viewreq/{pid}', [RequestPendingController::class, 'pendingAllListView'])->name('pendingAllListView');
        Route::get('/view/pendingPR/list/pdf/{pid}', [RequestPendingController::class, 'PDFprAllPending'])->name('PDFprAllPending');
        Route::get('/view/pendingPR/list/rbaras/{pid}', [RequestPendingController::class, 'PDFrbarasAllPending'])->name('PDFrbarasAllPending');
        Route::post('/view/pendingPR/list/checking', [RequestPendingController::class, 'checkingPR'])->name('checkingPR');
        Route::post('/view/pendingPR/list/approved', [RequestPendingController::class, 'approvedPR'])->name('approvedPR');
        Route::get('/view/pendingPR/list/cancelreqpr', [RequestPendingController::class, 'getreqcancelprBudgetAllListRead'])->name('getreqcancelprBudgetAllListRead');

        Route::get('/approvedPR/list', [RequestApprovedController::class, 'approvedListAllRead'])->name('approvedListAllRead');
        Route::get('/approvedPR/list/ajaxapp', [RequestApprovedController::class, 'getAllapprovedListRead'])->name('getAllapprovedListRead');
        Route::get('/approvedPR/list/received/ajaxapp', [RequestApprovedController::class, 'getAllreceivedListRead'])->name('getAllreceivedListRead');
        Route::get('/approvedPR/list/canvassing/ajaxapp', [RequestApprovedController::class, 'getAllcanvassingListRead'])->name('getAllcanvassingListRead');
        Route::get('/approvedPR/list/canvassed/ajaxapp', [RequestApprovedController::class, 'getAllcanvassedListRead'])->name('getAllcanvassedListRead');
        Route::get('/approvedPR/list/philgepsp/ajaxapp', [RequestApprovedController::class, 'getAllphilgepListRead'])->name('getAllphilgepListRead');
        Route::get('/approvedPR/list/posting/ajaxapp', [RequestApprovedController::class, 'getAllpostingListRead'])->name('getAllpostingListRead');
        Route::get('/approvedPR/list/fuckyou/ajaxapp', [RequestApprovedController::class, 'getAllfuckyouListRead'])->name('getAllfuckyouListRead');
        Route::get('/approvedPR/list/madakpakconsol/ajaxapp', [RequestApprovedController::class, 'getAllmadapakconsolListRead'])->name('getAllmadapakconsolListRead');
        Route::get('/approvedPR/list/award/ajaxapp', [RequestApprovedController::class, 'getAllawardListRead'])->name('getAllawardListRead');
        Route::get('/approvedPR/list/bakal/ajaxapp', [RequestApprovedController::class, 'getAllpurchaseListRead'])->name('getAllpurchaseListRead');

        Route::get('/approvedPR/list/view/{pid}', [RequestApprovedController::class, 'approvedAllListView'])->name('approvedAllListView');
        Route::get('/approvedPR/list/pdf/{pid}', [RequestApprovedController::class, 'PDFprAllApproved'])->name('PDFprAllApproved');
        Route::get('/approvedPR/list/rbaras/{pid}', [RequestApprovedController::class, 'PDFrbarasAllApproved'])->name('PDFrbarasAllApproved');

        Route::post('/approvedPR/list/received', [RequestApprovedController::class, 'receivedPR'])->name('receivedPR');
        Route::post('/approvedPR/list/canvassing', [RequestApprovedController::class, 'canvassingPR'])->name('canvassingPR');
        Route::post('/approvedPR/list/canvassed', [RequestApprovedController::class, 'canvassedPR'])->name('canvassedPR');
        Route::post('/approvedPR/list/philgepsposting', [RequestApprovedController::class, 'philgepspostingPR'])->name('philgepspostingPR');
        Route::post('/approvedPR/list/posted', [RequestApprovedController::class, 'postedPR'])->name('postedPR');
        Route::post('/approvedPR/list/bidding', [RequestApprovedController::class, 'biddingPR'])->name('biddingPR');
        Route::post('/approvedPR/list/consolidation', [RequestApprovedController::class, 'consolidationPR'])->name('consolidationPR');
        Route::post('/approvedPR/list/awarded', [RequestApprovedController::class, 'awardedPR'])->name('awardedPR');
        Route::post('/approvedPR/list/purchased', [RequestApprovedController::class, 'purchasedPR'])->name('purchasedPR');
        Route::post('/approvedPR/list/returned', [RequestApprovedController::class, 'rerturnedPR'])->name('rerturnedPR');
        Route::post('/approvedPR/list/forwarded', [RequestApprovedController::class, 'forwardedPedoPR'])->name('forwardedPedoPR');
        Route::post('/approvedPR/list/cancelreqpr', [RequestApprovedController::class, 'cancelreqheadPR'])->name('cancelreqheadPR');
        
        Route::post('/role/user', [RequestApprovedController::class, 'getUserRole'])->name('getUserRole');
    });

    Route::prefix('/request')->group(function () {
        Route::get('/view/listreturnedPR/list/checker', [RequestReturnController::class, 'returnedAllListRead'])->name('returnedAllListRead');
        Route::get('/view/listreturnedPR/list/ajaxchecker', [RequestReturnController::class, 'getreturnedAllListRead'])->name('getreturnedAllListRead');

        Route::get('/view/listreturnedPR/list/user', [RequestReturnController::class, 'returnedUserListRead'])->name('returnedUserListRead');
        Route::get('/view/listreturnedPR/list/ajaxuser', [RequestReturnController::class, 'getreturnedUserListRead'])->name('getreturnedUserListRead');
        Route::get('/view/listreturnedPR/view/{pid}', [RequestReturnController::class, 'returnedpendingListView'])->name('returnedpendingListView');
        Route::get('/view/listreturnedPR/editpr/{pid}', [RequestReturnController::class, 'editreturnselectItems'])->name('editreturnselectItems');

        Route::get('/view/listcanceledPR/list/user', [RequestReturnController::class, 'cancelUserListRead'])->name('cancelUserListRead');
        Route::get('/view/listcanceledPR/list/user/ajax', [RequestReturnController::class, 'getcanceledUserListRead'])->name('getcanceledUserListRead');
    });

    //View
    Route::prefix('/ppmp')->group(function () {
        Route::get('/per/year', [PpmpController::class, 'ppmpRead'])->name('ppmpRead');
        Route::get('/per/year/{puid}', [PpmpController::class,'ppmpEdit'])->name('ppmpEdit');
        Route::post('/per/year/update', [PpmpController::class, 'userppmpUpdate'])->name('userppmpUpdate');
    });

    Route::prefix('/archive')->group(function () {
        Route::get('/file/list', [ArchiveController::class, 'archiveRead'])->name('archiveRead');
    });

    //Reports
    Route::prefix('/generate')->group(function () {
        Route::get('/list/option',[ReportsController::class,'consolidateRead'])->name('consolidateRead');
        Route::get('/list/reports/generate', [ReportsController::class,'consolidateGen_reports'])->name('consolidateGen_reports');
        Route::post('/list/reports/generate/PDF', [ReportsController::class, 'consolidatePDFGen_reports'])->name('consolidatePDFGen_reports');

        Route::get('/list/option/form2',[ReportsController::class,'consolidateForm2Read'])->name('consolidateForm2Read');
        Route::get('/list/reports/form2/generate', [ReportsController::class,'consolidateGenform2_reports'])->name('consolidateGenform2_reports');
        Route::post('/list/reports/form2/generate/PDF', [ReportsController::class, 'consolidatePDFGenform2_reports'])->name('consolidatePDFGenform2_reports');
    });

    //Users
    Route::prefix('/users')->group(function () {
        Route::get('/list',[UserController::class,'userRead'])->name('userRead');
        Route::post('/list/add', [UserController::class, 'userCreate'])->name('userCreate');
        Route::get('list/edit/{id}', [UserController::class, 'userEdit'])->name('userEdit');
        Route::post('list/update', [UserController::class, 'userUpdate'])->name('userUpdate');
        Route::post('list/updatePass', [UserController::class, 'userUpdatePassword'])->name('userUpdatePassword');
        Route::get('/account-settings',[UserController::class,'user_settings'])->name('user_settings');
        Route::post('/account-settings/information/update',[UserController::class,'user_settings_profile_update'])->name('user_settings_profile_update');
        Route::post('/acccount-settings/information/updatePass',[UserController::class,'profilePassUpdate'])->name('profilePassUpdate');
    });

    Route::prefix('/info')->group(function () {
        Route::get('/account-settings',[UserController::class,'user_settings'])->name('user_settings');
        Route::post('/account-settings/information/update',[UserController::class,'user_settings_profile_update'])->name('user_settings_profile_update');
        Route::post('/acccount-settings/information/updatePass',[UserController::class,'profilePassUpdate'])->name('profilePassUpdate');

        Route::get('/annouce-settings',[UserController::class,'annouceInfo'])->name('annouceInfo');
        Route::post('/annouce-settings/info/update',[UserController::class,'annouceUpdate'])->name('annouceUpdate');

        Route::get('/setting/server/zeus',[UserController::class,'serverMaintenance'])->name('serverMaintenance');
        Route::post('/setting/server/zeus/admin/maintenance', [UserController::class, 'toggleMaintenance'])->name('toggleMaintenance');
    });
    
    //Logout
    Route::get('/logout',[MasterController::class,'logout'])->name('logout');
});
