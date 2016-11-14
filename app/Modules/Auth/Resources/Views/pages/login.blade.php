@extends('admin::layouts.empty', [
    'title' => 'Login'
])

@section('content')

    <div class="login-box">
        <div class="login-logo">
            Flonko
        </div>

        <!-- TODO: make this pretty -->
        @if(session('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
        @endif

        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="{{ route('auth.login.post') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback @if($errors->has('email')) has-error @endif">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <span class="help-block">{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group has-feedback @if($errors->has('password')) has-error @endif">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    <span class="help-block">{{ $errors->first('password') }}</span>
                </div>

                <p class="text-danger">{{ $errors->first('login_attempt') }}</p>


                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" @if(! is_null(old('remember')) ) checked @endif> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                @foreach(social_providers() as $provider => $settings)
                <a href="{{ route('auth.social.redirect', $provider) }}" class="btn btn-block btn-social btn-{{ $provider }} btn-flat"><i class="fa fa-{{  $provider }}"></i> Sign in with
                    {{ ucfirst($provider) }}
                </a>
                @endforeach
            </div>
            <!-- /.social-auth-links -->

            <a href="{{ route('auth.password.reset.get') }}">I forgot my password</a><br>
            @if(config('snijenhuis.auth.register.enabled'))
                <a href="{{ route('auth.register.get') }}" class="text-center">Register a new membership</a>
            @endif
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection

@push('stylesheets')
<link rel="stylesheet" href="/assets/modules/admin/plugins/iCheck/square/blue.css">
@endpush

@push('scripts')
<script src="/assets/modules/admin/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
@endpush