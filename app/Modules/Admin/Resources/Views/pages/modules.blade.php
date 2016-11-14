@extends('admin::layouts.default', [
    'title' => 'Modules'
])

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Installed modules</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table">
                        <tr>
                            {{--<th style="width: 10px">#</th>--}}
                            <th>Name</th>
                            <th>Description</th>
                            <th>Version</th>
                            <th>Enabled</th>
                            {{--<th style="width: 40px">Label</th>--}}
                        </tr>

                        @foreach($modules as $module)
                        <tr>
                            <td>{{ $module['name'] }}</td>
                            <td>{{ $module['description'] }}</td>
                            <td>{{ $module['version'] }}</td>
                            <td>
                                @if($module['enabled'])
                                    <span class="label label-success">Enabled</span>
                                @else
                                    <span class="label label-danger">Disabled</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach


                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>


@endsection