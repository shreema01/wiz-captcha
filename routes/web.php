<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('form');
});


Route::post('/contact', function (Request $request) {

    $request->validate([
        'captcha' => 'required|wiz_captcha',
    ]);

    return "Form submitted successfully";
});


/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('login');
})->name('login');


Route::post('/login', function (Request $request) {

    $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];


    if (config('wiz-captcha.enabled')) {
        $rules['captcha'] = 'required|wiz_captcha';
    }

    $request->validate($rules);

    return "Login successful";
});

/*
|--------------------------------------------------------------------------
| Register
|--------------------------------------------------------------------------
*/

Route::get('/register', function () {
    return view('registration');
})->name('register');

Route::post('/register', function (Request $request) {

    $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ];

    if (config('wiz-captcha.enabled')) {
        $rules['captcha'] = 'required|wiz_captcha';
    }

    $request->validate($rules);

    return "Registration successful";
});