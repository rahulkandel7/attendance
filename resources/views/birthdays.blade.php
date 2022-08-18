@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bulma.min.css">

@endsection

@section('content')
    <h1 class="text-3xl font-bold text-indigo-600 pt-6" >
        Upcomming Birthdays
    </h1>
    <hr>

    <table class="w-full shadow-md" id="table">
        <thead>
            <tr class="border border-gray-400 ">
                <td class="py-2 border border-gray-300 pl-1">
                    S.No
                </td>

                <td class="py-2 border border-gray-300 pl-1">
                    Name
                </td>
               
                <td class="py-2 border border-gray-300 pl-1">
                    Birthday In
                </td>

                <td class="py-2 border border-gray-300 pl-1">
                    Birthday Date
                </td>
                
            </tr>
        </thead>
        @php
            $i = 1;
        @endphp
        <tbody>
            @foreach ($birthdays as $birthday)
            @if($birthday->date > -1 )
            <tr class="border border-gray-400 ">
                <td class="py-2 border border-gray-300 px-2">
                    @php
                        echo $i++;
                    @endphp
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    {{$birthday->name}}
                </td>
               
                <td class="py-2 border border-gray-300 px-2">
                    @if($birthday->date == 0) Today is Birthday @else{{$birthday->date}} Days @endif 
                </td>

                <td class="py-2 border border-gray-300 px-2">
                    {{\Carbon\Carbon::parse($birthday->dob)->format('M-d')}} 
                </td>
               
                
            </tr>
            @endif
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