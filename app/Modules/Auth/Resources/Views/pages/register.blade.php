@extends('admin::layouts.empty', [
    'title' => 'Register'
])

@section('content')
    <div class="register-box">
        <div class="register-logo">
            Flonko
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>

            <form action="{{ route('auth.register.post') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback @if($errors->has('first_name')) has-error @endif">
                    <input type="text" class="form-control" placeholder="First name" name="first_name" value="{{ old('first_name') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <span class="help-block">{{ $errors->first('first_name') }}</span>
                </div>
                <div class="form-group has-feedback @if($errors->has('last_name')) has-error @endif">
                    <input type="text" class="form-control" placeholder="Last name" name="last_name" value="{{ old('last_name') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <span class="help-block">{{ $errors->first('last_name') }}</span>
                </div>
                <div class="form-group has-feedback @if($errors->has('email')) has-error @endif">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <span class="help-block">{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group has-feedback @if($errors->has('password')) has-error @endif">
                    <input type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <span class="help-block">{{ $errors->first('password') }}</span>
                </div>
                <div class="form-group has-feedback @if($errors->has('password')) has-error @endif">
                    <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation" value="{{ old('password_confirmation') }}">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    <span class="help-block">{{ $errors->first('password') }}</span>
                </div>

                <p class="text-danger">{{ $errors->first('register_attempt') }}</p>


                <div class="row">
                    <div class="col-xs-4 pull-right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                @foreach(social_providers() as $provider => $settings)
                    <a href="{{ route('auth.social.redirect', $provider) }}" class="btn btn-block btn-social btn-{{ $provider }} btn-flat"><i class="fa fa-{{  $provider }}"></i> Sign up using
                        {{ ucfirst($provider) }}
                    </a>
                @endforeach
            </div>

            <a href="{{ route('auth.login.get') }}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

@endsection