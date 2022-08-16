@extends('layouts.app')

@section('content')

    @include('layouts.message')
    <div class="w-full h-screen bg-opacity-60">
        <h1 class="text-2xl py-8 text-indigo-500 font-bold">
            Edit User:- {{$user->name}}
        </h1>
           
        <form action="{{route('users.update',$user->id)}}" method="post">
            @method('put')
            @csrf
            @foreach($errors->all() as $message)
                <li class="px-4 text-red-500 font-bold">{{$message}}</li>
            @endforeach
            <div class="my-2 py-2 mx-6">
                <input type="text" class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" name="name" placeholder="Enter Name" required value="{{$user->name}}">
            </div>

            <div class="my-2 py-2 mx-6">
                <input type="text" class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" name="email" placeholder="Enter Email Address" required value="{{$user->email}}">
            </div>

            {{-- <div class="py-2 mx-6">
                <input type="password" class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" name="password" value="{{$user->password}}" placeholder="Enter Password"  >
            </div>

            {{$user->password}}

            <div class="py-2 mx-6">
                <input type="password" class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" value="{{$user->password}}" name="password_confirmation" placeholder="Confirm Password" >
            </div> --}}

            <div class="my-2 py-2 mx-6">
                <input type="text" class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" name="address" placeholder="Enter Address" required value="{{$user->address}}">
            </div>

            <div class="my-2 py-2 mx-6">
                <input type="text" class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" name="phone" placeholder="Enter Phone Number" required value="{{$user->phone}}">
            </div>

            <div class="my-2 py-2 mx-6">
                <input type="text" class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" name="position" placeholder="Enter Employee Position" required value="{{$user->position}}">
            </div>

            <div class="my-2 py-2 mx-6">
                <label class="py-2 text-gray-500 font-bold">Entry Date of Birth</label>
                <input type="date" class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" name="dob" placeholder="Enter Entry Time" required value="{{$user->dob}}">
            </div>

            <div class="my-2 py-2 mx-6">
                <label class="py-2 text-gray-500 font-bold">Entry Time</label>
                <input type="time" class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" name="entry_time" placeholder="Enter Entry Time" required value="{{$user->entry_time}}">
            </div>

            <div class="my-2 py-2 mx-6">
                <label class="py-2 text-gray-500 font-bold">Exit Time</label>
                <input type="time" class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" name="exit_time" placeholder="Enter Exit Time" required value="{{$user->exit_time}}">
            </div>

            <div class="flex justify-center mt-2 pb-6">
                <input type="submit" value="Update" class="px-8 py-2 bg-gray-500 rounded-full text-white hover:bg-gray-700 cursor-pointer">
            </div>
        </form>

    </div>
@endsection