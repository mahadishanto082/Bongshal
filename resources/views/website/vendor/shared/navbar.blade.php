<div class="br-logo"><a href="{{ route('vendor.dashboard') }}"><span>[</span>Order <i>Panel</i><span>]</span></a></div>
<div class="br-sideleft sideleft-scrollbar" style="height: min-content;">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
    <ul class="br-sideleft-menu " >
        <li class="br-menu-item">
            <a href="{{ route('vendor.dashboard') }}"
               class="br-menu-link {{ Request::routeIs('vendor.dashboard*') ? 'active' : '' }}">
                <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
                <span class="menu-item-label">Dashboard</span>
            </a>
        </li>

        <li class="br-menu-item">
            <a href="#"
               class="br-menu-link with-sub {{ Request::routeIs('vendor.categories*') ? 'active show-sub' : ''  }}">
                <i class="menu-item-icon icon ion-cube tx-20"></i>
                <span class="menu-item-label">Products</span>
            </a>
           
        </li>

        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ Request::routeIs('#') ? 'active show-sub' : ''  }}">
                <i class="menu-item-icon icon ion-laptop tx-20"></i>
                <span class="menu-item-label">Orders</span>
            </a>
            
        </li>

        <li class="br-menu-item">
            <a href="#"
               class="br-menu-link with-sub {{ Request::routeIs('#') ? 'active show-sub' : ''  }}">
                <i class="menu-item-icon icon ion-report tx-20"></i>
                <span class="menu-item-label">Sells report</span>
            </a>
           
        </li>
        <li class="br-menu-item">
            <a href="#"
               class="br-menu-link with-sub {{ Request::routeIs('#') ? 'active show-sub' : ''  }}">
                <i class="menu-item-icon icon ion-edit tx-20"></i>
                <span class="menu-item-label">Create Product</span>
            </a>
           
        </li>

       
    </ul>
    <br>
</div>
