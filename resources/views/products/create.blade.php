@extends('admin::layouts.default', [
    'title' => 'Products'
])

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Product</h3>
                </div>

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('products.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{ old('description') }}">
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{ old('description') }}">
                        </div>

                        <div class="form-group">
                            <label for="type_id">Type</label>
                            <select name="type_id" id="type_id">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="stock_id">Stock</label>
                            <select name="stock_id" id="stock_id">
                                @foreach($stock as $stock_option)
                                    <option value="{{ $stock_option->id }}">{{ $stock_option->option }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-default">Create</button>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>


@endsection