<aside class="sidebar">
    <header>
        <div class="flex items-center">
            <div class="min-w-[60px] flex items-center justify-center">
                <img src="assets/images/logo.png" alt="logo">
            </div>
            <div class="header-text">
                <span class="font-semibold">POS Dashboard</span>
                <span class="mt-[-2px]">By Rifaldi H</span>
            </div>
        </div>
        <span class="toggle">
            <i class="bx bx-chevron-left hover:-translate-x-[2px]"></i>
        </span>
    </header>

    <div class="navbar-menu">
        <div class="mt-6">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ Request::is('dashboard') ? 'active':'' }}">
                    <span class="nav-icon">
                        <i class="bx bxs-home"></i>
                    </span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <ul>
                <li>
                    <a href="#">
                        <span class="nav-icon">
                            <i class='bx bxs-component'></i>
                        </span>
                        <span class="nav-text">Products</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="nav-icon">
                            <i class='bx bxs-package'></i>
                        </span>
                        <span class="nav-text">Transactions</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="#">
                        <span class="nav-icon">
                            <i class="bx bx-menu"></i>
                        </span>
                        <span class="nav-text">Menu 3</span>
                    </a>
                </li> --}}
                <li>
                    <a href="{{ route('users-data') }}" class="{{ Request::is('users') ? 'active':'' }}">
                        <span class="nav-icon">
                            <i class='bx bxs-user-account'></i>
                        </span>
                        <span class="nav-text">Users</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>

@push('scripts')
    <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('.sidebar'),
            sidebarToggle = body.querySelector('.toggle');

        sidebarToggle.addEventListener('click',()=>{
            sidebar.classList.toggle('close');
        });
    </script>
@endpush
