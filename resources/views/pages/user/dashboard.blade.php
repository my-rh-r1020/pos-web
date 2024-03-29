@extends('layout.dashboard.main')

@section('title','Dashboard POS')

@section('mainContent')
<div class="mb-8 text-grayText">
    <h3 class="text-3xl font-medium">Dashboard</h3>
</div>
<div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
    <div class="bg-[#fff] rounded-md p-4">
        <div class="grid grid-cols-3 gap-2 text-grayText">
            <div class="col-span-2">
                <i class='bx bxs-data text-4xl font-medium mb-3'></i>
                <span class="text-base block">Data Apa Saja Yang Penting Data</span>
            </div>
            <div class="flex items-center justify-center text-3xl font-medium">1</div>
        </div>
    </div>
    <div class="bg-[#fff] rounded-md p-4">
        <div class="grid grid-cols-3 gap-2 text-grayText">
            <div class="col-span-2">
                <i class='bx bxs-data text-4xl font-medium mb-3'></i>
                <span class="text-base block">Data Apa Saja Yang Penting Data</span>
            </div>
            <div class="flex items-center justify-center text-3xl font-medium">2</div>
        </div>
    </div>
</div>
@endsection
