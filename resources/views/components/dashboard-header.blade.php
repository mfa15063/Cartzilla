<div class="page-title-overlap bg-dark pt-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                    <li class="breadcrumb-item"><a class="text-nowrap" href="{{route('front.index')}}"><i class="ci-home"></i>Home</a></li>
                    <li class="breadcrumb-item text-nowrap">
                        <a href="#">{{$mainpage}}</a>
                    </li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">{{$subpage}}</li>
                </ol>
            </nav>
        </div>
        <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-light mb-0">{{$subpage}}</h1>
        </div>
    </div>
</div>
