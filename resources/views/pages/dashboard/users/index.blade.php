@extends('layout.dashboard.main')

@section('title','All Users')

@section('mainContent')
<div class="mb-8 text-grayText">
    <h3 class="text-3xl font-medium">Users</h3>
</div>
<div class="bg-[#fff] rounded-md p-4">
    <div class="flex items-center justify-end flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white">
        <div>
            <form method="get">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" id="table-search-users" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for users">
                </div>
            </form>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full sm:text-sm lg:text-base text-left rtl:text-right text-gray-500">
            <thead class="sm:text-xs lg:text-base text-gray-700 uppercase bg-gray-50 text-center">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                        <img class="w-10 h-10 rounded-full" src="{{ asset('storage/profile-image/'.auth()->user()->avatar) }}" alt="{{ $user->fullname }}">
                        <div class="ps-3">
                            <span>{{ $user->fullname }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $user->role }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <button type="button" class="detail-modal-btn" data-modal-target="userDetailModal-{{ $user->id }}" data-modal-toggle="userDetailModal-{{ $user->id }}">
                                <i class='bx bx-show'></i>
                            </button>
                            <a href="{{ route('users.edit',$user->id) }}" class="edit-btn">
                                <i class='bx bxs-edit'></i>
                            </a>
                            @if ($user->role !== 'admin')
                            <button type="button" class="delete-modal-btn" data-modal-target="userDeleteModal-{{ $user->id }}" data-modal-toggle="userDeleteModal-{{ $user->id }}">
                                <i class='bx bxs-trash' ></i>
                            </button>
                            @endif
                        </div>

                        {{-- Modal --}}
                        <div id="userDetailModal-{{ $user->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md lg:max-w-3xl max-h-full">
                                <div class="relative bg-white rounded-lg shadow">
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            Detail User
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="userDetailModal-{{ $user->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <div class="p-4 md:p-5 grid lg:grid-cols-2 gap-2 md:gap-4 xl:gap-6">
                                        <div>
                                            <div class="relative mb-5">
                                                <input type="text" id="floating_name" value="{{ $user->fullname }}" class="form-input border-1 peer" placeholder=" " disabled/>
                                                <label for="floating_name" class="form-label">Full Name</label>
                                            </div>
                                            <div class="relative mb-5">
                                                <input type="text" id="floating_role" value="{{ $user->role }}" class="form-input border-1 peer" placeholder=" " disabled/>
                                                <label for="floating_role" class="form-label">Role</label>
                                            </div>
                                            <div class="relative mb-5">
                                                <input type="text" id="floating_address" value="{{ $user->address }}" class="form-input border-1 peer" placeholder=" " disabled/>
                                                <label for="floating_address" class="form-label">Address</label>
                                            </div>
                                            <div class="relative mb-5">
                                                <input type="text" id="floating_phoneNumber" value="{{ $user->phoneNumber }}" class="form-input border-1 peer" placeholder=" " disabled/>
                                                <label for="floating_phoneNumber" class="form-label">Phone Number</label>
                                            </div>
                                            <div class="relative mb-5">
                                                <input type="text" id="floating_email" value="{{ $user->email }}" class="form-input border-1 peer" placeholder=" " disabled/>
                                                <label for="floating_email" class="form-label">Email</label>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="text-sm lg:text-base font-medium text-gray-900">Avatar</label>
                                            <img src="{{ asset('storage/profile-image/'.auth()->user()->avatar) }}" alt="avatar" class="mt-2 border-8 rounded-full mx-auto" width="300px" height="300px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="userDeleteModal-{{ $user->id }}" data-modal-backdrop="static" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow">
                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="userDeleteModal-{{ $user->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <form action="{{ route('users.destroy',$user->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete category <b>{{ $user->fullname }}</b> ?</h3>
                                            <button data-modal-hide="userDeleteModal-{{ $user->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm lg:text-base inline-flex items-center px-5 py-2 text-center">
                                                Delete Now
                                            </button>
                                            <button data-modal-hide="userDeleteModal-{{ $user->id }}" type="button" class="py-2 px-5 ms-3 text-sm lg:text-base font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            {{ $users->links() }}
        </table>
    </div>
</div>
@endsection

@push('scripts')
@if (session('success'))
<script type="module">
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    Toast.fire({
        icon: 'success',
        title: '{{ session('success') }}'
    })
</script>
@endif
@endpush
