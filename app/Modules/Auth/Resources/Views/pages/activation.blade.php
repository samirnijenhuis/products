@extends('admin::layouts.empty', [
    'title' => 'Activate'
])

@section('content')

    {{--<div class="login-box">--}}
        {{--<div class="login-logo">--}}
            @foreach($errors->all() as $error)
                <h1>{{ $error }}</h1>
            @endforeach

        {{--</div>--}}
    {{--</div>--}}
    <!-- /.login-box -->
@endsection
