@extends('admin::layouts.default', [
    'title' => 'Types'
])

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Types</h3>
                    <a href="{{ route('types.create') }}" class="pull-right">New</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table">
                        <tr>
                            {{--<th style="width: 10px">#</th>--}}
                            <th>Name</th>
                            <th>Action</th>
                            {{--<th style="width: 40px">Label</th>--}}
                        </tr>

                        @foreach($types as $type)
                            <tr>
                                <td>{{ $type->name }}</td>
                                <td>
                                    <a href="{{ route('types.edit', $type->id) }}">
                                        <span class="glyphicon glyphicon-pencil"></span> Edit
                                    </a>
                                    <form action="{{ route('types.destroy', $type->id) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button class="btn-link no-padding"> <span class="glyphicon glyphicon-remove"></span> Delete </button>
                                    </form>
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