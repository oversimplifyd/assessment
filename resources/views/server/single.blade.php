@extends('layouts.app')

@section('content')

    <style>

        #post-frame p{
            margin-top: 2em;
            font-weight: bolder;
        }

        #description {
            text-align: justify;
        }

        @media (max-width: 640px) {
            .col-md-10.col-sm-10.col-xs-10.col-md-offset-1.col-sm-offset-1 {
                padding: 0;
                margin-left: 8%;
            }
        }
    </style>

    <div class="container">

        <div id="printPdf" class="row">
            <div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1 col-sm-offset-1 well">
                <div id="description">
                    <h2>Server Info.</h2>
                    <p>AssetId: {{$server->asset_id}}</p>
                    <p>Name: {{$server->name}}</p>
                    <p>Brand: {{$server->brand}}</p>
                    <p>Price: {{$server->price}}</p>
                    <hr>
                    <h3>Available Rams</h3>
                    @if($server->rams->count() > 0)
                        @foreach($server->rams as $ram)
                            <div>
                                <h4>Ram Info.</h4>
                                <p>Type: {{$ram->type}}</p>
                                <p>Size: {{$ram->size}} GB</p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection