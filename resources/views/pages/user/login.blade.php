@extends('layout.auth.auth')

@section('title','Login')

@section('authContent')
<section class="flex items-center justify-center h-screen">
    <div class="auth-container">
        <div class="mb-6 text-center">
            <h3 class="uppercase text-3xl font-semibold mb-1">Login</h3>
            <span class="text-grayText">Enter your email and password</span>
        </div>
        <form>
            <div class="relative z-0 w-full mb-5 group">
                <input type="email" name="email" id="floating_email" class="block py-2.5 px-0 w-full text-base text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="floating_email" class="peer-focus:font-medium absolute text-base text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
            </div>
            <div class="relative z-0 w-full mb-8 group">
                <input type="password" name="password" id="floating_password" class="block py-2.5 px-0 w-full text-base text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="floating_password" class="peer-focus:font-medium absolute text-base text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
            </div>
            <button type="submit" class="auth-btn">Login</button>
        </form>
        <hr class="my-6">
        <div class="text-center text-grayText text-sm">
            <span>Dont have an account? Register <a href="{{ route('register') }}" class="hover:text-blue-600">Here</a></span>
        </div>
    </div>
</section>
@endsection
