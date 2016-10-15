@extends('templates.common')

@section('content') 
<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <div class="well">
            <h2>Login to Real Estate</h2>
            <p>Please login below if you already have an account with us.</p>
            <p class="login-msg-box"></p>
            <form id="user_login_form" action="" method="post" role="form">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
                <div class="form-group">
                    <label for="user_login">Email</label>
                    <input name="user_login" id="user_login" class="form-control" placeholder="Email" type="text">
                </div>
                <div class="form-group">
                    <label for="user_login_password">Password</label>
                    <input name="user_login_password" id="user_login_password" class="form-control" placeholder="Password" autocomplete="off" type="password">
                </div>                
                <div class="pull-right">
                    <button id="user_login_button" type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.min.js"></script>
<script src="{{ url('/') }}/assets/js/plugins/md5.min.js"></script>
<script src="{{ url('/') }}/assets/js/plugins/base64.min.js"></script>
<script type="text/javascript">
$(function () {
    $("#user_login_button").click(function () {
        $("#user_login_form").validate({
            errorElement: 'span', errorClass: 'help-block',
            rules: {
                user_login: {
                    required: true,
                    email: true
                },
                user_login_password: {
                    required: true
                }
            },
            messages: {
                user_login: {
                    required: "Please enter email address.",
                    email: "Please enter a valid email address."
                },
                user_login_password: {
                    required: "Please enter password"
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
                $.post(base_url + 'login', $('#user_login_form').serialize(), function (data) {
                    if (data === '1') {
                        document.location.href = base_url + 'dashboard';
                    } else if (data === '0') {
                        $('.alert-login').css('display', 'block');
                    } else {
                        bootbox.alert(data);
                    }
                });
            }
        });
    });
});
</script>
@endsection

