@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class ="col-md-12">
        <div class="card">
                <div class="card-header">Cities</div>

                <div class="card-body">
                <div class="row">
               
                @foreach($cities as $city)
                
                 <div class="col-md-4">
                 <div class="alert alert-primary" role="alert">
                 
                 <h1>{{ $city->name}}</h1>
                 <h2>state:{{ $city->state->name}}</h2>
                 <h3>country:{{ $city->country->name}}</h3>
                 
               
                

                 
                 
                </div>
                </div>
                @endforeach
               
                </div>
                {{$cities->links()}}
            </div>
            </div>
            </div>
            </div>


@endsection