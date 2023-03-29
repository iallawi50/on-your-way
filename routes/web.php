<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderlogController;
use App\Models\Order;
use App\Models\Orderlog;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/orders');
    } else {
        return redirect(route('register'));
    }
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');
});
Route::resource('orders', OrderController::class);

Route::post('order/invite/{id}', [OrderlogController::class, 'store']);
Route::get('/invites', function () {
    // if (auth()->user() == null) return redirect('/login');
    $orders = Orderlog::latest()->whereDate('created_at', Carbon::today())->where('order_user_id', auth()->user()->id)->get();
    // $orders = auth()->user()->orderlogs->whereDate('created_at', Carbon::today());
    return view('orders.invites', compact('orders'));
})->name('invites');

Route::get('/admin/dashboard', function () {
    if (auth()->user()->admin) {
        return view('dashboard.index');
    } else {
        return redirect('/');
    }
})->name('admin-dashboard');



Route::get('/admin/dashboard/users', function () {
    if (auth()->user()->admin) {
        $users = User::get();
        return view('dashboard.users', compact('users'));
    } else {
        return redirect('/');
    }
})->name('admin-dashboard-users');

Route::get('/admin/dashboard/users/admins', function () {
    if (auth()->user()->admin) {
        $users = User::get()->where('admin', true);
        return view('dashboard.users', compact('users'));
    } else {
        return redirect('/');
    }
})->name('admin-dashboard-admins');

Route::get('/admin/dashboard/users/search', function () {
    $search = $_GET['search'];
    // Search in the title and body columns from the posts table
    $users = User::query()
        ->where('email', 'LIKE', "%{$search}%")
        ->orWhere('name', 'LIKE', "%{$search}%")
        ->latest()
        ->get();
    if (auth()->user()->admin) {
        return view('dashboard.users', compact('users'));
    } else {
        return redirect('/');
    }
});



Route::get('/admin/dashboard/orders', function () {

    $orders = Order::latest()->get();
    // Return the search view with the resluts compacted
    return view('dashboard.orders', compact('orders'));
})->name('admin-dashboard-orders');
