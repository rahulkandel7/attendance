@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bulma.min.css">

@endsection


@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-indigo-600 pt-6" >
             Leave Letter
        </h1>
        <div>
            <a href="{{route('applications.create')}}" class=" ml-6 py-2 px-8 rounded-md bg-green-500 hover:bg-green-600 text-white text-xl cursor-pointer">Ask Leave</a> 
        </div>
    </div>
    <hr>

    <table class="w-full shadow-md mt-4" id="table">
        <thead>
            <tr class="border border-gray-400 ">
            
                <td class="py-2 border border-gray-300 px-2">
                    ID
                </td>
               
                <td class="py-2 border border-gray-300 px-2">
                    Subject
                </td>
    
                <td class="py-2 border border-gray-300 px-2">
                    Status
                </td>

                <td class="py-2 border border-gray-300 px-2">
                    Submitted Date
                </td>
               
                <td class="py-2 border border-gray-300 px-2">
                    Action
                </td>
                
                
            </tr>
        </thead>
        @php
            $i =1;
        @endphp
        <tbody>
            @foreach ($applications as $application)
            <tr class="border border-gray-400 ">
                
                <td class="py-2 border border-gray-300 px-2">
                    @php
                        echo $i++;
                    @endphp
                </td>
               
                <td class="py-2 border border-gray-300 px-2">
                    {{$application->subject}}
                </td>

                <td class="py-2 border border-gray-300 px-2">
                    {{$application->status}}
                </td>

                <td class="py-2 border border-gray-300 px-2">
                    {{\Carbon\Carbon::parse($application->created_at)->format('Y-m-d')}}
                </td>
                
                <td class="py-2 border border-gray-300 px-2 flex">
                    <a href="{{route('applications.show',$application->id)}}" title="View">
                        <i class="fa-solid fa-eye text-2xl px-2 text-indigo-500 hover:text-indigo-600 cursor-pointer"></i>
                    </a>
                    @if($application->status == 'pending')
                    <a href="{{route('applications.edit',$application->id)}}"><i class="text-2xl px-2 fa-solid fa-pen-to-square text-indigo-500 hover:text-indigo-600 cursor-pointer"></i></a>
                    @endif
                    
                    
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