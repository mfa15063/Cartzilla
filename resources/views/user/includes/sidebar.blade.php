
          <aside class="col-lg-4 pt-4 pt-lg-0 pe-xl-5">
            <div class="bg-white rounded-3 shadow-lg pt-1 mb-5 mb-lg-0">
              <div class="d-md-flex justify-content-between align-items-center text-center text-md-start p-4">
                <div class="d-md-flex align-items-center">
                  <div class="img-thumbnail rounded-circle position-relative flex-shrink-0 mx-auto mb-2 mx-md-0 mb-md-0" style="width: 6.375rem;">
                    <img class="rounded-circle" src="{{asset(env('PUBLIC_PATH' , '').'img/avatar.png') }}" alt="{{Auth::user()->first_name ." " . Auth::user()->last_name}}"></div>
                  <div class="ps-md-3">
                    <h3 class="fs-base mb-0">{{Auth::user()->first_name ." " . Auth::user()->last_name}}</h3><span class="text-accent fs-sm">
                        {{Auth::user()->email}}
                    </span>
                  </div>
                </div>
                <a class="btn btn-primary d-lg-none mb-2 mt-3 mt-md-0" href="#account-menu" data-bs-toggle="collapse" aria-expanded="false">
                  <i class="ci-menu me-2"></i>Account menu</a>
              </div>
              <div class="d-lg-block collapse" id="account-menu">
                <div class="bg-secondary px-4 py-3">
                  <h3 class="fs-sm mb-0 text-muted">Dashboard</h3>
                </div>
                <ul class="list-unstyled mb-0">
                    <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3
                        {{Route::is('user.orders') ? 'active' : '' }}
                        " href="{{route('user.orders')}}">
                          <i class="ci-bag opacity-60 me-2"></i>Orders<span class="fs-sm text-muted ms-auto">
                              {{Auth::user()->orders->count()}}
                          </span>
                        </a>
                    </li>
                    <li class="border-bottom mb-0">
                        <a class="nav-link-style d-flex align-items-center px-4 py-3
                        {{Route::is('user.wishlist') ? 'active' : '' }}

                        " href="{{route('user.wishlist')}}">
                          <i class="ci-heart opacity-60 me-2"></i>Wishlist
                          <span class="fs-sm text-muted ms-auto">

                            {{Auth::user()->wishlist->count()}}

                          </span>
                        </a>
                    </li>
                </ul>
                <div class="bg-secondary px-4 py-3">
                  <h3 class="fs-sm mb-0 text-muted">Account settings</h3>
                </div>
                <ul class="list-unstyled mb-0">
                  <li class="border-bottom mb-0">
                      <a class="nav-link-style d-flex align-items-center px-4 py-3
                      {{Route::is('user.profile') ? 'active' : '' }}
                      " href="{{route('user.profile')}}"><i class="ci-user opacity-60 me-2"></i>Profile info</a>
                    </li>
                  <li class="d-lg-none border-top mb-0">
                      <a class="nav-link-style d-flex align-items-center px-4 py-3" href="javascript:;" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          <i class="ci-sign-out opacity-60 me-2"></i>Sign out
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </li>
                </ul>
              </div>
            </div>
          </aside>
