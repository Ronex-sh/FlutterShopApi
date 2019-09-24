@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class ="col-md-12">
            <div class="card">
                <div class="card-header">Units</div>

                    <div class="card-body">


                    {{--@csrf
                        الفورم عندما يتم ارساله في الباك ايند يتم ارسال معه هذه  , وهي تحتوي على توكين حتى السيرفر من يستلم الجواب يتاكد من ان البيانات قادمه من نفس الفورم الي هو ارسلها--}}
                    {{--                    هذا يمنع الحركات السلبيه الي اسمها كروسايد سكربتنك .. اي بختصار هي هوية تعريف لهذا الفورم --}}
 <form action="{{ route('units') }}" method="post" class="row">
     @csrf
    <div class="form-group col-md-6">
        <label for="unit_name">Unit Name</label>
        <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Unit Name" required >
    </div>

    <div class="form-group col-md-6">
        <label for="unit_code">Unit Code</label>
        <input type="text" class="form-control" id="unit_code" name="unit_code" placeholder="Unit Code" required >
    </div>

    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Save New Unit</button>
    </div>

</form>


                <div class="row">

                @foreach($units as $unit)

                 <div class="col-md-3">
                 <div class="alert alert-primary" role="alert">
{{--                              <span>--}}
{{--       <form action="{{route('units')}}" method="post">--}}
{{--                         @csrf--}}
{{--           --}}{{--                             الاشتي ام ال لاتحتوي على ديليتي لذلك نستعمل الانبيت هدين وتكون قيمتها دليتي--}}
{{--                             <input  type="hidden" name="_method" value="delete"/>--}}
{{--                             <input  type="hidden" name="unit_id" value="{{$unit->id}}"/>--}}
{{--                             <button type="submit"class="delete-btn"><i class="far fa-trash-alt"></i></button>--}}

{{--                         </form>--}}
{{--                     </span>--}}
                    <span class="buttons-span">
                         <span><a class="edit-unit" data-unitcode="{{$unit->unit_code}}" data-unitname="{{$unit->unit_name}}" data-unitid="{{$unit->id}}"><i class="fas fa-edit"></i> </a>  </span>
                         <span><a class="delete-unit" data-unitcode="{{$unit->unit_code}}" data-unitname="{{$unit->unit_name}}" data-unitid="{{$unit->id}}"><i class="far fa-trash-alt"></i> </a> </span>
                    </span>



                 <p>{{ $unit->unit_name}},{{ $unit->unit_code}}</p>

                </div>
                </div>
                @endforeach

                </div>

                {{(!is_null($showLinks) && $showLinks)?$units->links():''}}
                        <form action="{{route('search-units')}}" method="get">
                            @csrf
                        <div class="form-group col-md-6">

                            <input type="text" class="form-control" id="unit_search" name="unit_search" placeholder="Search Unit" required >
                        </div>
                            <div class="form-group col-md-6">

                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>

            </div>

            </div>
            </div>
            </div>

            </div>





<div class="modal delete-window" tabindex="-1" role="dialog" id="delete-window">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Unit delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('units')}}" method="post">
            <div class="modal-body">
                <p id="delete-message"></p>

                         @csrf
                          {{--                             الاشتي ام ال لاتحتوي على ديليتي لذلك نستعمل الانبيت هدين وتكون قيمتها دليتي--}}
                             <input  type="hidden" name="_method" value="delete"/>
                             <input  type="hidden" name="unit_id" value="" id="unit_id"/>



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
    <form action="{{ route('units') }}" method="post" >

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                    @csrf
                    <div class="form-group col-md-6">
                        <label for="unit_name">Unit Name</label>
                        <input type="text" class="form-control" id="edit_unit_name" name="unit_name" placeholder="Unit Name" required >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="unit_code">Unit Code</label>
                        <input type="text" class="form-control" id="edit_unit_code" name="unit_code" placeholder="Unit Code" required >
                    </div>

                        <input  type="hidden" name="unit_id" value="" id="edit_unit_id"/>
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
            <strong class="mr-auto">Unit</strong>
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
          var $unitId=$('#unit_id');
          var $deleteMessage=$('#delete-message');
          $deleteUnit.on('click',function (element) {
              element.preventDefault();
              var unit_Id=$(this).data('unitid');
              var unitName=$(this).data('unitname');
              var unitCode=$(this).data('unitcode');
               $unitId.val(unit_Id);
              $deleteMessage.text('are you shore you wont delete this  (' + unitName + ') with code (' + unitCode + ')?');

              $deleteWindow.modal('show');
          });
          var $editUnit=$('.edit-unit');
          var $editWindow=$('#edit-window');

          var $edit_unit_name=$('#edit_unit_name');
          var $edit_unit_code=$('#edit_unit_code');
          var $edit_unit_id=$('#edit_unit_id');
          $editUnit.on('click',function (element) {
              element.preventDefault();
              var unit_Id=$(this).data('unitid');
              var unitName=$(this).data('unitname');
              var unitCode=$(this).data('unitcode');


               $edit_unit_name.val(unitName);
               $edit_unit_code.val(unitCode);
               $edit_unit_id.val(unit_Id);

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
