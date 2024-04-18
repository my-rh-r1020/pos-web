@extends('layout.dashboard.main')

@section('title','Update Profile')

@section('mainContent')
<div class="mb-8 text-grayText">
    <h3 class="content-title">Edit Profile</h3>
</div>
<div class="bg-[#fff] rounded-md p-4">
    <form action="{{ route('users.update',$user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <div class="relative mb-5">
                    <input type="text" id="floating_name" name="fullname" value="{{ old('fullname',$user->fullname) }}" class="form-input border-1 peer" placeholder=" " />
                    <label for="floating_name" class="form-label">Full Name</label>
                    @error('fullname')
                    <p class="error-form-msg">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="block mb-2 text-base font-medium text-gray-900">Role</label>
                    <ul class="grid md:grid-cols-3 gap-2 lg:gap-4">
                        <li>
                            <input type="radio" id="admin" name="role" value="admin" class="hidden peer" @if ($user->role === 'admin') checked @endif />
                            <label for="admin" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100">
                                <div class="w-full text-lg font-semibold lg:text-center">Admin</div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="staff" name="role" value="staff" class="hidden peer" @if ($user->role === 'staff') checked @endif />
                            <label for="staff" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100">
                                <div class="w-full text-lg font-semibold lg:text-center">Staff</div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="user" name="role" value="user" class="hidden peer" @if ($user->role === 'user') checked @endif />
                            <label for="user" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100">
                                <div class="w-full text-lg font-semibold lg:text-center">User</div>
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="relative mb-5">
                    <input type="text" id="floating_address" name="address" value="{{ old('address',$user->address) }}" class="form-input border-1 peer" placeholder=" " />
                    <label for="floating_address" class="form-label">Address</label>
                    @error('address')
                    <p class="error-form-msg">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative mb-5">
                    <input type="text" id="floating_phoneNumber" name="phoneNumber" value="{{ old('phoneNumber',$user->phoneNumber) }}" class="form-input border-1 peer" placeholder=" " maxlength="13" />
                    <label for="floating_phoneNumber" class="form-label">Phone Number</label>
                    @error('phoneNumber')
                    <p class="error-form-msg">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative mb-5">
                    <input type="email" id="floating_email" name="email" value="{{ old('email',$user->email) }}" class="form-input border-1 peer" placeholder=" " readonly/>
                    <label for="floating_email" class="form-label">Email</label>
                    @error('email')
                    <p class="error-form-msg">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <img src="{{ asset('storage/profile-image/'.auth()->user()->avatar) }}" alt="avatar" class="my-4 border-8 rounded-full mx-auto" width="250px" height="250px">

                <label class="block mb-2 text-base font-medium text-gray-900">Upload Avatar</label>
                <input type="file" name="avatar" class="block w-full mb-1 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                <p class="text-sm text-gray-500">PNG, JPG, JPEG (MAX. 800x400px).</p>
                @error('avatar')
                <p class="error-form-msg">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div>
            <button type="submit" class="mt-4 md:mt-0 submit-btn">Update</button>
        </div>
    </form>
</div>
@endsection
