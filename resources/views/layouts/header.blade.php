<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            @if (Session::has('api_token'))
                <?php $user = Session::get('user'); ?>
                <div style="margin-left: 10px;">
                    Welcome, {{ $user['first_name'] }} {{ $user['last_name'] }}!
                </div>
            @endif
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <div class="profile">
            <div class="img-box">
                <img src="{{ asset('asset/123.png') }}" alt="some user image">
            </div>
        </div>
        <div class="menu">
            <ul class="p-0">
                <li>
                    <a href="{{ route('profile') }}">
                        <i class="fas fa-user"></i>
                        Profile
                    </a>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        logout
                    </a>
                </li>
            </ul>
        </div>
    </ul>
</nav>
