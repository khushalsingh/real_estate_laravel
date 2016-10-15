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
            <h2>Add Property</h2>
            <p class="login-msg-box"></p>
            <form id="add_property_form" action="" method="post" role="form">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
                <div class="form-group">
                    <label for="property_name">Property Name</label>
                    <input name="property_name" class="form-control" placeholder="Property Name" type="text">
                </div>
                <div class="form-group">
                    <label for="property_address">Property Address</label>
                    <input name="property_address" class="form-control" placeholder="Property Address">
                </div> 
                <div class="form-group">
                    <label for="property_value">Property value</label>
                    <input name="property_value" class="form-control" placeholder="Property Value">
                </div>
                <div class="form-group">
                    <label for="property_mortgage">Mortgage</label>
                    <select class="form-control" name="property_mortgage" data-placeholder="Select Mortgage">
                        <option></option>
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                    </select>
                </div>
                <div class="pull-right">
                    <button id="add_property_button" type="submit" class="btn btn-primary">Add Property</button>
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
        $("#add_property_form").validate({
            errorElement: 'span', errorClass: 'help-block',
            rules: {
                property_name: {
                    required: true
                },
                property_address: {
                    required: true
                },
                property_value: {
                    required: true
                },
                property_mortgage: {
                    required: true
                }
            },
            messages: {
                property_name: {
                    required: "Please enter Property Name"
                },
                property_address: {
                    required: "Please enter Property Address"
                },
                property_value: {
                    required: "Please enter Property Value"
                },
                property_mortgage: {
                    required: "Please select Property Mortgage"
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
                $.post(base_url + 'add_property', $('#add_property_form').serialize(), function (data) {
                    if (data === '1') {
                        bootbox.alert("Property has been added successfully.", function () {
                            document.location.href = base_url + 'add_property';
                        });
                    } else if (data === '0') {
                        bootbox.alert("Error in adding property!!!");
                    } else {
                        bootbox.alert(data);
                    }
                });
            }
        });
    });
</script>
@endsection
