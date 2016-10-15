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
            <h2>Add Tenancy</h2>
            <p class="login-msg-box"></p>
            <form id="add_tenancy_form" action="" method="post" role="form">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
                <div class="form-group">
                    <label for="property_id">Property Name</label>
                    <select class="form-control" name="property_id" data-placeholder="Select Property">
                        <option></option>
                        @foreach ($properties_details_array as $property_details)
                        <option value="{{ $property_details->property_id }}">{{ $property_details->property_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tenancy_start_date">Start Date</label>
                    <input name="tenancy_start_date" class="form-control" placeholder="Start Date">
                </div> 
                <div class="form-group">
                    <label for="tenancy_end_date">End Date</label>
                    <input name="tenancy_end_date" class="form-control" placeholder="End Date">
                </div> 
                <div class="form-group">
                    <label for="tenancy_rent">Tenancy Rent</label>
                    <input name="tenancy_rent" class="form-control" placeholder="Tenancy Rent">
                </div> 
                <div class="pull-right">
                    <button id="add_tenancy_button" type="submit" class="btn btn-primary">Add Tenancy</button>
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
    $("#add_tenancy_form").validate({
        errorElement: 'span', errorClass: 'help-block',
        rules: {
            property_id: {
                required: true
            },
            tenancy_start_date: {
                required: true
            },
            tenancy_end_date: {
                required: true
            },
            tenancy_rent: {
                required: true
            }
        },
        messages: {
            property_id: {
                required: "Please select Property"
            },
            tenancy_start_date: {
                required: "Please select Start Date"
            },
            tenancy_end_date: {
                required: "Please select End Date"
            },
            tenancy_rent: {
                required: "Please enter Tenancy Rent"
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
            $.post(base_url + 'add_tenancy', $('#add_tenancy_form').serialize(), function (data) {
                if (data === '1') {
                    bootbox.alert("Tenancy has been added successfully.", function () {
                        document.location.href = base_url + 'add_tenancy';
                    });
                } else if (data === '0') {
                    bootbox.alert("Error in adding tenancy!!!");
                } else {
                    bootbox.alert(data);
                }
            });
        }
    });
});
</script>
@endsection
