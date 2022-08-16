@extends('layouts.app')


@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bulma.min.css">

@endsection

@section('content')
    <h1 class="text-3xl font-bold text-indigo-600 pt-6" >
        Leave Applications
    </h1>
    <hr>

    <table class="w-full shadow-md mt-4" id="table">
        <thead>
            <tr class="border border-gray-400 ">
            
                <td class="py-2 border border-gray-300 px-2">
                    ID
                </td>
    
                <td class="py-2 border border-gray-300 px-2">
                    Employee Name
                </td>
               
                <td class="py-2 border border-gray-300 px-2">
                    Subject
                </td>
    
                <td class="py-2 border border-gray-300 px-2">
                    Status
                </td>

                <td class="py-2 border border-gray-300 px-2">
                    Date
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
                    @php
                        $user = App\Models\User::find($application->user_id);
                        echo $user->name;
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
                    {{-- <a href="{{route('applications.edit',$application->id)}}"><i class="text-2xl px-2 fa-solid fa-pen-to-square "></i></a> --}}

                    <a href="{{route('applications.show',$application->id)}}" title="View">
                        <i class="fa-solid fa-eye text-2xl px-2 text-indigo-500 hover:text-indigo-600 cursor-pointer"></i>
                    </a>

                    <a onclick="approved({{$application->id}})" title="Approved">
                        <i class="fa-solid fa-circle-check text-2xl px-2 text-green-500 hover:text-green-600 cursor-pointer"></i>
                    </a>

                    <a onclick="rejected({{$application->id}})" title="Rejected">
                        <i class="fa-solid fa-circle-xmark text-2xl px-2 text-red-500 hover:text-red-600 cursor-pointer"></i>
                    </a>

                    
                </td>
                
            </tr>
        @endforeach
        </tbody>

    </table>
@endsection


@section('model')
    <div class="w-full h-screen absolute top-0 bg-black bg-opacity-60  justify-center items-center hidden" id="reason_box">
        <div class="relative glass w-80 h-auto bg-white rounded-md">

            <div class="absolute top-2 right-3">
                <i class="fa-solid fa-circle-xmark text-gray-300 hover:text-red-500 cursor-pointer" id="hideee"></i>
            </div>

            <div class="flex justify-center">
                <img src="{{asset('images/logo.png')}}" class="py-2 w-52">
            </div>

            <form>
                <p class="text-center font-bold text-gray-500 text-xl">Remark</p>

                <div class="py-2 mx-6">
                    <textarea  class="rounded-lg  shadow-lg border border-transparent focus:ring-gray-200 w-full  focus:border-gray-600" placeholder="Reason Here" required id="reason"></textarea>

                </div>
                <div class="flex justify-center mt-2 mb-6">

                    <input type="submit" value="Submit" class="py-2 px-8 rounded-md bg-gray-500 hover:bg-gray-600 text-white text-xl cursor-pointer" id="submit">
                </div>
            </form>
        </div>
    </div>

    <div id="message" class="animate__animated hidden animate__slideInRight dismissible fixed right-8 top-4 z-50">
        <div class="w-auto rounded-md p-2 shadow-lg bg-gray-100 dark:bg-gray-600">
            <p class="border-l-4 border-indigo-400 px-2 text-indigo-900 dark:text-indigo-300 font-bold"><span class="fa fa-check bg-indigo-400 text-white px-1.5 py-0.5 rounded-full font-normal text-sm"></span> 
                <span id="message_text"></span>
            </p>
        </div>
    </div>
    <script>
       $(function() {
            setTimeout(function(){
                $(".dismissible").addClass('animate__slideOutRight').fadeOut(1000);
            }, 2000);
       });
    
    </script>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bulma.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>

    

    <script>

        $('#hideee').click(function(e) {
            e.preventDefault();

            $('#reason_box').removeClass('flex');
            $('#reason_box').addClass('hidden');

        });

        let id;
        function approved(ids){
            id = ids;
            $('#reason_box').removeClass('hidden');
            $('#reason_box').addClass('flex');

            $('#submit').click(function (e) {
                e.preventDefault();
                    $('#reason_box').removeClass('flex');
                    $('#reason_box').addClass('hidden');
                    let i = id;
                    console.log(i);
                    $.ajax({
                        type: 'PUT',
                        url: "applications/"+id,
                        
                        dataType:"json",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "status": "Approved",
                            "remarks": $("#reason").val(),
                            "id": id,
                            },
                            success: function (data) {
                                    console.log('sucess');
                            },
                            error: function(xhr, textStatus, error) {
                                $('#message').toggle('hidden');
                                $('#message_text').html(xhr.responseText);
                                window.setTimeout(function(){location.reload()},2000);
                                
                            },
                        });
                    });
        }


        function rejected(ids){
            id = ids;
            $('#reason_box').removeClass('hidden');
            $('#reason_box').addClass('flex');

            $('#submit').click(function (e) {
                e.preventDefault();
                    $('#reason_box').removeClass('flex');
                    $('#reason_box').addClass('hidden');
                    let i = id;
                    $.ajax({
                        type: 'PUT',
                        url: "applications/"+id,
                        dataType:"json",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "status": "Rejected",
                            "remarks": $("#reason").val(),
                            },
                            success: function (data) {
                                    console.log('sucess');
                            },
                            error: function(xhr, textStatus, error) {
                                $('#message').toggle('hidden');
                                $('#message_text').html(xhr.responseText);
                                window.setTimeout(function(){location.reload()},2000);
                                
                            },
                        });
                    });
        }
       


        
    </script>

@endsection