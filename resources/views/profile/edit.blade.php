@extends('admin::layouts.default', [
    'title' => 'Types'
])

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Profile</h3>
                </div>
                <!-- /.box-header -->

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="box-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        {{ method_field('put') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="{{ old('first_name', $user->first_name) }}">
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" value="{{ old('last_name', $user->last_name) }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="form-group">
                            <label for="password">New password (min 6 characters)</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="password" value="{{ old('password') }}">
                        </div>

                        <button type="submit" class="btn btn-default">Save</button>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>


@endsection