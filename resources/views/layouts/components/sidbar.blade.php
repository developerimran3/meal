<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Synadmin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i>
        </div>
    </div>
    <!--navigation-->

    <ul class="metismenu" id="menu">
        @if (Auth::user()->is_active == true)
            <li class="menu-label">Main</li>
            <li>
                <a href="/dashboard">
                    <div class="parent-icon"><i class='bx bx-home'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li>
                <a href="{{ route('index') }}">
                    <div class="parent-icon"><i class='bx bx-restaurant'></i>
                    </div>
                    <div class="menu-title">My Meals</div>
                </a>
            </li>

            @if (in_array(Auth::user()->role, ['manager', 'operations']))
                <li>
                    <a href="{{ route('meals.today') }}">
                        <div class="parent-icon"><i class='bx bx-home-heart'></i>
                        </div>
                        <div class="menu-title">Today Meals</div>
                    </a>
                </li>
            @endif

            @if (in_array(Auth::user()->role, ['manager', 'accountant']))
                <li>
                    <a href="{{ route('bill.index') }}">
                        <div class="parent-icon"><i class='bx bx-home-heart'></i>
                        </div>
                        <div class="menu-title">Bill Create</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('payment.index') }}">
                        <div class="parent-icon"><i class='bx bx-dollar-circle'></i>
                        </div>
                        <div class="menu-title">Deu Payments</div>
                    </a>
                </li>
            @endif

            @if (Auth::user()->role == 'manager')
                <li>
                    <a href="{{ route('user.create.show') }}">
                        <div class="parent-icon"><i class='bx bx-user-plus'></i>
                        </div>
                        <div class="menu-title">Add Users</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.change.role') }}">
                        <div class="parent-icon"><i class='bx bx-user-circle'></i>
                        </div>
                        <div class="menu-title">Role Management</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="parent-icon"><i class='bx bx-cart-alt'></i>
                        </div>
                        <div class="menu-title">Expense Heads</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="parent-icon"><i class='bx bx-file'></i>
                        </div>
                        <div class="menu-title">Reports</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="parent-icon"><i class='bx bx-search'></i>
                        </div>
                        <div class="menu-title">Search Members</div>
                    </a>
                </li>
            @endif


            <li>
                <a href="{{ route('payment.history') }}">
                    <div class="parent-icon"><i class='bx bx-credit-card-front'></i>
                    </div>
                    <div class="menu-title">Payments History</div>
                </a>
            </li>

            @if (Auth::user()->role == 'operations')
                <li>
                    <a href="{{ route('bazar.view') }}">
                        <div class="parent-icon"><i class='bx bx-cart'></i>
                        </div>
                        <div class="menu-title">Deily Bazar</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="parent-icon"><i class='bx bx-home'></i>
                        </div>
                        <div class="menu-title">Bazar update</div>
                    </a>
                </li>
            @endif
            <li class="menu-label">Account</li>
            <li>
                <a href="{{ route('profile') }}">
                    <div class="parent-icon"><i class='bx bx-user-pin'></i>
                    </div>
                    <div class="menu-title">User Profile</div>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}">
                    <div class="parent-icon"><i class='bx bx-log-out'></i>
                    </div>
                    <div class="menu-title">Log Out</div>
                </a>
            </li>
        @endif
    </ul>

    <!--Extra Sub Menu->
        {{-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-user-plus'></i>
                </div>
                <div class="menu-title">User</div>
            </a>
            <ul>
                <li> <a href="{{ route('user.create.show') }}"><i class="bx bx-right-arrow-alt"></i>Add Users</a>
                </li>
            </ul>
        </li> --}}
   
    <!--end navigation-->


</div>
