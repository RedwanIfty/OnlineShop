@auth
    <!-- Content for authenticated users -->
    <p>Welcome, {{ auth()->user()->name }}!</p>
    <p>Your email: {{ auth()->user()->email }}</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a class="dropdown-item" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
            <i class="bx bx-power-off me-2"></i>
            <span class="align-middle">Log Out</span>
        </a>
    </form>
@endauth
@guest
    <!-- Content for guest users -->
    <p>Please login to access the content.</p>
    <a href="{{ route('login') }}">Login</a>
@endguest
