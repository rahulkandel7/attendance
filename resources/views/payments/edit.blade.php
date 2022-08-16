@extends('layouts.app')

@section('content')

    @include('layouts.message')
    <div class="w-full h-screen bg-opacity-60">
        <h1 class="text-2xl py-8 text-indigo-500 font-bold">
            Edit Payment
        </h1>
           
        <form action="{{route('payments.update',$payment->id)}}" method="post">
            @csrf
            @method('put')
    
            <div class="flex ">
                <div class="py-2 mx-4">
                    <label for="month" class="text-gray-600 font-semibold">Month</label>
                    <input type="text" class="rounded-lg  shadow-lg border border-gray-100 focus:ring-gray-200 w-full  focus:border-gray-600" name="month" id="month" placeholder="Enter Month" value="{{$payment->month}}">

                </div>

                <div class="py-2 mx-4">
                    <label for="date" class="text-gray-600 font-semibold">Date</label>
                    <input type="text" class="rounded-lg  shadow-lg border border-gray-100 focus:ring-gray-200 w-full  focus:border-gray-600" name="date" id="date" placeholder="20xx-xx-xx" value="{{$payment->date}}">

                </div>
            </div>

            <h2 class="text-gray-500 text-2xl font-semibold mx-4 mt-2">
                Earning Field
            </h2>
            <div class="flex">
                <div class="py-2 mx-4">
                    <label for="salary" class="text-gray-600 font-semibold">Basic Salary</label>
                    <input type="number" class="rounded-lg  shadow-lg border border-gray-100 focus:ring-gray-200 w-full  focus:border-gray-600" name="salary" id="salary" placeholder="Basic Salary" value="{{$payment->salary}}">

                </div>

                <div class="py-2 mx-4">
                    <label for="incentive" class="text-gray-600 font-semibold">Incentive Pay</label>
                    <input type="number" class="rounded-lg  shadow-lg border border-gray-100 focus:ring-gray-200 w-full  focus:border-gray-600" name="incentive" id="incentive" placeholder="Enter Incentive Pay" value="{{$payment->incentive}}">

                </div>
            </div>

            <h2 class="text-gray-500 text-2xl font-semibold mx-4 mt-2">
                Deduction Field
            </h2>

            <div class="py-2 mx-4">
                <label for="tax" class="text-gray-600 font-semibold">Tax (in Percentage)</label>
                <input type="text" class="rounded-lg  shadow-lg border border-gray-100 focus:ring-gray-200 w-full  focus:border-gray-600" name="tax" id="tax" value="{{$payment->tax}}">

            </div>

            <div class="flex">

                <div class="py-2 mx-4">
                    <label for="other_field" class="text-gray-600 font-semibold">Other Field</label>
                    <input type="text" class="rounded-lg  shadow-lg border border-gray-100 focus:ring-gray-200 w-full  focus:border-gray-600" name="other_field" id="other_field" placeholder="Enter Other Field" value="{{$payment->other_field}}">

                </div>

                <div class="py-2 mx-4">
                    <label for="other_field_amount" class="text-gray-600 font-semibold">Other Field Amount</label>
                    <input type="number" class="rounded-lg  shadow-lg border border-gray-100 focus:ring-gray-200 w-full  focus:border-gray-600" name="other_field_amount" id="other_field_amount" placeholder="Enter Other Field Amount" value="{{$payment->other_field_amount}}">

                </div>
            </div>


            <div class="flex  mt-2 mb-6">
                <input type="submit" value="Edit Payment" class="py-2 px-8 mr-4 rounded-md bg-gray-500 hover:bg-gray-600 text-white text-xl cursor-pointer" id="submit">
                <a href={{route('payments.index',$payment->user_id)}} class="py-2 px-8 rounded-md bg-red-500 hover:bg-red-600 text-white text-xl cursor-pointer" > Cancel </a>
            </div>
        </form>

    </div>
@endsection