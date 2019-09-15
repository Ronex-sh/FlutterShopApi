@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class ="col-md-12">
        <div class="card">
                <div class="card-header">Cities</div>

                <div class="card-body">
                <div class="row">
               
                @foreach($states as $state)
                
                 <div class="col-md-4">
                 <div class="alert alert-primary" role="alert">
                 
                 <h1>{{ $state->name}}</h1>
                 <p>Country: {{ $state->country->name}}</p>
              
                 
               
                

                 
                 
                </div>
                </div>
                @endforeach
               
                </div>
                {{$states->links()}}
            </div>
            </div>
            </div>
            </div>


@endsection