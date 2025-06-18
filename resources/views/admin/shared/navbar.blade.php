<div class="br-logo"><a href="{{ route('admin.dashboard') }}"><span>[</span>Admin <i>Panel</i><span>]</span></a></div>
<div class="br-sideleft sideleft-scrollbar">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
    <ul class="br-sideleft-menu">
        <li class="br-menu-item">
            <a href="{{ route('admin.dashboard') }}"
               class="br-menu-link {{ Request::routeIs('admin.dashboard*') ? 'active' : '' }}">
                <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
                <span class="menu-item-label">Dashboard</span>
            </a>
        </li>

        <li class="br-menu-item">
            <a href="#"
               class="br-menu-link with-sub {{ Request::routeIs('admin.categories*') ? 'active show-sub' : ''  }}">
                <i class="menu-item-icon icon ion-cube tx-20"></i>
                <span class="menu-item-label">Categories</span>
            </a>
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('admin.categories.index') }}"
                                        class="sub-link {{ Request::routeIs('admin.categories.index') || Request::routeIs('admin.categories.edit') ? 'active' : ''  }}">List</a>
                </li>
                <li class="sub-item"><a href="{{ route('admin.categories.create') }}"
                                        class="sub-link {{ Request::routeIs('admin.categories.create') ? 'active' : ''  }}">Add
                        New</a></li>
            </ul>
        </li>

        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ Request::routeIs('admin.brands*') ? 'active show-sub' : ''  }}">
                <i class="menu-item-icon icon ion-laptop tx-20"></i>
                <span class="menu-item-label">Brands</span>
            </a>
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('admin.brands.index') }}"
                                        class="sub-link {{ Request::routeIs('admin.brands.index') || Request::routeIs('admin.brands.edit') ? 'active' : ''  }}">List</a>
                </li>
                <li class="sub-item"><a href="{{ route('admin.brands.create') }}"
                                        class="sub-link {{ Request::routeIs('admin.brands.create') ? 'active' : ''  }}">Add
                        New</a></li>
            </ul>
        </li>

        <li class="br-menu-item">
            <a href="#"
               class="br-menu-link with-sub {{ Request::routeIs('admin.writers*') ? 'active show-sub' : ''  }}">
                <i class="menu-item-icon icon ion-edit tx-20"></i>
                <span class="menu-item-label">Writers</span>
            </a>
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('admin.writers.index') }}"
                                        class="sub-link {{ Request::routeIs('admin.writers.index') || Request::routeIs('admin.writers.edit') ? 'active' : ''  }}">List</a>
                </li>
                <li class="sub-item"><a href="{{ route('admin.writers.create') }}"
                                        class="sub-link {{ Request::routeIs('admin.writers.create') ? 'active' : ''  }}">Add
                        New</a></li>
            </ul>
        </li>

        <li class="br-menu-item">
            <a href="#"
               class="br-menu-link with-sub {{ Request::routeIs('admin.merchants*') ? 'active show-sub' : ''  }}">
                <i class="menu-item-icon icon ion-male tx-20"></i>
                <span class="menu-item-label">Merchants</span>
            </a>
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('admin.merchants.index') }}"
                                        class="sub-link {{ Request::routeIs('admin.merchants.index') || Request::routeIs('admin.merchants.edit') ? 'active' : ''  }}">List</a>
                </li>
                <li class="sub-item"><a href="{{ route('admin.merchants.create') }}"
                                        class="sub-link {{ Request::routeIs('admin.merchants.create') ? 'active' : ''  }}">Add
                        New</a></li>
            </ul>
        </li>

        <li class="br-menu-item">
            <a href="#"
               class="br-menu-link with-sub {{ Request::routeIs('admin.products*') ? 'active show-sub' : ''  }}"><i
                    class="menu-item-icon icon ion-ios-cart tx-20"></i><span class="menu-item-label">Products</span></a>
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('admin.products.index') }}"
                                        class="sub-link {{ Request::routeIs('admin.products.index') || Request::routeIs('admin.products.edit') ? 'active' : ''  }}">List</a>
                </li>
                <li class="sub-item"><a href="{{ route('admin.products.create') }}"
                                        class="sub-link {{ Request::routeIs('admin.products.create') ? 'active' : ''  }}">Add
                        New</a></li>
            </ul>
        </li>

        <li class="br-menu-item">
            <a href="{{ route('admin.orders.index') }}"
               class="br-menu-link {{ Request::routeIs('admin.orders*') ? 'active' : '' }}"><i
                    class="menu-item-icon icon ion-android-send tx-24"></i>
                <span class="menu-item-label">Orders</span>
                @if(count(newOrderCount()) > 0)
                    <span class="badge badge-danger">{{ count(newOrderCount()) }}</span>
                @endif

            </a>
        </li>

        <li class="br-menu-item">
            <a href="#"
               class="br-menu-link with-sub {{ Request::routeIs('admin.reports*') ? 'active show-sub' : ''  }}"><i
                    class="menu-item-icon icon ion-ios-paper tx-20"></i><span class="menu-item-label">Reports</span></a>
            <ul class="br-menu-sub">
                <li class="sub-item">
                    <a href="{{ route('admin.reports.orders') }}"
                       class="sub-link {{ Request::routeIs('admin.reports.orders') ? 'active' : ''  }}">Sale</a>
                </li>
                <li class="sub-item">
                    <a href="{{ route('admin.reports.ledger') }}"
                       class="sub-link {{ Request::routeIs('admin.reports.ledger') ? 'active' : ''  }}">Ledger</a>
                </li>
            </ul>
        </li>

        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ Request::routeIs('admin.agents*') ? 'active show-sub' : ''  }}"><i
                    class="menu-item-icon icon ion-person tx-20"></i>
                <span class="menu-item-label">
                    Agents
                    @if(count(withdrawRequest()) > 0)
                        <span class="badge badge-danger">{{ count(withdrawRequest()) }}</span>
                    @endif
                </span>
            </a>
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('admin.agents.index') }}"
                                        class="sub-link {{ Request::routeIs('admin.agents.index') || Request::routeIs('admin.agents.edit') ? 'active' : ''  }}">List</a>
                </li>
                <li class="sub-item"><a href="{{ route('admin.agents.create') }}"
                                        class="sub-link {{ Request::routeIs('admin.agents.create') ? 'active' : ''  }}">Add
                        New</a></li>
                <li class="sub-item">
                    <a href="{{ route('admin.agents.withdrawRequest') }}"
                       class="sub-link {{ Request::routeIs('admin.agents.withdrawRequest') ? 'active' : ''  }}">Withdraw
                        Request
                        @if(count(withdrawRequest()) > 0)
                            <span class="badge badge-danger">{{ count(withdrawRequest()) }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </li>

        <li class="br-menu-item">
            <a href="#"
               class="br-menu-link with-sub {{ Request::routeIs('admin.sliders*') ? 'active show-sub' : ''  }}"><i
                    class="menu-item-icon icon ion-monitor tx-20"></i><span class="menu-item-label">Sliders</span></a>
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('admin.sliders.index') }}"
                                        class="sub-link {{ Request::routeIs('admin.sliders.index') || Request::routeIs('admin.sliders.edit') ? 'active' : ''  }}">List</a>
                </li>
                <li class="sub-item"><a href="{{ route('admin.sliders.create') }}"
                                        class="sub-link {{ Request::routeIs('admin.sliders.create') ? 'active' : ''  }}">Add
                        New</a></li>
            </ul>
        </li>

        <li class="br-menu-item">
            <a href="{{ route('admin.setting') }}"
               class="br-menu-link {{ Request::routeIs('admin.setting*') ? 'active' : '' }}"><i
                    class="menu-item-icon icon ion-ios-settings tx-24"></i>
                <span class="menu-item-label">Setting</span>
            </a>
        </li>

        <li class="br-menu-item">
            <a href="{{ route('admin.contactMessage.index') }}"
               class="br-menu-link {{ Request::routeIs('admin.contactMessage*') ? 'active' : '' }}"><i
                    class="menu-item-icon icon ion-ios-email tx-24"></i>
                <span class="menu-item-label">Contact Message</span>
            </a>
        </li>
    </ul>
    <br>
</div>
