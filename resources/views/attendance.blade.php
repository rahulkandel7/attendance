@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bulma.min.css">

@endsection

@section('content')
    <h1 class="text-3xl font-bold text-indigo-600 pt-6" >
        View Employees Attendance
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
                    Phone Number
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
            @foreach ($employees as $user)
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
                    {{$user->phone}}
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
                <td class="flex py-2 pl-2">
                    <a href="{{route('attendanceview',$user->id)}}" class="px-4 py-2 bg-fuchsia-500 hover:bg-fuchsia-700 rounded-md shadow-md text-white">View Attendance</a>
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