@props(['name' , 'product'])
<div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
            <li class="breadcrumb-item">
                <a class="text-nowrap" href="{{Route::is('front.index') ? "#" :  route('front.index')}}">
                    <i class="ci-home"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item text-nowrap">
                <a href="#">{{$name}}</a>
            </li>
            <li class="breadcrumb-item text-nowrap active" aria-current="page">
                {{@$product->name}}
            </li>
        </ol>
    </nav>
</div>


