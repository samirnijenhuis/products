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
                <p class="login-box-msg">Set a new password</p>

                <form action="{{ route('auth.password.create.post', ['code' => $code, 'id' => $id]) }}" method="post">
                    {{ csrf_field() }}

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

                    <p class="text-danger">{{ $errors->first('create_attempt') }}</p>



                    <div class="row">
                        <!-- /.col -->
                        <div class="col-xs-4 pull-right">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
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
