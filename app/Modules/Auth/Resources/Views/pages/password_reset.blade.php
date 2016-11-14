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
                <p class="login-box-msg">Reset your password</p>

                <form action="{{ route('auth.password.reset.post') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback @if($errors->has('email')) has-error @endif">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    </div>
                    <p class="text-danger">{{ $errors->first('reset_attempt') }}</p>


                    <div class="row">
                        <!-- /.col -->
                        <div class="col-xs-4 pull-right">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Reset</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="text-center">
                    <p>- OR -</p>
                </div>

                <a href="{{ route('auth.login.get') }}" class="text-center">Login</a>
            </div>
            <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection
