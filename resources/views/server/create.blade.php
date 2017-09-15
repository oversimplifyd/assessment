@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1 col-sm-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <a class="btn btn-success" href="{{ URL::previous() }}">Back</a>
                        <span> Add New Server</span>
                    </div>
                    <div class="panel-body">
                        @if (Session::has("success"))
                            <span class="alert alert-success">
                            <strong>Server added successfully..</strong>
                        </span>
                        @endif

                        @if (count($errors) > 0)
                            <span class="alert alert-danger">
                                    <strong>{{ $errors->first() }}</strong>
                                </span>
                        @endif


                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="/servers">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title" class="control-label col-sm-4 ">Asset Id</label>
                                <div class="col-sm-8">
                                    <input name="asset_id" class="form-control" value="{{ old('asset_id')}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="control-label col-sm-4 ">Name</label>
                                <div class="col-sm-8">
                                    <input name="name" class="form-control" value="{{ old('name')}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="control-label col-sm-4 ">Brand</label>
                                <div class="col-sm-8">
                                    <input name="brand" class="form-control" value="{{ old('brand')}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="control-label col-sm-4 ">Price</label>
                                <div class="col-sm-8">
                                    <input name="price" class="form-control" value="{{ old('price')}}">
                                </div>
                            </div>

                            <div id="ram-section">
                                <hr>
                                <h4 style="text-align: center;">RAMS</h4>
                                <div class="form-group">
                                    <label class="control-label col-sm-2 ">Type</label>
                                    <div class="col-sm-4">
                                        <input name="rams[0][type]" class="form-control" required>
                                    </div>
                                    <label class="control-label col-sm-2 ">Size</label>
                                    <div class="col-sm-4">
                                        <input name="rams[0][size]" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2 ">Type</label>
                                    <div class="col-sm-4">
                                        <input name="rams[1][type]" class="form-control" required>
                                    </div>
                                    <label class="control-label col-sm-2 ">Size</label>
                                    <div class="col-sm-4">
                                        <input name="rams[1][size]" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2 ">Type</label>
                                    <div class="col-sm-4">
                                        <input name="rams[2][type]" class="form-control" required>
                                    </div>
                                    <label class="control-label col-sm-2 ">Size</label>
                                    <div class="col-sm-4">
                                        <input name="rams[2][size]" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2 ">Type</label>
                                    <div class="col-sm-4">
                                        <input name="rams[3][type]" class="form-control" required>
                                    </div>
                                    <label class="control-label col-sm-2 ">Size</label>
                                    <div class="col-sm-4">
                                        <input name="rams[3][size]" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-8 pull-right">
                                    <button type="submit" class="btn btn-success">GO!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection