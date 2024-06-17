<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AccessController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleAccessController;
use App\Http\Controllers\Admin\UserCameraController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\DeactivateReasonsController;
use App\Http\Controllers\Admin\TechnicainRequestController;

Route::get('/', [AdminController::class, 'index']);
Route::get('/login', [AdminController::class, 'index'])->name('login_form');

// Route::post('/login/owner', [AdminController::class, 'login'])->name('admin.login');
Route::match(['get', 'post'], '/login/owner', [AdminController::class, 'login'])->name('admin.login');



Route::group(['middleware' => ['admin']], function () {
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::controller(SettingController::class)->group(function () {
        Route::get('/settings', 'index')->name('settings');
        Route::any('/setting-update', 'update')->name('setting.update');
        Route::post('/change-tax-setting', 'changeTaxSetting')->name('change.taxsetting');

    });

    Route::get('/edit-profile',[ProfileController::class,'edit'])->name('admin.edit.profile');
    Route::get('/update-profile',[ProfileController::class,'update'])->name('admin.update.profile');

    Route::controller(CountryController::class)->group(function () {
        Route::get('/countries', 'index')->name('admin.country');
        Route::post('/country-create', 'create')->name('admin.country.create');
        Route::post('/country-delete', 'delete')->name('admin.country.delete');
    });
    Route::controller(ProvinceController::class)->group(function () {
        Route::get('/provinces', 'index')->name('provinces');
        Route::post('/province-create', 'create')->name('admin.province.create');
        Route::post('/province-delete', 'delete')->name('admin.province.delete');
    });
    Route::controller(CityController::class)->group(function () {
        Route::get('/cities', 'index')->name('cities');
        Route::post('/city-create', 'create')->name('admin.city.create');
        Route::post('/city-delete', 'delete')->name('admin.city.delete');
    });
    Route::controller(PrivacyPolicyController::class)->group(function () {
        Route::get('/privacy_policy', 'index')->name('admin.policy');
        Route::post('/update_policy', 'updatePolicy')->name('admin.update.policy');
        Route::get('/terms_condition', 'terms')->name('admin.terms_condition');
        Route::post('/update_terms', 'updateTerms')->name('admin.update.terms');
    });
    Route::controller(DeactivateReasonsController::class)->group(function () {
        Route::get('/deactiveReasons', 'index')->name('deactivereasons');
        Route::post('/deactiveReasonsCreate', 'create')->name('admin.deactivereasons.create');
        Route::post('/deactiveReasonsDelete', 'delete')->name('admin.deletedeactivereasons.delete');
    });
    Route::controller(TechnicainRequestController::class)->group(function () {
        Route::get('/pending-technician-request', 'pending')->name('admin.pending.techreq');
        Route::get('/completed-technician-request', 'completed')->name('admin.completed.techreq');
        Route::post('/add-technician-request', 'create')->name('admin.add.techreq');
        Route::post('/get-user-address', 'getAddress')->name('admin.getAddress');
        Route::post('/technician-request-delete', 'delete')->name('admin.delete.techreq');
    });
    
    Route::controller(AddressController::class)->group(function () {
        Route::get('/user-address', 'list')->name('admin.user.address');
        Route::post('/user-address-delete', 'delete')->name('admin.delete.address');
        Route::post('/getProvince','getProvince')->name('admin.getProvince');
        Route::post('/getCity','getCity')->name('admin.getCity');
        Route::post('/add-address', 'create')->name('admin.add.address');
        Route::post('/defualt-address', 'makeDefualt')->name('admin.address.isDefault');
    });
    Route::controller(UserCameraController::class)->group(function () {
        Route::get('/user-camera', 'list')->name('admin.user.camera');
        Route::post('/user-camera-delete', 'delete')->name('admin.delete.camera');
    });
    Route::get('/access', [AccessController::class, 'index'])->name('accessindex');
    Route::post('/access-create', [AccessController::class, 'create'])->name('accesscreate');
    Route::post('/access-delete', [AccessController::class, 'delete'])->name('admin.access.delete');
    Route::get('/role', [RoleAccessController::class, 'index'])->name('roleindex');
    Route::post('/role-create', [RoleAccessController::class, 'create'])->name('rolecreate');
    Route::post('/role-select', [RoleAccessController::class, 'rolesdelected'])->name('rolesdelected');
    Route::post('/role-delete', [RoleAccessController::class, 'delete'])->name('admin.role.delete');
    Route::get('/index', [UserRoleController::class, 'index'])->name('admin.userrole.index');
    Route::get('autocomplete-userrole', [UserRoleController::class, 'autocompleteuserrole'])->name('autocompleteuserrole');
    Route::post('/userrole-create', [UserRoleController::class, 'create'])->name('userrolecreate');
    Route::post('/userrole-delete', [UserRoleController::class, 'delete'])->name('admin.userroll.delete');
    Route::controller(UserController::class)->group(function () {
        Route::get('/user-valve', 'userValve')->name('user.valve');
        Route::get('/basestation-details', 'baseStationDetails')->name('user.basestation.details');
        Route::get('/valve-dlist', 'valveList')->name('user.valve.list');
        Route::post('/deletedValve', 'deletedValve')->name('user.deletedValve');
        Route::post('/valveVisible', 'isVisible')->name('valve.visible');
        Route::post('/addValve', 'addValve')->name('user.addValve');
        Route::get('/active', 'active')->name('user.active');
        Route::get('/banned', 'banned')->name('user.banned');
        Route::get('/active-technician', 'activeTechnician')->name('technician.active');
        Route::get('/banned-technician', 'bannedTechnician')->name('technician.banned');
        Route::post('/deletedAt', 'deletedAt')->name('user.deletedAt');
        Route::post('/restorUser', 'restorUser')->name('user.restorUser');
        Route::post('/verified', 'verified')->name('user.verify');
        Route::get('/getEdit','getEdit')->name('admin.users.edit');
        Route::get('/getEditTechnician','getTechnicianEdit')->name('admin.technician.edit');
        Route::get('/addUsers','addUsers')->name('admin.addUsers');
        Route::get('/addTechnician','addTechnician')->name('admin.addTechnician');
        Route::post('/postEdit','postEdit')->name('users.post');
    });

    Route::get('/user-faq', [FAQController::class, 'userFaq'])->name('admin.faq');
    Route::get('/technician-faq', [FAQController::class, 'technicianFaq'])->name('admin.faq.technician');
    Route::post('/faq-create', [FAQController::class, 'create'])->name('faq-create');
    Route::post('/faq-delete', [FAQController::class, 'delete'])->name('admin.faq.delete');
});


