
<?php
use Carbon\Carbon;
?>

@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class ="col-md-12">
        <div class="card">
                <div class="card-header">Reviews</div>

                <div class="card-body">
                <div class="row">

                @foreach($reviews as $review)

                 <div class="col-md-4">
                 <div class="alert alert-primary" role="alert">

                 <h3>{{ $review->customer->formattedName()}}</h3>
                     <p>product: {{$review->product->title}}</p>
{{--                     <p>stars:--}}
{{--                     @for($i=0;$i<$review->stars;$i++)--}}
{{--                         <i class="fas fa-star"></i>--}}
{{--                         @endfor--}}
{{--                     </p>--}}


{{--                     //هنا هذا الكود لايعتبر منطقي لذلك لايتم نقله للمودل  لانه لايغير البيانات لكن يغير شكل العرض لذلك تتم معالجته في الفيوووو--}}
                     <p>stars:
                         @php
                         $total=5;// العدد الكلي للنجوم
                         $currentStars=$review->stars;//النجوم المختاره
                         $remainingdStars=$total-$currentStars;//النجوم المتبقيه
                         @endphp
                         @for($i=0;$i<$currentStars;$i++)
                             <i class="fas fa-star"></i>
                         @endfor
                         @for($i=0;$i<$remainingdStars;$i++)
                             <i class="far fa-star"></i>
                         @endfor
                     </p>

                     <p>review: {{$review->review}}</p>

{{--                     //هنا تم نقله للمودل لانه غير البيانات غير التاريخ من حاله الى اخرى--}}
                     <p>created_at: {{$review->humanFormattedDate()}}</p>


                </div>
                </div>
                @endforeach

                </div>
                {{$reviews->links()}}
            </div>
            </div>
            </div>
            </div>


@endsection
