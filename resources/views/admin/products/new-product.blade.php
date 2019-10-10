@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class ="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {!! !is_null($product) ?  ' update Product <span class ="product-header-title"> ' . $product->title . '</span>' :' New Product ' !!}
                    </div>

                    <div class="card-body">

                        <form action="{{ (!is_null($product))? route('update-product'): route('new-product')}}" method="post" class="row" enctype="multipart/form-data">
                            @csrf
                            @if(!is_null($product))
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                            @endif

                            <div class="form-group col-md-12">
                                <label for="product_title">product Title</label>
                                <input type="text" class="form-control" id="product_title"
                                       name="product_title" placeholder="product Title" required
                                       value="{{(!is_null($product))?$product->title:''}}" >
                            </div>
                            <div class="form-group col-md-12">

                                <label for="product_title">product Description</label>
                                  <textarea placeholder="Description" class="form-control" name="product_description" id="product_description" cols="30" rows="10" required>
                                     {{(!is_null($product))? $product->description:''}} </textarea>

                            </div>
                            <div class="form-group col-md-12">

                                <label for="product_category">product Category</label>
                                <select class="form-control" name="product_category" id="product_category" required>
                                    <option>select a Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{(! is_null($product)&&($product->category->id===$category->id))?'selected':''}}>{{$category->name}}</option>
                                    @endforeach

                                </select>
                            </div>


                            <div class="form-group col-md-12">

                                <label for="product_unit">product Unit</label>
                                <select class="form-control" name="product_unit" id="product_unit" required>
                                    <option>select a Unit</option>
                                @foreach($units as $unit)
                                   <option value="{{$unit->id}}" {{(! is_null($product)&&($product->hasUnit->id===$unit->id))?'selected':''}}>{{$unit->formatted()}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="product_price">product price</label>
                                <input type="text" class="form-control" id="product_price" step="any"
                                       name="product_price" placeholder="product Price" required
                                       value="{{(!is_null($product))?$product->price:''}}" >
                            </div>


                    <div class="form-group col-md-6">
                        <label for="product_discount">Product Discount</label>
                        <input type="text" class="form-control" id="product_discount" step="any"
                               name="product_discount" placeholder="Product Discount" required
                               value="{{(!is_null($product))?$product->discount:0}}" >
                    </div>

                            <div class="form-group col-md-12">
                                <label for="product_total">product Total</label>
                                <input type="text" class="form-control" id="product_total" step="any"
                                       name="product_total" placeholder="product Total" required
                                       value="{{(!is_null($product))?$product->total:''}}" >
                            </div>
                              {{-- add options                           --}}
                            <div class="form-group col-md-12">

                                <table id="options-table" class="table table-striped">
                                  @if(!is_null($product))
                                      @if(!is_null($product->jsonOptions()))
                                          @foreach($product->jsonOptions() as $optionName => $options)
                                              @foreach($options as $option)
                                                    <tr>
                                                        <td>{{$optionName}} </td>
                                                        <td>{{$option}}</td>
                                                        <td>
                                                            <a href="" class="remove-option"><i class="fas fa-minus-circle"></i></a>
                                                            <input type="hidden" name="{{$optionName}}[]" value="{{$option}}">
                                                        </td>
                                                    </tr>
                                                  @endforeach
                                                  <td><input type="hidden" name="options[]" value="{{$optionName}}"></td>
                                            @endforeach
                                          @endif
                                      @endif
                                </table>
                                <a class="btn btn-primary add-option-btn" href="" >add option</a>


                            </div>
                             {{--/add option                            --}}


                             {{--images                            --}}
                            <div class="form-group col-md-12">
                                <div class="row">
                                    @for($i=0;$i<6;$i++)
                                        <div class="col-md-4 col-sm-12 mb-4">

                                            <div class="card image-card-upload" >
                                                @if(!is_null($product)&&!is_null($product->images)&&count($product->images)>0)
                                                    @if( isset($product->images[$i])&&   !is_null($product->images[$i])&&!empty($product->images[$i]));
                                                    <a href="" class="remove-image-upload" data-imageid="{{$product->images[$i]->id}}" data-removeimg="removeimg-{{$i}}" data-fileid="image-{{$i}}"><i class="fas fa-minus-circle"></i></a>

                                                    @else
                                                        <a href="" class="remove-image-upload" style="display:none "><i class="fas fa-minus-circle"></i></a>
                                                    @endif

                                                @endif



                                             <a href="" class="activate-image-upload" data-fileid="image-{{$i}}" id="removeimg-{{$i}}">
                                                 @if(!is_null($product) && !is_null($product->images) && count($product->images)>0)
                                                     @if( isset($product->images[$i])&&   !is_null($product->images[$i])&&!empty($product->images[$i]));
                                                     <img id="{{'iimage-'. $i}}" src="{{asset($product->images[$i]->url)}}" class="card-img-top">
                                                         @endif

                                                     @endif


                                                <div class="card-body" style="text-align: center">
                                                    @if(!is_null($product) && !is_null($product->images)&&count($product->images)>0)
                                                        @if( isset($product->images[$i])&&   !is_null($product->images[$i])&&!empty($product->images[$i]));
                                                            <i class="far fa-image" style="display: none"></i>
                                                            @else
                                                            <i class="far fa-image"></i>
                                                        @endif
                                                        @else
                                                        <i class="far fa-image"></i>


                                                    @endif


                                                </div>
                                             </a>
                                            </div>

                                            @if(!is_null($product) &&! is_null($product->images)&&count($product->images)>0)
                                                @if( isset($product->images[$i])&&   !is_null($product->images[$i])&&!empty($product->images[$i]));
                                                <input name="product_images[]" type="file" class="form-control-file image-file-upload" id="image-{{$i}}" value="{{asset($product->images[$i]->url)}}">

                                                @else
                                                    <input name="product_images[]" type="file" class="form-control-file image-file-upload" id="image-{{$i}}">

                                                @endif


                                                @else
                                                <input name="product_images[]" type="file" class="form-control-file image-file-upload" id="image-{{$i}}">


                                            @endif


                                        </div>

                                    @endfor
                                </div>
                            </div>
                            {{--/images                           --}}


                            <div class="form-group col-md-6 offset-3">
                            <button type="submit" class="btn btn-primary btn-block">SAVE</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal options-window" tabindex="-1" role="dialog" id="options-window">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Option</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group col-md-6">
                            <label for="option_name">Option Name</label>
                            <input type="text" class="form-control" id="option_name" name="option_name" placeholder="Option Name" required >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="option_value">Option Value</label>
                            <input type="text" class="form-control" id="option_value" name="option_value" placeholder="Option Value" required >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary add-option-button">Add option</button>
                    </div>
                </div>
            </div>

    </div>


    <div class="modal image-window" tabindex="-1" role="dialog" id="options-window">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="submit" class="delete-image-btn btn btn-primary ">Delete Image</a>
                </div>
            </div>
        </div>

    </div>


    @endsection
@section('scripts')
    <script>
        var optionNamesList=[];
    </script>
    <script>

var imageDelete='{{route('delete-image')}}';

    </script>
    @if(!is_null($product))
        @if (!is_null($product->jsonOptions()))
            @foreach($product->jsonOptions() as $optionName => $options)
                <script>optionNamesList.push('{{$optionName}}'); </script>


            @endforeach
        @endif
    @endif

    <script>
    $(document).ready(function () {
       $.ajaxSetup({
           headers:{
'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
           }
       });
   console.log(optionNamesList);
        var $optionWindow=$('#options-window');
        var $imageWindow=$('.image-window')
        var $addOptionBtn=$('.add-option-btn');
        var $optionTable=$('#options-table');
        var optionNameRow='';
        var $activateImageUpload=$('.activate-image-upload');

        $addOptionBtn.on('click',function (e) {
            e.preventDefault();
            $optionWindow.modal('show');

        });

        $(document).on('click','.remove-option',function (e) {

           e.preventDefault();
           $(this).parent().parent().remove()
        });
        $(document).on('click','.add-option-button',function (e) {
            e.preventDefault();
            var $optionName=$('#option_name');
            if($optionName.val()===''){
                alert('name require');
                return false
            }
            var $optionValue=$('#option_value');
            if($optionValue.val()===''){
                alert('value require');
                return false
            }


            if (! optionNamesList.includes($optionName.val())){
                optionNamesList.push($optionName.val());
                optionNameRow='<td><input type="hidden" name="options[]" value="'+ $optionName.val() +'"></td>';
            }



            var optionRow='<tr><td>'+$optionName.val()+'</td><td>'+$optionValue.val()+'</td><td><a href="" class="remove-option"><i class="fas fa-minus-circle"></i></a><input type="hidden" name="'+$optionName.val()+'[]" value="'+$optionValue.val()+'"></td></tr>';
            $optionTable.append(
                optionRow

            );
            $optionTable.append(
                optionNameRow

            );
            $optionValue.val('');

        });
        function readURL(input,imageID){
            if (input.files &&input.files[0]){
               var reader= new FileReader();
               reader.onload=function (e) {
                   $('#'+imageID).attr('src',e.target.result);
                   // console.log(e.target.result);
               };
               reader.readAsDataURL(input.files[0]);
            }
        }
        function resetFileUpload(FileUploadID,imageID,$ei,$ed){
            $('#'+imageID).attr('src','');
            $ei.fadeIn();

            if($ed !=null){
                $ed.fadeOut();
            }
            // use to Show item after hidden

            $(FileUploadID).val(''); //His way in The JavaScript  to delete data in case it is kept in the <input>
                //or
             document.getElementById(FileUploadID).value=''; //His way in The Jquery  to delete data in case it is kept in the <input>


        }

        $activateImageUpload.on('click',function (e) {
            e.preventDefault();
            var fileUploadID=$(this).data('fileid');
            var me=$(this);
            $('#'+fileUploadID).trigger('click');
            var imagetag='<img id="i'+fileUploadID+'" src="" class="card-img-top">';
            $(this).append(imagetag);

            $('#'+fileUploadID).on('change',function (e) {
                readURL(this,'i'+fileUploadID);
                me.find("i").fadeOut(); //fadeout use to Hide and not delete
                //to show
                me.parent().find('.remove-image-upload').fadeIn();
                // to remove
               var $removeThisImage=me.parent().find('.remove-image-upload');
                $removeThisImage.fadeIn();
                $removeThisImage.on('click',function (e) {
                    e.preventDefault();
                    resetFileUpload('#'+fileUploadID,'i'+fileUploadID,me.find("i"),$removeThisImage);
                });

            });
        });
         $('.remove-image-upload').on('click',function (e) {
             e.preventDefault();
             var me=$(this);
             var imageID=me.data('imageid');
             var removeID=$(this).data('removeimg');
             var fileUploadID=$(this).data('fileid');

             var $removeThisImage=me.parent().find('.remove-image-upload');

             $('.delete-image-btn').data('ed',$removeThisImage);
             $('.delete-image-btn').data('fileid',fileUploadID);
             $('.delete-image-btn').data('removeimg',removeID);
             $('.delete-image-btn').data('imageid',imageID);
             $imageWindow.modal('show');

         });
         $(document).on('click','.delete-image-btn',function (e) {
                 e.preventDefault();
                 var imageID=$(this).data('imageid');
                 var removeID=$(this).data('removeimg');
                 var fileUploadID=$(this).data('fileid');
             var ed=$(this).data('ed');

             resetFileUpload(fileUploadID,'i'+fileUploadID,$('#'+removeID).find('i'),ed);
             $.ajax({

                 url:imageDelete,
                 data:{
                     image_id:imageID
                 },
                 dataType: 'json',
                 method:'post'
             });
             $imageWindow.modal('hide');



         })

    });
</script>

    @endsection
