@extends(getTemplate().'.view.layout.layout')
@section('title')
    {{ !empty($setting['site']['site_title']) ? $setting['site']['site_title'] : 'Website Title' }}
    {{ trans('main.user_login') }}
@endsection
@section('page')
    <style>
        .formBox {
            height: 750px;
        }
    </style>
    <div class="login-s" style="background: url('{{ get_option('login_page_background') }}');min-height: 750px;">
        <div class="h-25"></div>
        <div class="container text-center">
            <div class="formBox level-login" dir="ltr">
                <div class="box boxShaddow"></div>
                <div class="box loginBox">
                    <form class="form" method="post" action="/registerProfessional" style="text-align: left">
                        {{ csrf_field() }}
                        <div class="f_row">
                            <label>{{{ trans('main.professional_name') }}}</label>
                            <input type="text" name="professional_name" valid-title="Fill out this form."
                                   class="input-field validate" required>
                            <u></u>
                        </div>
                        <div class="f_row">
                            <label>{{{ trans('main.professional_document') }}}</label>
                            <input type="text" name="professional_document" valid-title="Fill out this form."
                                   class="input-field validate" maxlength="11" required>
                            <u></u>
                        </div>
                        <div class="f_row">
                            <label>{{{ trans('main.professional_matricula') }}}</label>
                            <input type="text" name="professional_matricula" valid-title="Fill out this form."
                                   class="input-field validate" required>
                            <u></u>
                        </div>
                        <div class="f_row">
                            <label>{{{ trans('main.professional_phone') }}}</label>
                            <input type="text" name="professional_phone" valid-title="Fill out this form."
                                   class="input-field validate" maxlength="11" required>
                            <u></u>
                        </div>
                        <div class="f_row last" style="margin-bottom: 20px;">
                            <label>{{{ trans('main.email') }}}</label>
                            <input type="email" name="email" class="input-field validate"
                                   valid-title="Enter your email address" required>
                            <u></u>
                        </div>
                        <div class="f_row">
                            <label>{{{ trans('main.password') }}}</label>
                            <input type="password" id="r-password" valid-title="Fill out this form." name="password"
                                   class="input-field validate" minlength="6" required>
                            <u></u>
                        </div>
                        <div class="f_row">
                            <label>{{{ trans('main.retype_password') }}}</label>
                            <input type="password" id="r-re-password" name="repassword"
                                   valid-title="Fill out this form." class="input-field validate" required>
                            <u></u>
                        </div>
                        <div class="form-group tab-con">
                            <input type="checkbox" class="input-r" name="terms"
                                   style="display: block;position: relative;top: 16px;width: auto;height: auto"
                                   valid-title="If you want to continue please accept terms and rules" required>
                            <label class="label-r" style="margin-left: 15px;">{{{ trans('main.i_accept') }}} <a
                                    href="/page/pages_terms">{{{ trans('main.term_rules') }}}</a></label>
                        </div>
                        @if(get_option('user_register_captcha') == 1)
                            <div class="form-group tab-con">
{{--                                {!! NoCaptcha::display() !!}--}}
                            </div>
                        @endif
                        <button
                            class="btn btn-custom pull-left btn-register-user btn-register-user-r">{{ trans('main.register_professional') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).keypress(function (e) {
            if (e.which == 13) {
                $('#loginForm').submit();
            }
        });
    </script>
    <script>
        $('.btn-register-user').on('click', function (e) {
            if ($('#r-password').val() != $('#r-re-password').val()) {
                $.notify({
                    message: 'Password & its confirmation are not the same.'
                }, {
                    type: 'danger',
                    allow_dismiss: false,
                    z_index: '99999999',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    position: 'fixed'
                });
                e.preventDefault();
            }
        })
    </script>
    {{--    {!! NoCaptcha::renderJs() !!}--}}
@endsection
