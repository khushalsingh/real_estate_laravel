<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;
use Session;

class AuthController extends Controller {

    function _error() {
        die('Something went gone wrong!!!');
    }

    function login(Request $request) {
        if (Session::has('user')) {
            return redirect('/dashboard');
        }
        if ($request->method() === 'POST') {
            $validator = Validator::make($request->all(), [
                        'user_login' => 'required',
                        'user_login_password' => 'required'
            ]);
            if (!$validator->fails()) {
                $user_details_array = User::where('email', $request->user_login)->first();
                if (count($user_details_array) > 0 && Hash::check(trim($request->user_login_password), $user_details_array->password)) {
                    Session::push('user', $user_details_array);
                    Session::save();
                    die('1');
                }
                die('Incorrect email or password.');
            } else {
                dd($validator->errors()->all());
            }
            $this->_error();
        }
        return view('auth.login');
    }

}
