@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bulma.min.css">

@endsection

@section('content')
    <h1 class="text-3xl font-bold text-indigo-600 pt-6" >
        All Employees
    </h1>
    <hr>

    <table class="w-full shadow-md" id="table">
        <thead>
            <tr class="border border-gray-400 ">
                <td class="py-2 border border-gray-300 pl-1">
                    ID
                </td>
                <td class="py-2 border border-gray-300 pl-1">
                    Name
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Email
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Address
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Phone Number
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Date Of Birth
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Role
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Position
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Entery Time
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Exit Time
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Actions
                </td>
                
            </tr>
        </thead>
        @php
            $i = 1;
        @endphp
        <tbody>
            @foreach ($users as $user)
                <tr class="border border-gray-400 ">
                    <td class="py-2 border border-gray-300 px-2">
                        @php
                            echo $i++;
                        @endphp
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                        {{$user->name}}
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                        {{$user->email}}
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                        {{$user->address}}
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                        {{$user->phone}}
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                        {{$user->dob}}
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                        {{$user->role == "expire" ? 'Inactive' : 'Active'}}
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                    {{ $user->position}}
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                        {{$user->entry_time}}
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                        {{$user->exit_time}}
                    </td>
                    <td class="flex py-2 px-2">
                        

                        <a href="{{route('users.edit',$user->id)}}"><i class="text-2xl px-2 fa-solid fa-pen-to-square text-indigo-500 hover:text-indigo-600 cursor-pointer"></i></a>

                        <form action="{{route('users.revive',$user->id)}}" method="post">
                            @method('put')
                            @csrf
                            <button type="submit"><i class="fa-solid fa-heart text-2xl px-2 text-green-500 hover:text-green-600"></i></button>
                        </form>

                        <form action="{{route('users.expire',$user->id)}}" method="post">
                            @method('put')
                            @csrf
                            <button type="submit"><i class="fa-solid fa-times text-2xl px-2 text-red-500 hover:text-red-600"></i></button>
                        </form>

                        <a title="Payment" href="{{route('payments.index',$user->id)}}"><i class="fa-solid fa-money-bill text-2xl px-2 text-emerald-500 hover:text-emerald-600"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bulma.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>

@endsection