@extends('layouts.app')

@section('content')

    <style>

        .ui-autocomplete.ui-front.ui-menu li {
            list-style: none;
            font-weight: bold;
        }

        .ui-autocomplete.ui-front.ui-menu li:hover {
            background-color: #F5F5F5;
        }

        .title-box {
            font-size: larger;
            padding: 2em;
            background-color: #000;
            color: white;
            text-transform: capitalize;
            text-align: center;
            height: 150px;
        }

        .title-box:hover {
            cursor: pointer;
            background-color: white;
            border: 2px solid rgb(0, 100, 100);
            color: black;
        }

        .detail-box {
            padding: 0.5em;
            background-color: rgb(0, 100, 100);
            color: #fff;
            font-size: small;
        }

        .col-md-3.col-sm-3.col-xs-3 {
            margin-bottom: 1em;
        }

        #posts {
            margin-top: 2em;
        }

        @media (max-width: 640px) {
            .col-md-3.col-sm-3.col-xs-3 {
                width: 100%;
            }
        }
    </style>

    <div class="container">

        @if($servers->count() > 0)
            <div id='posts' class="row">
                @foreach($servers as $server)
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <a href="/servers/{{$server->id}}"><div class="title-box"><p>{{$server->name}}</p><p>{{$server->brand}}</p></div></a>
                        <div class="detail-box"><p><span>Added: {{$server->created_at->diffForHumans()}}</span></p></div>
                    </div>
                    <div class="detail-box">
                        <form action="{{ url('servers/'.$server->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-xs btn-danger">
                                <i class="fa fa-btn fa-trash"></i>Remove
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            @if(method_exists($servers, "links"))
                <div id="links">{{$servers->links()}}</div>
            @endif
        @else
            <p><strong>There are no servers...</strong></p>
        @endif

    </div>
@endsection