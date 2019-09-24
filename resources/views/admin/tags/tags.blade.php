@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class ="col-md-12">
        <div class="card">
                <div class="card-header">Tags</div>

                <div class="card-body">
                    <form action="{{ route('tags') }}" method="post" class="row">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="tag_name">Tag Name</label>
                            <input type="text" class="form-control" id="tag_name" name="tag_name" placeholder="Tag Name" required >
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Save New Tag</button>
                        </div>

                    </form>

                    <div class="row">

                @foreach($tags as $tag)

                 <div class="col-md-4">
                 <div class="alert alert-primary" role="alert">
                     <span class="buttons-span">
                         <span><a class="edit-unit" data-tagname="{{$tag->tag}}" data-tagid="{{$tag->id}}"><i class="fas fa-edit"></i> </a>  </span>
                         <span><a class="delete-unit"  data-tagname="{{$tag->tag}}" data-tagid="{{$tag->id}}"><i class="far fa-trash-alt"></i> </a> </span>
                    </span>




                 <p>{{ $tag->tag}}</p>

                </div>
                </div>

                @endforeach
                </div>
                    {{(!is_null($showLinks) && $showLinks)?$tags->links():''}}

                    <form action="{{route('search-tags')}}" method="get">
                        @csrf
                        <div class="form-group col-md-6">

                            <input type="text" class="form-control" id="tag_search" name="tag_search" placeholder="Search Tag" required >
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
                    <h5 class="modal-title">Tag delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('tags')}}" method="post">
                    <div class="modal-body">
                        <p id="delete-message"></p>

                        @csrf
                        {{--                             الاشتي ام ال لاتحتوي على ديليتي لذلك نستعمل الانبيت هدين وتكون قيمتها دليتي--}}
                        <input  type="hidden" name="_method" value="delete"/>
                        <input  type="hidden" name="tag_id" value="" id="tag_id"/>



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
        <form action="{{ route('tags') }}" method="post" >

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        @csrf
                        <div class="form-group col-md-6">
                            <label for="tag_name">Tag Name</label>
                            <input type="text" class="form-control" id="edit_tag_name" name="tag_name" placeholder="Tag Name" required >
                        </div>

                        <input  type="hidden" name="tag_id" value="" id="edit_tag_id"/>
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
                <strong class="mr-auto">Tag</strong>
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
                var $tagID=$('#tag_id');
                var $deleteMessage=$('#delete-message');
                $deleteUnit.on('click',function (element) {
                    element.preventDefault();
                    var tag_Id=$(this).data('tagid');

                    $tagID.val(tag_Id);
                    $deleteMessage.text('are you shore you wont delete this  tag?');

                    $deleteWindow.modal('show');
                });
                var $editTag=$('.edit-tag');
                var $editWindow=$('#edit-window');

                var $edit_tag_name=$('#edit_tag_name');
                var $edit_tag_id=$('#edit_tag_id');
                $editTag.on('click',function (element) {
                    element.preventDefault();
                    var tag_Id=$(this).data('tagid');
                    var tagName=$(this).data('tagname');



                    $edit_tag_name.val(tagName);
                    $edit_tag_id.val(tag_Id);

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
