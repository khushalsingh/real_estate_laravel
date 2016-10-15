<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Estate extends Model {

    function add_property($property_insert_array) {
        return DB::table('properties')->insertGetId($property_insert_array);
    }

    function get_all_properties() {
        return DB::table('properties')->where('property_status', '1')->get();
    }

    function add_tenancy($tenancy_insert_array) {
        return DB::table('tenancies')->insertGetId($tenancy_insert_array);
    }

    function get_all_tenancies() {
        return DB::table('tenancies')
                        ->leftjoin('properties', 'properties.property_id', '=', 'tenancies.properties_id')
                        ->where('tenancy_status', '1')
                        ->get();
    }

    function add_tenant($tenant_insert_array) {
        return DB::table('tenants')->insertGetId($tenant_insert_array);
    }

}
