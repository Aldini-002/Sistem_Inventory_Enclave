<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-flex align-items-center">
            <div class="text-lg font-weight-bold">
            @if (str_contains(Route::currentRouteName(),'dashboard'))
            Dashboard
            @elseif (str_contains(Route::currentRouteName(),'myaccount'))
            My Account
            @else
            {{ ucfirst(substr(Route::currentRouteName(),0,strpos(Route::currentRouteName(),"."))); }}
            @endif
            </div>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown user-menu">
            <div >
                <button type="button" class="btn btn-sm user-menu text-md font-weight-bold"
                    data-toggle="dropdown" data-offset="-52">
                    <i class="mr-0"></i>{{ Auth::user()->name}}
                    <i class="ml-2 fa fa-caret-down"></i>
                </button>

                <div class="dropdown-menu " role="menu">
                            {{-- <a href="/myaccount" class="dropdown-item">
                                <button class="btn btn-sm user-menu text-md font-weight-bold">
                                    <i class="fa fa-user mr-2"></i>
                                    Profil
                                </button>
                            </a> --}}

                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        @method('DELETE')
                            <a class="dropdown-item">
                                <button type="submit" class="btn btn-sm user-menu text-md font-weight-bold">
                                    <i class="fa fa-sign-out mr-2"></i>
                                    Log Out
                                </button>
                            </a>
                    </form>
                </div>
            </div>
        </li>
    </ul>
</nav>
