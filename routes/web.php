<?php

use App\Http\Controllers\AdminNotifikasiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BankSkynetController;
use App\Http\Controllers\BerandaAdminController;
use App\Http\Controllers\BerandaClientController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientMemberController;
use App\Http\Controllers\ClientNotifikasiController;
use App\Http\Controllers\JobStatusController;
use App\Http\Controllers\KartuSppController;
use App\Http\Controllers\KirimPesanController;
use App\Http\Controllers\KwitansiPembayaranController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LaporanFormController;
use App\Http\Controllers\LaporanPembayaranController;
use App\Http\Controllers\LaporanTagihanController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberImportController;
use App\Http\Controllers\PanduanPembayaranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RekapPembayaranController;
use App\Http\Controllers\SettingAppController;
use App\Http\Controllers\SettingBeritaController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SettingServicesController;
use App\Http\Controllers\SettingSliderHeaderController;
use App\Http\Controllers\SettingSponsorController;
use App\Http\Controllers\SettingWhacenterController;
use App\Http\Controllers\SkyMemberController;
use App\Http\Controllers\SkyMemberInvoiceController;
use App\Http\Controllers\SkyMemberPembayaranController;
use App\Http\Controllers\SkyMemberProfileController;
use App\Http\Controllers\SkyMemberTagihanController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TagihanUpdateLunas;
use App\Http\Controllers\UserController;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('tes', function () {
//     echo $url = URL::temporarySignedRoute(
//         'login.url',
//         now()->addMinutes(30),
//         [
//             'pembayaran_id' => 1,
//             'user_id' => 1,
//             'url' => route('pembayaran.show', 1)
//         ]
//     );
// });

Route::get('login/login-url', [LoginController::class, 'loginUrl'])->name('login.url');

Route::get('/', [LandingPageController::class, 'index'])->name('landing_page');
Route::resource('landingpage', LandingPageController::class);
// Route::post('send-message', 'LandingPageController@store')->name('send-message');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('panduan-pembayaran/{id}', [PanduanPembayaranController::class,'index'])->name('panduan.pembayaran');
Route::prefix('admin')->middleware(['auth', 'auth.admin'])->group(function () {
    // route khusus admin
    Route::get('beranda', [BerandaAdminController::class, 'index'])->name('admin.beranda');
    Route::resource('settingwhacenter', SettingWhacenterController::class);
    Route::resource('settingappform', SettingAppController::class);
    Route::resource('bankskynet', BankSkynetController::class);
    Route::resource('user', UserController::class);
    Route::resource('client', ClientController::class);
    Route::resource('member', MemberController::class);
    Route::resource('clientmember', ClientMemberController::class);
    Route::resource('biaya', BiayaController::class);
    Route::resource('tagihan', TagihanController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('setting', SettingController::class);
    Route::get('delete-biaya-item/{id}', [BiayaController::class, 'deleteItem'])->name('delete-biaya.item');
    Route::get('status/update', [StatusController::class, 'update'])->name('status.update');
    Route::resource('notifikasi', AdminNotifikasiController::class);
    Route::resource('kirimpesan', KirimPesanController::class);
    // Setting Landing Page
    Route::resource('sponsor', SettingSponsorController::class);
    Route::resource('services', SettingServicesController::class);
    Route::resource('berita', SettingBeritaController::class);
    Route::resource('slider', SettingSliderHeaderController::class);
    // Laporan
    Route::get('laporanform/index', [LaporanFormController::class, 'create'])->name('laporanform.create');
    Route::get('laporantagihan/create', [LaporanTagihanController::class, 'index'])->name('laporantagihan.index');
    Route::get('laporanpembayaran', [LaporanPembayaranController::class, 'index'])->name('laporanpembayaran.index');
    Route::get('rekappembayaran', [RekapPembayaranController::class, 'index'])->name('rekappembayaran.index');
    // invoke
    Route::post('tagihanupdatelunas', TagihanUpdateLunas::class)->name('tagihanupdate.lunas');
    Route::resource('logactivity', LogActivityController::class);
    Route::resource('jobstatus', JobStatusController::class);
    Route::post('memberimport', MemberImportController::class)->name('memberimport.store');

});

// \Imtigger\LaravelJobStatus\ProgressController::routes();

Route::get('login-client', [LoginController::class,'showLoginFormClient'])->name('login.client');
Route::prefix('client')->middleware(['auth', 'auth.client'])->name('client.')->group(function () {
    // route khusus client
    Route::get('beranda', [BerandaClientController::class, 'index'])->name('beranda');
    Route::resource('member', SkyMemberController::class);
    Route::resource('tagihan', SkyMemberTagihanController::class);
    Route::resource('pembayaran', SkyMemberPembayaranController::class);
    Route::resource('profil', SkyMemberProfileController::class);
    Route::resource('notifikasi', ClientNotifikasiController::class);
});
Route::get('kartumember', [KartuSppController::class, 'index'])->name('kartumember.index')->middleware('auth');
Route::get('kwitansi-pembayaran/{id}', [KwitansiPembayaranController::class, 'show'])->name('kwitansipembayaran.show')->middleware('auth');
Route::resource('invoice', SkyMemberInvoiceController::class)->middleware('auth');

Route::get('logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout');