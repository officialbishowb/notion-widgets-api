<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Log;

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

# Main route
Route::get('/', function () {
    return view('index');
});



# Login and Register route and other non dashboard routes

Route::get('/register', function () {
    return view('register');
});


Route::get('/login', function () {
    return view('login');
});

Route::post('/register_me', [RegisterController::class, 'registerUser']);
Route::post('/letme_in', [LoginController::class, 'loginUser']);


Route::get('/verify_email', function(){
    $token = request('token');

    if($token){
        $regs = new RegisterController();
        if($regs->verifyEmail($token)) {
            return redirect('/dashboard');
        } else {
            return redirect('/login');
        }
        
    }
});


Route::get('/pricing', function(){
    return view('pricing');
});


# Dashboard route
Route::get('/dashboard', function () {
    if(session()->has('username_')){
        return view('/dashboard/index');
    }
    return redirect('/login');
});

Route::get('/profile', function () {
    if(session()->has('username_')){
        return view('/dashboard/profile');
    }
    return redirect('/login');
});

Route::get('/logout', function () {
    if(session()->has('username_')){
        session()->forget('username_');
        return redirect('/login');
    }
});

Route::get('/reset_password', function () {
    return view('/reset_password');
});



Route::get('/widget/{id}', function ($widget_id) {
    if(session()->has('username_')){
        return view('/dashboard/widget',[
            'widget_id' => $widget_id
        ]);
    }
    return redirect('/login');
});



Route::get('/embed/widgets/{widget_name}/{data}', function ($widget_name,$widget_data) {
    if(session()->has('username_')){
        return view('/dashboard/embed/widgets/'.$widget_name,[
            'widget_data' => $widget_data
        ]);
    }
    return redirect('/login');
});
  
