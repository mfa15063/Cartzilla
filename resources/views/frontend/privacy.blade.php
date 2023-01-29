@extends('layouts.app')
@section('content')
<div class="page-title-overlap bg-dark pt-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
      <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
            <li class="breadcrumb-item"><a class="text-nowrap" href="{{route('front.index')}}">
              <i class="ci-home"></i>Home</a></li>
            <li class="breadcrumb-item text-nowrap active">
                <a href="#"></a>
            </li>
          </ol>
        </nav>
      </div>
      <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
        <h1 class="h3 text-light mb-0">{{ $title }}</h1>
      </div>
    </div>
</div>
<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
        <section class="col-lg-12">
            <!-- Toolbar-->
            <div class="d-flex justify-content-center justify-content-sm-between align-items-center pt-2 pb-4 pb-sm-5">

            </div>
            <!-- Products grid-->
            <div class="row mx-n2 mt-5">

                {!! @$setting->setting_name !!}
            </div>
        </section>
    </div>
</div>
@endsection
