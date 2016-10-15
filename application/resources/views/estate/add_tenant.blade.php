@extends('templates.administrator')

@section('content') 
<style>
    .select2-selection {
        min-height: 32px !important;
    }
</style>
<div class="row">
    <div class="col-md-6">
        <div class="well">
            <h2>Add Tenant</h2>
            <p class="login-msg-box"></p>
            <form id="add_tenant_form" action="" method="post" role="form">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
                <div class="form-group">
                    <label for="property_id">Property Name</label>
                    <select class="form-control" name="property_id" data-placeholder="Select Property">
                        <option></option>
                        @foreach ($tenancies_details_array as $tenancy_details)
                        <option value="{{ $tenancy_details->property_id }}">{{ $tenancy_details->property_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tenant_name">Tenant Name</label>
                    <input name="tenant_name" class="form-control" placeholder="Tenant Name">
                </div>
                <div class="form-group">
                    <label for="tenant_address">Tenant Address</label>
                    <input name="tenant_address" class="form-control" placeholder="Tenant Address">
                </div>      
                <div class="pull-right">
                    <button id="add_tenant_button" type="submit" class="btn btn-primary">Add Tenant</button>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
$(function () {
    $('select').select2();
    $("#add_tenant_form").validate({
        errorElement: 'span', errorClass: 'help-block',
        rules: {
            property_id: {
                required: true
            },
            tenant_name: {
                required: true
            },
            tenant_address: {
                required: true
            }
        },
        messages: {
            property_id: {
                required: "Please select Property"
            },
            tenant_name: {
                required: "Please enter Property Name"
            },
            tenant_address: {
                required: "Please enter Property Address"
            }
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        success: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
            $(element).closest('.form-group').children('span.help-block').remove();
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.closest('.form-group'));
        },
        submitHandler: function (form) {
            $.post(base_url + 'add_tenant', $('#add_tenant_form').serialize(), function (data) {
                if (data === '1') {
                    bootbox.alert("Tenant has been added successfully.", function () {
                        document.location.href = base_url + 'add_tenant';
                    });
                } else if (data === '0') {
                    bootbox.alert("Error in adding tenant!!!");
                } else {
                    bootbox.alert(data);
                }
            });
        }
    });
});
</script>
@endsection
