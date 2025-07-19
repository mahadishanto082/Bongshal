<div class="br-header d-print-none">
    <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a>
        </div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i class="icon ion-navicon-round"></i></a>
        </div>
    </div><!-- br-header-left -->
    <div class="br-header-right">
        <nav class="nav">
            <div class="dropdown">
                <a href="#" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
                    <i class="icon ion-android-send tx-24"></i>
                    @if(count(newOrderCount()) > 0)
                        <span class="square-8 bg-danger pos-absolute t-15 r-0 rounded-circle"></span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-header">
                    <div class="dropdown-menu-label">
                        <label>New Orders</label>
                    </div><!-- d-flex -->

                    <div class="media-list">
                        @if(count(newOrderCount()) > 0)
                            @foreach(newOrderCount() as $nOrder)
                                <a href="{{ route('admin.orders.show', $nOrder->id) }}" class="media-list-link">
                                    <div class="media">
                                        <div class="media-body">
                                            <div>
                                                <p>Order Number: {{ $nOrder->id }}</p>
                                                <span>{{ $nOrder->updated_at->diffForHumans() }}</span>
                                            </div><!-- d-flex -->
                                            <p>Sub Total: Tk. {{ $nOrder->sub_total }}</p>
                                            <p>Order Total: Tk. {{ $nOrder->final_total }}</p>
                                        </div>
                                    </div><!-- media -->
                                </a>
                            @endforeach
                            <div class="dropdown-footer">
                                <a href="{{ route('admin.orders.index') }}?status=Pending"><i class="fa fa-angle-down"></i> Show All Orders</a>
                            </div>
                        @else
                            <a class="media-list-link">
                                <div class="media">
                                    <div class="media-body">
                                        <strong class="text-danger">No new order</strong>
                                    </div>
                                </div><!-- media -->
                            </a>
                            <div class="dropdown-footer">
                                <a href="{{ route('admin.orders.index') }}"><i class="fa fa-angle-down"></i> Show All Orders</a>
                            </div>
                        @endif
                    </div><!-- media-list -->
                </div><!-- dropdown-menu -->
            </div>

            <div class="dropdown">
                <a href="#" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
                    <i class="icon ion-ios-bell-outline tx-24"></i>
                    @if(count(withdrawRequest()) > 0)
                        <span class="square-8 bg-danger pos-absolute t-15 r-5 rounded-circle"></span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-header">
                    <div class="dropdown-menu-label">
                        <label>Withdraw Request</label>
                    </div><!-- d-flex -->

                    <div class="media-list">
                        @if(count(withdrawRequest()) > 0)
                            @foreach(withdrawRequest() as $wr)
                                <a class="media-list-link read">
                                    <div class="media">
                                        <div class="media-body">
                                            <div>
                                                <p>User: {{ $wr->user->name }}</p>
                                                <span>{{ $wr->updated_at->diffForHumans() }}</span>
                                            </div><!-- d-flex -->
                                            <p>Payment: Tk. {{ $wr->type }}</p>
                                            <p>Pay. Number: {{ $wr->payment_number }}</p>
                                        </div>
                                    </div><!-- media -->
                                </a>
                            @endforeach
                        @else
                            <a class="media-list-link">
                                <div class="media">
                                    <div class="media-body">
                                        <strong class="text-danger">No request</strong>
                                    </div>
                                </div><!-- media -->
                            </a>
                        @endif
                        <div class="dropdown-footer">
                            <a href="{{ route('admin.agents.withdrawRequest') }}"><i class="fa fa-angle-down"></i> Show All Orders</a>
                        </div>
                    </div><!-- media-list -->
                </div><!-- dropdown-menu -->
            </div>

            <div class="dropdown">
                <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <span class="logged-name hidden-md-down">{{ Auth::guard('admin')->user()->name }}</span>
                    <img style="width: 30px; height: 30px" src="{{ asset(auth('admin')->user()->image ? 'storage/' . auth('admin')->user()->image : 'assets/admin/img/img1.jpg') }}" class="wd-32 rounded-circle" alt="">
                    <span class="square-10 bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-250">
                    <div class="tx-center">
                        <a href="#">
                            <img style="width: 80px; height: 80px" src="{{ asset(auth('admin')->user()->image ? 'storage/' . auth('admin')->user()->image : 'assets/admin/img/img1.jpg') }}" class=" rounded-circle" alt="">
                        </a>
                        <h6 class="logged-fullname">{{ Auth::guard('admin')->user()->name }}</h6>
                        <p>{{ Auth::guard('admin')->user()->email }}</p>
                    </div>
                    <hr>
                    <ul class="list-unstyled user-profile-nav">
                        <li>
                            <a href="{{ route('admin.profile.update') }}"
                               @if(Request::routeIs('admin.profile.update')) class="active" @endif
                            >
                                <i class="icon ion-ios-person"></i> Edit Profile
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.profile.settings') }}"
                               @if(Request::routeIs('admin.profile.settings')) class="active" @endif
                            >
                                <i class="icon ion-ios-gear"></i> Settings
                            </a>
                        </li>

                        <li>
                            <a href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="icon ion-power"></i> Sign Out
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </nav>
    </div><!-- br-header-right -->
</div>
