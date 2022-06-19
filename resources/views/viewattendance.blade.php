@extends('layouts.app')


@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bulma.min.css">

@endsection

@section('content')
    <h1 class="text-3xl font-bold text-indigo-600 pt-6" >
        View {{$user->name}} Attendance
    </h1>
    <hr>

    <div class="grid grid-cols-3 gap-10">

        <div class="w-full h-32 bg-pink-500 rounded-lg shadow-md shadow-pink-200 mb-4 ">
            <h1 class="text-white font-bold text-xl pt-4 px-4">
                Total Attendance
            </h1>
            <div class="flex justify-between my-2">
                <i class="fa-solid fa-clipboard-user text-3xl text-gray-100 pl-2 opacity-80"></i>
                <p class="text-right pr-6 font-bold text-white text-3xl">
                    {{$total}} 
                </p>
            </div>
        </div>

        <a href="{{route('monthview',$user->id)}}">
            <div class="w-full h-32 bg-green-500 rounded-lg shadow-md shadow-green-200 mb-4 ">
                <h1 class="text-white font-bold text-xl pt-4 px-4">
                    This Month Attendance
                </h1>
                <div class="flex justify-between my-2">
                    <i class="fa-solid fa-clipboard-user text-3xl text-gray-100 pl-2 opacity-80"></i>
                    <p class="text-right pr-6 font-bold text-white text-3xl">
                        {{$month}} 
                    </p>
                </div>
            </div>
    
        </a>

        <a href="{{route('lateview',$user->id)}}">
            <div class="w-full h-32 bg-amber-500 rounded-lg shadow-md shadow-amber-200 mb-4 ">
                <h1 class="text-white font-bold text-xl pt-4 px-4">
                    Late Entry This Month
                </h1>
                <div class="flex justify-between my-2">
                    <i class="fa-solid fa-clipboard-user text-3xl text-gray-100 pl-2 opacity-80"></i>
                    <p class="text-right pr-6 font-bold text-white text-3xl">
                        {{$late}} 
                    </p>
                </div>
            </div>
        </a>
        
    </div>

    <table class="w-full shadow-md" id="table">
        <thead>
            <tr class="border border-gray-400 ">
            
                <td class="py-2 border border-gray-300 px-2">
                    Date
                </td>
               
                <td class="py-2 border border-gray-300 px-2">
                    Entry Time
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Exit Time
                </td>
    
                <td class="py-2 border border-gray-300 px-2">
                    Hours Worked
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
            @foreach ($attendances as $att)
            <tr class="border border-gray-400 ">
                
                <td class="py-2 border border-gray-300 px-2">
                    {{$att->date_recorded}}
                </td>
               
                <td class="py-2 border border-gray-300 px-2">
                    {{ Carbon\Carbon::parse($att->entry_time)->format('h:i:s a')}}
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    @if ($att->exit_time != null)
                    {{ Carbon\Carbon::parse($att->exit_time)->format('h:i:s a')}}
                   @endif
                </td>
                @php
                    $startTime = Carbon\Carbon::parse($att->entry_time);
                    $endTime = Carbon\Carbon::parse($att->exit_time);

                    $totalDuration =  $startTime->diff($endTime)->format('%H:%I:%S');

                @endphp
                <td class="py-2 border border-gray-300 px-2">
                    @php
                        echo $totalDuration;
                    @endphp
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