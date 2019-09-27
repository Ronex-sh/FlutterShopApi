@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class ="col-md-12">
                <div class="card">
                    <div class="card-header">
                  {!!  !is_null($product)?'Update Product <span class="product-header-title">'.$product->title.'</span>' :'New product'!!}
                    </div>

                    <div class="card-body">

                        <form action="{{route('update-product')}}" method="post" class="row">
                            @csrf
                            @if(!is_null($product))
                                <input  type="hidden" name="_method" value="PUT"/>
                                <input  type="hidden" name="product_id" value="{{$product->id}}"/>
                                @endif

                            <div class="form-group col-md-12">
                                <label for="product_title">product Title</label>
                                <input type="text" class="form-control" id="product_title"
                                       name="product_title" placeholder="product Title" required
                                       value="{{(!is_null($product))?$product->title:''}}" >
                            </div>
                            <div class="form-group col-md-12">

                                <label for="product_title">product Description</label>
                                  <textarea class="form-control" name="product_description" id="product_description" cols="30" rows="10" required>
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
                                <input type="text" class="form-control" id="product_price"
                                       name="product_price" placeholder="product Price" required
                                       value="{{(!is_null($product))?$product->price:''}}" >
                            </div>


                    <div class="form-group col-md-6">
                        <label for="product_discount">Product Discount</label>
                        <input type="text" class="form-control" id="product_discount"
                               name="product_discount" placeholder="Product Discount" required
                               value="{{(!is_null($product))?$product->discount:0}}" >
                    </div>

                            <div class="form-group col-md-12">
                                <label for="product_total">product Total</label>
                                <input type="text" class="form-control" id="product_total"
                                       name="product_total" placeholder="product Total" required
                                       value="{{(!is_null($product))?$product->total:''}}" >
                            </div>
                              {{-- add options                           --}}
                            <div class="form-group col-md-12">

                                <table id="options-table" class="table table-striped"></table>
                                <a class="btn btn-primary btn-option-btn" href="" >add option</a>


                            </div>
                             {{--/add option                            --}}

                            <button type="submit">test</button>


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





    @endsection
@section('scripts')
<script>

    $(document).ready(function () {
        var $optionWindow=$('#options-window');
        var $addOptionBtn=$('.btn-option-btn');
        var $optionTable=$('#options-table');

        $addOptionBtn.on('click',function (e) {
            e.preventDefault();
            $optionWindow.modal('show');

        });

        $(document).on('click','.remove-option',function (e) {

           e.preventDefault();
           $(this).parent().parent().remove()
        });
        // سيتم انشاء زر الادد اوبشن بتن دينماكي عند الضغط عليه  حيث هنا نقول للدوكيمنت انتبه اذا تشوف ادد اوبشن بتن  وكلك اذا المستخدم يريد هذا الزر مفعل للقيام بامر ما
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
            var optionRow='<tr><td>'+$optionName.val()+'</td><td>'+$optionValue.val()+'</td><td><a href=""class="remove-option"><i class="fas fa-minus-circle"></i></a><input type="hidden"name="'+$optionName.val()+'[]"value="'+$optionValue.val()+'"></td></tr>';
            $optionTable.append(
                optionRow

            );
            $optionValue.val('');

        });
    })
</script>

    @endsection
