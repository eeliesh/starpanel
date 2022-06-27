<div class="logo">
    <a href="{{ route('home') }}">
        <span class="material-icons">star</span>
        <span class="logo-text">{{ config('app.name') }}</span>
    </a>
</div>
<div class="user-bar">
    <div class="user-bar__content">
        @guest
            <div class="user-bar__avatar">
                <img src="{{ url('storage/avatars/default.png') }}" alt="Default Avatar">
            </div>
            <div class="user-bar__name">
                Welcome, <strong>Guest!</strong>
            </div>
            <div class="user-bar__controls">
                <a href="{{ route('login') }}" class="{{ request()->is('login') ? 'active' : '' }}">
                    <span class="material-icons">login</span>
                </a>
                <a href="{{ route('register') }}" class="{{ request()->is('register') ? 'active' : '' }}">
                    <span class="material-icons">person_add</span>
                </a>
                <a href="#" id="toggleMenu">
                    <span class="material-icons">menu</span>
                </a>
            </div>
        @else
            <div class="user-bar__avatar">
                <a href="{{ route('users.profile', ['id' => Auth::user()->id]) }}">
                    <img src="{{ url('storage/avatars/' . Auth::user()->avatar) }}" alt="Default Avatar">
                </a>
            </div>
            <div class="user-bar__name">
                Welcome,
                <a href="{{ route('users.profile', ['id' => Auth::user()->id]) }}">
                    <strong>{{ Auth::user()->name }}</strong>
                </a>
            </div>
            <div class="user-bar__controls{{ isAdmin() ? ' admin' : '' }}">
                <a href="{{ route('users.settings') }}" class="{{ str_contains(request()->url(), 'settings') ? 'active' : '' }}">
                    <span class="material-icons">manage_accounts</span>
                </a>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form-2').submit();"
                    aria-label="Logout">
                    <span class="material-icons">logout</span>
                </a>
                @if (canAddAdmins())
                    <a href="{{ route('owner.index') }}" id="ownerButton">
                        <span class="material-icons">lock</span>
                    </a>
                @endif
                <a href="#" id="toggleMenu">
                    <span class="material-icons">menu</span>
                </a>
                <form id="logout-form-2" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        @endguest
    </div>
</div>
<div class="search">
    <div class="search__content">
        <div class="search__input">
            <form action="{{ route('users.search') }}" method="GET">
                @csrf

                <input type="text" name="query" placeholder="Search for a player">
            </form>
        </div>
    </div>
</div>
<nav class="navigation">
    <ul class="menu list-reset">
        <div class="menu-title">
            <span>{{ __('menu.general') }}</span>
        </div>
        <li class="menu-item">
            <a class="menu-item__link{{ request()->is('/') ? ' active' : '' }}" href="{{ route('home') }}">
                <span class="material-icons">home</span>
                <span class="menu-item__text">{{ __('menu.home') }}</span>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-item__link" href="{{ config('app.forum_url') }}" target="_blank">
                <span class="material-icons">forum</span>
                <span class="menu-item__text">{{ __('menu.forum') }}</span>
            </a>
        </li>
        @if (isAdmin())
            <div class="menu-title">
                <span>Top secret</span>
            </div>
            @if (canAddAdmins())
                <li class="menu-item">
                    <a href="{{ route('owner.index') }}" class="menu-item__link{{ str_contains(request()->url(), 'owner') ? ' active' : '' }}">
                        <span class="material-icons">lock</span>
                        <span class="menu-item__text">Owner Panel</span>
                    </a>
                </li>
            @endif
            <li class="menu-item disabled">
                <a href="{{ route('admin.index') }}" class="menu-item__link{{ str_contains(request()->url(), 'admin') && !str_contains(request()->url(), 'owner') ? ' active' : '' }}">
                    <span class="material-icons">security</span>
                    <span class="menu-item__text">Admin Panel</span>
                </a>
            </li>
        @endif
        <div class="menu-title">
            <span>{{ __('menu.groups') }}</span>
        </div>
        <li class="menu-item">
            <a href="{{ route('admins.staff') }}" class="menu-item__link{{ request()->is('staff') ? ' active' : '' }}">
                <span class="material-icons">school</span>
                <span class="menu-item__text">{{ __('menu.staff') }}</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('users.players') }}" class="menu-item__link{{ request()->is('players') ? ' active' : '' }}">
                <span class="material-icons">group</span>
                <span class="menu-item__text">{{ __('menu.players') }}</span>
            </a>
        </li>
        <div class="menu-title">
            <span>{{ __('menu.stats') }}</span>
        </div>
        <li class="menu-item">
            <a href="{{ route('stats.online') }}" class="menu-item__link{{ request()->is('online') ? ' active' : '' }}">
                <span class="material-icons">show_chart</span>
                <span class="menu-item__text">{{ __('menu.online') }}</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('stats.top') }}" class="menu-item__link">
                <span class="material-icons">bar_chart</span>
                <span class="menu-item__text">{{ __('menu.top_players') }}</span>
            </a>
        </li>
        <li class="menu-item disabled">
            <a href="{{ route('stats.bans') }}" class="menu-item__link">
                <span class="material-icons">block</span>
                <span class="menu-item__text">{{ __('menu.banned_players') }}</span>
            </a>
        </li>
    </ul>
</nav>