<div class="card p-3 text-center">
    <img src="{{ Auth::user()->profile_image_url }}" 
         class="rounded-circle mx-auto mb-3" width="120" height="120" alt="Profile">
    <h5 class="fw-bold">{{ Auth::user()->name }}</h5>
    <p class="text-muted small">{{ Auth::user()->email }}</p>
</div>

<ul class="list-group mt-3">
    <a href="{{ route('account.profile') }}" 
       class="list-group-item {{ request()->routeIs('account.profile') ? 'active' : '' }}">
       <i class="bi bi-person"></i> My Profile
    </a>
    <a href="{{ route('account.orders') }}" 
       class="list-group-item {{ request()->routeIs('account.orders') ? 'active' : '' }}">
       <i class="bi bi-bag"></i> Orders History
    </a>
    <a href="{{ route('account.addresses') }}" 
       class="list-group-item {{ request()->routeIs('account.addresses') ? 'active' : '' }}">
       <i class="bi bi-geo-alt"></i> My Address
    </a>
    <li class="list-group-item">
        <form method="POST" action="{{ route('frontend.logout') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0"><i class="icon icon-logout"></i> Logout</button>
        </form>
    </li>
</ul>
