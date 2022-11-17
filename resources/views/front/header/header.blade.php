<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="fa-solid fa-utensils"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('index')}}">Home</a>
                </li>
                {{-- @if ()
                    
                @endif --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{route('forum')}}">Forums</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li> --}}
                @if (Auth::user())
                <li class="nav-item">
                    <a class="nav-link" href="{{route('recipes')}}">Recipes</a>
                </li>
                @endif

            </ul>
            {{-- this will appear after login --}}
            @if (Auth::user()!='')



            @if (Auth::user()->role=='admin')
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{route('profile')}}">Profile</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('report')}}">Report</a>
                </li>

                

                </li>
            </ul>
            @elseif(Auth::user()->role=='user')
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{route('profile')}}">Profile</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('recipeList')}}">Your Recipes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('favoriteList')}}">Favorites</a>
                </li>
                

                

                </li>
            </ul>
            @endif

            @endif

        </div>
    </div>
</nav>