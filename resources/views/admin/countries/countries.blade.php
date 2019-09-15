@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class ="col-md-12">
        <div class="card">
                <div class="card-header">Tags</div>

                <div class="card-body">
                <div class="row">
               
                @foreach($countries as $country)
                
                 <div class="col-md-4">
                 <div class="alert alert-primary" role="alert">
                 
                 <h4>{{ $country->name}}</h4>
                 <p>{{ $country->capital}}</p>
                 <p>{{ $country->currency}}</p>
                

                 
                 
                </div>
                </div>
                @endforeach
               
                </div>
                {{$countries->links()}}
            </div>
            </div>
            </div>
            </div>


@endsection