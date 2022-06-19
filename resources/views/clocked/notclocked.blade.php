@extends('layouts.app')


@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bulma.min.css">

@endsection

@section('content')
    <h1 class="text-3xl font-bold text-indigo-600 pt-6" >
        Total Not Clocked in Employees
    </h1>
    <hr>

    

    <table class="w-full shadow-md" id="table">
        <thead>
            <tr class="border border-gray-400 ">
            
                <td class="py-2 border border-gray-300 px-2">
                    Name
                </td>
               
                <td class="py-2 border border-gray-300 px-2">
                    Entry Time
                </td>

                <td class="py-2 border border-gray-300 px-2">
                    Exit Time
                </td>
    
                <td class="py-2 border border-gray-300 px-2">
                    Late Entry Reason
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Early Exit Reason
                </td>
                
                
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $att)
            <tr class="border border-gray-400 ">
                
                <td class="py-2 border border-gray-300 px-2">
                    {{$att->name}}
                </td>
               
                <td class="py-2 border border-gray-300 px-2">
                    {{ Carbon\Carbon::parse($att->entry_time)->format('h:i:s a')}}
                </td>

                <td class="py-2 border border-gray-300 px-2">
                    @if ($att->exit_time != null)
                    {{ Carbon\Carbon::parse($att->exit_time)->format('h:i:s a')}}
                   @endif
                </td>
                
                <td class="py-2 border border-gray-300 px-2">
                    {{$att->late_entry}}
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    {{$att->early_exit}}
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