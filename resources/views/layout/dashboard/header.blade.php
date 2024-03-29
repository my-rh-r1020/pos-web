<section class="header-section">
    <div class="px-4 py-2">
        <div class="flex justify-end pr-2 gap-x-2">
            <img id="avatarBtn" type="button" data-dropdown-toggle="avatarDropdown" data-dropdown-placement="bottom-start" src="{{ asset('assets/images/'.auth()->user()->avatar) }}" alt="" class="w-10 h-10 rounded-full cursor-pointer">

            <div id="avatarDropdown" class="z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-48">
                <div class="px-4 py-3 text-grayText cursor-default">
                    <span class="text-base font-semibold">{{ auth()->user()->fullname }}</span>
                    <p class="text-sm truncate">{{ auth()->user()->email }}</p>
                </div>
                <ul class="py-2 text-sm text-grayText " aria-labelledby="avatarBtn">
                  <li class="hover:bg-sky-600 hover:text-white">
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2">Dashboard</a>
                  </li>
                  <li class="hover:bg-sky-600 hover:text-white">
                    <a href="#" class="block px-4 py-2">Settings</a>
                  </li>
                </ul>
                <div class="py-1">
                    <form action="{{ route('user-logout') }}" method="post">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 text-sm text-start text-grayText hover:bg-sky-600 hover:text-white">Logout</button>
                    </form>
                  {{-- <a href="#" class="block px-4 py-2 text-sm text-grayText hover:bg-sky-600 hover:text-white">Logout</a> --}}
                </div>
            </div>
        </div>
    </div>
</section>
