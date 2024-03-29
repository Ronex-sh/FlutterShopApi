@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class ="col-md-12">
        <div class="card">
                <div class="card-header">Products <a class="btn-btn-primary" href="{{route('new-product')}}"><i class="fas fa-plus-square"></i></a></div>


                <div class="card-body">
                <div class="row">

                @foreach($products as $product)

                 <div class="col-md-4">
                 <div class="alert alert-primary" role="alert">

                 <h4>{{ $product->title}}</h4>
                 <p>Category: {{ (is_object($product->category) )?$product->category->name:''}}</p>
                     <p> price: {{$currence_code}} {{$product->price}}</p>

                     @php
                     $imageUrl='';
                     if(count($product->images)>0){
                     if(strpos($product->images[0]->url,'https') !==false||strpos($product->images[0]->url,'http')!==false){
                     $imageUrl=$product->images[0]->url;

                     }else{
                     $imageUrl=asset('storage/',$product->images[0]->url);
                     }
                     }

                     @endphp



                 {!!(count($product->images) > 0)?'<img class="img-thumbnail card-img"src="' .$product->images[0]->url.'"/>':'' !!}



{{--                     @if(!is_null($product->options))--}}

{{--                         @foreach($product->jsonOptions() as $key => $values)--}}
{{--                             <div class="row">--}}
{{--                                 <div class="form-group col-md-12">--}}
{{--                                     <label for="{{$key}}">{{$key}}</label>--}}
{{--                                     <select type="text" class="form-control" name="{{$key}}" id="{{$key}}">--}}
{{--                                         @foreach($values as $value)--}}
{{--                                             <option value="{{$value}}">{{$value}}</option>--}}
{{--                                         @endforeach--}}
{{--                                     </select>--}}
{{--                                 </div>--}}
{{--                             </div>--}}
{{--                         @endforeach--}}
{{--                     @endif--}}




{{--                     @if(! is_null($product->options))--}}
{{--                         @foreach($product->jsonOptions() as $optionKey=> $options)--}}
{{--                             <table class="table-bordered table">--}}
{{--                             @foreach($options as $option)--}}
{{--                                 <tr>--}}
{{--                                     <td> {{$optionKey}} </td>--}}
{{--                                     <td> {{$option}} </td>--}}
{{--                                 </tr>--}}

{{--                             @endforeach--}}
{{--                             @endforeach--}}
{{--                             </table>--}}
{{--                         @endif--}}

                     <a class="btn btn-success mt-2" href="{{route('update-product-form', ['id' => $product->id]) }}">Update Product </a>


                </div>
                </div>

                @endforeach

                </div>

                {{$products->links()}}
            </div>
            </div>
            </div>
            </div>

    @if(Session::has('message'))
        <div class="toast" style ="position: absolute; z-index: 999999; top: 5%; right: 5%;">
            <div class="toast-header">
                <strong class="mr-auto">Products</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">

                {{Session::get('message')}}

            </div>
        </div>
    @endif
    @endsection
    @section('scripts')

        @if(Session::has('message'))
            <script>
                jQuery(document).ready(function ($) {
                    //alert('im here');
                    var  $toast= $('.toast').toast({
                        autohide:false
                    });
                    $toast.toast('show');
                });
            </script>
@endif


@endsection
