
@foreach ($products as $item)
<div class="docname">
    <a href="{{route('front.product' , $item->slug)}}">
        <img src="{{asset(env('DYNAMIC_PATH' , '').'products/'.$item->product_image)}}" alt="">
        <div class="search-content">
            <p class="text-dark">{{$item->name}}</p>
            <h4 class="price" style="font-size:14px">$24.99<del style="color: red;
            margin-right: 12px;">
            <h4>
                <small style="font-weight: 700;font-size:16px !important">
                    R. {{$item->getPrice()}}.{{$item->getFraction()}}
                </small>
            </h4>

        </div>
    </a>
</div>
@endforeach
