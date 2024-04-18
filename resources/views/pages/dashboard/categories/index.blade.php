@extends('layout.dashboard.main')

@section('title','All Categories')

@section('mainContent')
<div class="flex gap-x-2 mb-8 text-grayText">
    <h3 class="content-title">Categories</h3>
    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="add-modal-btn" type="button">
        <i class='bx bx-plus'></i>
    </button>
</div>
<div class="bg-[#fff] rounded-md p-4">
    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white">
        <div>
            {{-- <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="add-modal-btn" type="button">
                <i class='bx bxs-plus-circle mr-1'></i>
                Category
            </button> --}}
        </div>
        <div>
            <form method="get">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="table-search-category" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for category">
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
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $category->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $category->description }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2 justify-center">
                            <button type="button" data-modal-target="categoryEditModal-{{ $category->slug }}" data-modal-toggle="categoryEditModal-{{ $category->slug }}" class="edit-modal-btn">
                                <i class='bx bxs-edit'></i>
                            </button>
                            <button type="button" data-modal-target="categoryDeleteModal-{{ $category->slug }}" data-modal-toggle="categoryDeleteModal-{{ $category->slug }}" class="delete-modal-btn">
                                <i class='bx bxs-trash' ></i>
                            </button>
                        </div>

                        {{-- Modal --}}
                        <div id="categoryEditModal-{{ $category->slug }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow">
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            Edit Category
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="categoryEditModal-{{ $category->slug }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <form class="p-4 md:p-5" action="{{ route('categories.update',$category->slug) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="relative mb-5">
                                            <input type="text" name="name" id="floating_name" value="{{ old('name',$category->name) }}" class="form-input border-1 peer" placeholder=" " />
                                            <label for="floating_name" class="form-label">Category Name</label>
                                            @error('name')
                                            <p class="error-form-msg">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="relative mb-5">
                                            <textarea rows="3" name="description" id="floating_description" class="form-input border-1 peer" placeholder=" ">{{ $category->description }}</textarea>
                                            <label for="floating_description" class="absolute text-base text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Descriptions</label>
                                            @error('description')
                                            <p class="error-form-msg">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button type="submit" class="mt-4 submit-btn">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="categoryDeleteModal-{{ $category->slug }}" data-modal-backdrop="static" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow">
                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="categoryDeleteModal-{{ $category->slug }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <form action="{{ route('categories.destroy',$category->slug) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete category <b>{{ $category->name }}</b> ?</h3>
                                            <button data-modal-hide="categoryDeleteModal-{{ $category->slug }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm lg:text-base inline-flex items-center px-5 py-2 text-center">
                                                Delete Now
                                            </button>
                                            <button data-modal-hide="categoryDeleteModal-{{ $category->slug }}" type="button" class="py-2 px-5 ms-3 text-sm lg:text-base font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
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
            {{ $categories->links() }}
        </table>
    </div>
</div>

<!-- Add modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    New Category
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form class="p-4 md:p-5" action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="relative mb-5">
                    <input type="text" name="name" id="floating_name" value="{{ old('name') }}" class="form-input border-1 peer" placeholder=" " />
                    <label for="floating_name" class="form-label">Category Name</label>
                    @error('name')
                    <p class="error-form-msg">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative mb-5">
                    <textarea rows="3" name="description" id="floating_description" value="{{ old('description') }}" class="form-input border-1 peer" placeholder=" "></textarea>
                    <label for="floating_description" class="absolute text-base text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Descriptions</label>
                    @error('description')
                    <p class="error-form-msg">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="mt-4 submit-btn">Create</button>
            </form>
        </div>
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
