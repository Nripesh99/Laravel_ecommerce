
<div class="navbar sticky-top" style="background-color: #bed4ea; padding: 5px;">
    <ul class="navbar-nav ms-auto">
        
        <div class="d-none d-sm-flex d-sm-items-center ms-6">
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="userDropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @auth
                    {{ Auth::user()->name }}
                    @endauth
                    <svg class="bi bi-caret-down" width="16" height="16" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 6l5 5 5-5H3z" />
                    </svg>
                </button>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </li>
                    @guest
                    <li class="nav-item">
                       <small> <a href="{{ route('login') }}" class="nav-link">
                            Log in
                        </a></small>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <small>
                            <a href="{{ route('register') }}" class="nav-link">
                                Register
                            </a>
                            </small>
                        </li>
                    @endif
                @else
                @endguest
                </ul>
            </div>
        </div>
    </ul>

</div>
<nav class="navbar navbar-expand-lg sticky-top bg-body-tertiary " data-bs-theme="light">
    <div class="container-fluid">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Home2</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Blog
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">View Home</a>
                        <a class="dropdown-item" href="#">Add home</a>
                        <!-- Add link for editing blog if needed -->
                    </div>
                </li>
            </ul>
            <form class="d-flex align" role="search" style="width: 45rem;" action="searchResult.php" method="post">
                <input class="form-control me-2 ms-5 " name="search" type="search" placeholder="Search"
                    aria-label="Search">
                <button class="btn btn-secondary" type="submit">Search</button>
            </form>
            <ul class="navbar-nav">
            <li class="nav-item mr-5">
                <a class="nav-link" href="{{ url('/') }}"><i class="bi bi-cart"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-cart"></i></a>
            </li>
            </ul>
            @auth
               
            @endauth
        </ul>
    </div>
</nav>
