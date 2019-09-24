@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class ="col-md-12">
        <div class="card">
                <div class="card-header">Categories</div>

                <div class="card-body">
                    <form action="{{ route('categories') }}" method="post" class="row">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="category_name">Tag Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" required >
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Save New Category</button>
                        </div>

                    </form>
                <div class="row">

                @foreach($categories as $category)

                 <div class="col-md-3">
                 <div class="alert alert-primary" role="alert">
                     <span class="buttons-span">
                         <span><a class="edit-unit" data-categoryname="{{$category->name}}" data-categoryid="{{$category->id}}"><i class="fas fa-edit"></i> </a>  </span>
                         <span><a class="delete-unit"  data-categoryname="{{$category->name}}" data-categoryid="{{$category->id}}"><i class="far fa-trash-alt"></i> </a> </span>
                    </span>

                 <p>{{ $category->name}}</p>

                </div>
                </div>
                @endforeach

                </div>
                    {{(!is_null($showLinks) && $showLinks)?$categories->links():''}}

                    <form action="{{route('search-categories')}}" method="get">
                        @csrf
                        <div class="form-group col-md-6">

                            <input type="text" class="form-control" id="category_search" name="category_search" placeholder="Search Category" required >
                        </div>
                        <div class="form-group col-md-6">

                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
            </div>
            </div>
            </div>
            </div>

    <div class="modal delete-window" tabindex="-1" role="dialog" id="delete-window">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Category delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('categories')}}" method="post">
                    <div class="modal-body">
                        <p id="delete-message"></p>

                        @csrf
                        {{--                             الاشتي ام ال لاتحتوي على ديليتي لذلك نستعمل الانبيت هدين وتكون قيمتها دليتي--}}
                        <input  type="hidden" name="_method" value="delete"/>
                        <input  type="hidden" name="category_id" value="" id="category_id"/>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal edit-window" tabindex="-1" role="dialog" id="edit-window">
        <form action="{{ route('categories') }}" method="post" >

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        @csrf
                        <div class="form-group col-md-6">
                            <label for="category_name">Category Name</label>
                            <input type="text" class="form-control" id="edit_category_name" name="category_name" placeholder="Category Name" required >
                        </div>

                        <input  type="hidden" name="category_id" value="" id="edit_category_id"/>
                        <input  type="hidden" name="_method" value="PUT"/>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </div>
                </div>
            </div>
        </form>

    </div>

    @if(Session::has('message'))
        <div class="toast" style="position: absolute; top: 9%; right: 6%;">
            <div class="toast-header">
                <img src="..." class="rounded mr-2" alt="...">
                <strong class="mr-auto">Category</strong>
                <small>@php
                        $ldate = date('H:i:s');
                        echo $ldate

                    @endphp
                </small>
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


        <script>
            // نستخدم علامة الدولار اذا كان المتغير يساوي عنصر يحتوي على خصائص  وذلك لغرض تذكير المبرمج  لاحقا انه يتعامل مع عنصر ولانستخدم علامة الدولار في المتغير العادي الذي قد تكون قيمته رقم او سترنج او قيم عاديه
            $(document).ready(function () {
                var $deleteUnit=$('.delete-unit');
                var $deleteWindow=$('#delete-window');
                var $categoryID=$('#category_id');
                var $deleteMessage=$('#delete-message');
                $deleteUnit.on('click',function (element) {
                    element.preventDefault();
                    var cat_Id=$(this).data('categoryid');

                    $categoryID.val(cat_Id);
                    $deleteMessage.text('are you shore you wont delete this  category?');

                    $deleteWindow.modal('show');
                });
                var $editCat=$('.edit-unit');
                var $editWindow=$('#edit-window');

                var $edit_cat_name=$('#edit_category_name');
                var $edit_cat_id=$('#edit_category_id');
                $editCat.on('click',function (element) {
                    element.preventDefault();
                    var cat_Id=$(this).data('categoryid');
                    var catName=$(this).data('categoryname');



                    $edit_cat_name.val(catName);
                    $edit_cat_id.val(cat_Id);

                    $editWindow.modal('show');

                });


            });
        </script>

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
