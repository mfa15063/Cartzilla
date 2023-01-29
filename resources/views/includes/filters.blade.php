<aside class="col-lg-4">
    <!-- Sidebar-->
        <div class="offcanvas offcanvas-collapse bg-white w-100 rounded-3 shadow-lg py-1" id="shop-sidebar" style="max-width: 22rem;">
            <div class="offcanvas-header align-items-center shadow-sm">
            <h2 class="h5 mb-0">Filters</h2>
            <button class="btn-close ms-auto" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body py-grid-gutter px-lg-grid-gutter">
            <!-- Categories-->
            <div class="widget widget-categories mb-4 pb-4 border-bottom">
                <h3 class="widget-title">Filters</h3>
                <div class="accordion mt-n1" id="shop-categories">
                    <!-- Categories-->
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <a class="accordion-button collapsed" href="#shoes" role="button" data-bs-toggle="collapse" aria-expanded="truw" aria-controls="shoes">Categories</a></h3>
                        <div class="accordion-collapse collapse show" id="shoes" data-bs-parent="#shop-categories">
                        <div class="accordion-body">
                            <div class="widget widget-links widget-filter">
                            <div class="input-group input-group-sm mb-2">
                                <input class="widget-filter-search form-control rounded-end" type="text" placeholder="Search"><i class="ci-search position-absolute top-50 end-0 translate-middle-y fs-sm me-3"></i>
                            </div>
                            <ul class="widget-list widget-filter-list pt-1" style="height: 12rem;" data-simplebar data-simplebar-auto-hide="false">
                                <li class="widget-list-item widget-filter-item">
                                    <a class="widget-list-link d-flex justify-content-between align-items-center" href="#">
                                        <span class="widget-filter-item-text">View all</span>
                                        <span class="fs-xs text-muted ms-3"></span>
                                    </a>
                                </li>
                                @if($category != '')
                                    <input type="hidden" id="already_selected_cat" value="{{ $category->id }}">
                                @endif
                                @foreach ($categories as $cat)
                                    <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                        <div class="form-check">
                                        <input @if($category != '')
                                            @if($category->id == $cat->id)
                                                checked
                                            @endif
                                        @endif class="form-check-input filter" data-type="cat" type="checkbox" value="{{$cat->id}}" id="cat{{$cat->id}}">
                                        <label class="form-check-label widget-filter-item-text" for="cat{{$cat->id}}">{{$cat->name}}</label>
                                        </div><span class="fs-xs text-muted">{{$cat->products->count()}}</span>
                                    </li>
                                @endforeach
                            </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
          <!-- Price range-->
          <div class="widget mb-4 pb-4 border-bottom">
            <h3 class="widget-title">Price</h3>
            <div class="range-slider" data-start-min="{{$min}}" data-start-max="{{$max}}" data-min="{{$min}}" data-max="{{$max}}" data-step="1">
              <div class="range-slider-ui"></div>
              <div class="d-flex pb-1">
                <div class="w-50 pe-2 me-2">
                  <div class="input-group input-group-sm"><span class="input-group-text">$</span>
                    <input class="form-control range-slider-value-min price" id="min" type="text">
                  </div>
                </div>
                <div class="w-50 ps-2">
                  <div class="input-group input-group-sm"><span class="input-group-text">$</span>
                    <input class="form-control range-slider-value-max price" id="max" type="text">
                  </div>
                </div>
              </div>
            </div>
          </div>  
            <!-- Filter by Brand-->
            <div class="accordion mt-n1" id="brands-parent">
                <div class="accordion-item">
                    <h3 class="accordion-header">
                        <a class="accordion-button collapsed" href="#brands" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="brands">Brands</a></h3>
                    <div class="accordion-collapse collapse show" id="brands" data-bs-parent="#brands-parent">
                    <div class="accordion-body">
                        <div class="widget widget-links widget-filter">
                        <div class="input-group input-group-sm mb-2">
                            <input class="widget-filter-search form-control rounded-end" type="text" placeholder="Search">
                            <i class="ci-search position-absolute top-50 end-0 translate-middle-y fs-sm me-3"></i>
                        </div>
                        <ul class="widget-list widget-filter-list pt-1" style="height: 12rem;" data-simplebar data-simplebar-auto-hide="false">
                            <li class="widget-list-item widget-filter-item">
                                <a class="widget-list-link d-flex justify-content-between align-items-center" href="#">
                                    <span class="widget-filter-item-text">View all</span>
                                    <span class="fs-xs text-muted ms-3"></span>
                                </a>
                            </li>
                            @foreach ($brands as $item)
                            
                            <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">
                                <div class="form-check">
                                <input class="form-check-input filter" data-type="brand" type="checkbox" value="{{$item->id}}" id="brand{{$item->id}}">
                                <label class="form-check-label widget-filter-item-text" for="brand{{$item->id}}">{{$item->name}}</label>
                                </div><span class="fs-xs text-muted">{{$item->products->count()}}</span>
                            </li>
                            @endforeach
                        </ul>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- Filter by Brand-->
            <hr>
            <!-- Filter by Color-->
            <div class="accordion mt-n1" id="colora-parent">
                <div class="accordion-item">
                    <h3 class="accordion-header widget-title">
                        <a class="accordion-button collapsed widget-title" href="#colors" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="colors">
                            Colors
                        </a>
                        </h3>
                    <div class="accordion-collapse collapse show" id="colors" data-bs-parent="#colors-parent">
                        <div class="accordion-body">
                            <div class="widget widget-links widget-filter">
                                <div class="d-flex flex-wrap">
                                    @foreach ($colors as $key=>$item)
                                        <div class="form-check form-option text-center mb-2 mx-1" style="width: 4rem;">
                                            <input class="form-check-input filter" data-type="color" value="{{$item}}" type="checkbox" id="color{{$key}}">
                                            <label class="form-option-label rounded-circle" for="color{{$key}}">
                                                <span class="form-option-color rounded-circle" style="background-color: {{$item}};"></span></label>
                                        </div>        
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Filter by Color-->
            
            </div>
        </div>
    </aside>