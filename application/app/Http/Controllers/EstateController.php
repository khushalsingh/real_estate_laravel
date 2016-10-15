<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Estate;
use Session;

class EstateController extends Controller {

    private $Estate;

    function __construct() {
        $this->Estate = new \App\Estate();
    }

    function index() {
        Redirect::to(url('/login'));
    }

    function add_property(Request $request) {
        if (!Session::has('user')) {
            return redirect('/login');
        }
        if ($request->method() === 'POST') {
            $validator = Validator::make($request->all(), [
                        'property_name' => 'required',
                        'property_address' => 'required',
                        'property_value' => 'required',
                        'property_mortgage' => 'required',
            ]);
            if (!$validator->fails()) {
                $property_insert_array = array(
                    'property_name' => $request->property_name,
                    'property_address' => $request->property_address,
                    'property_value' => $request->property_value,
                    'property_mortgage' => $request->property_mortgage,
                    'property_status' => '1',
                    'property_created' => date('Y-m-d H:i:s')
                );
                $property_id = $this->Estate->add_property($property_insert_array);
                if ($property_id > 0) {
                    die('1');
                } else {
                    die('0');
                }
            } else {
                dd($validator->errors()->all());
            }
            die('Error!!!');
        }
        return view('estate.add_property');
    }

    function add_tenancy(Request $request) {
        if (!Session::has('user')) {
            return redirect('/login');
        }
        if ($request->method() === 'POST') {
            $validator = Validator::make($request->all(), [
                        'property_id' => 'required',
                        'tenancy_start_date' => 'required',
                        'tenancy_end_date' => 'required',
                        'tenancy_rent' => 'required',
            ]);
            if (!$validator->fails()) {
                $tenancy_insert_array = array(
                    'properties_id' => $request->property_id,
                    'tenancy_start_date' => $request->tenancy_start_date,
                    'tenancy_end_date' => $request->tenancy_end_date,
                    'tenancy_rent' => $request->tenancy_rent,
                    'tenancy_status' => '1',
                    'tenancy_created' => date('Y-m-d H:i:s')
                );
                $tenancy_id = $this->Estate->add_tenancy($tenancy_insert_array);
                if ($tenancy_id > 0) {
                    die('1');
                } else {
                    die('0');
                }
            } else {
                dd($validator->errors()->all());
            }
            die('Error!!!');
        }
        $data = array();
        $data['properties_details_array'] = $this->Estate->get_all_properties();
        return view('estate.add_tenancy')->with($data);
    }

    function add_tenant(Request $request) {
        if (!Session::has('user')) {
            return redirect('/login');
        }
        if ($request->method() === 'POST') {
            $validator = Validator::make($request->all(), [
                        'property_id' => 'required',
                        'tenant_name' => 'required',
                        'tenant_address' => 'required'
            ]);
            if (!$validator->fails()) {
                $tenant_insert_array = array(
                    'properties_id' => $request->property_id,
                    'tenant_name' => $request->tenant_name,
                    'tenant_address' => $request->tenant_address,
                    'tenant_status' => '1',
                    'tenant_created' => date('Y-m-d H:i:s')
                );
                $tenant_id = $this->Estate->add_tenant($tenant_insert_array);
                if ($tenant_id > 0) {
                    die('1');
                } else {
                    die('0');
                }
            } else {
                dd($validator->errors()->all());
            }
            die('Error!!!');
        }
        $data = array();
        $data['tenancies_details_array'] = $this->Estate->get_all_tenancies();
        return view('estate.add_tenant')->with($data);
    }

}
