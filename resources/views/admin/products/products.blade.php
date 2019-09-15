@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class ="col-md-12">
        <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                <div class="row">
               
                @foreach($products as $product)
                
                 <div class="col-md-4">
                 <div class="alert alert-primary" role="alert">
                 
                 <h4>{{ $product->title}}</h4>
                 <p>Category: {{$product->category->name}}</p>
                 <p> price: {{$currence_code}} {{$product->price}}

                 {!!(count($product->images) > 0)?'<img class="img-thumbnail card-img"src="' .$product->images[0]->url.'"/>':'' !!}


                 <!-- <img src="{{(count($product->images) > 0)? $product->images[0]->url:''}}" alt="" class="img-thumbnail card-img">  -->
                 
                </div>
                </div>
                @endforeach
               
                </div>
                {{$products->links()}}
            </div>
            </div>
            </div>
            </div>


@endsection