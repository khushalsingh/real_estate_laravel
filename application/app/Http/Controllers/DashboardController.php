<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;

class DashboardController extends Controller {

    function index() {
        if (!Session::has('user')) {
            return redirect('/login');
        }
        return view('dashboard.index');
    }

}
