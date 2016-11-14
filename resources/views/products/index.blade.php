@extends('admin::layouts.default', [
    'title' => 'Products'
])

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Products</h3>
                    <a href="{{ route('products.create') }}" class="pull-right">New</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table">
                        <tr>
                            {{--<th style="width: 10px">#</th>--}}
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Stock</th>
                            <th>Action</th>
                            {{--<th style="width: 40px">Label</th>--}}
                        </tr>

                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>&euro;{{ number_format($product->price, 2, ',', '.') }}</td>
                                <td>{{ $product->type->name }}</td>
                                <td>{{ $product->stock->option }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}">
                                        <span class="glyphicon glyphicon-pencil"></span> Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
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