@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bulma.min.css">

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        input[type=number] {
        -moz-appearance: textfield;
        }
    </style>

@endsection

@section('content')
@include('layouts.message')
    <div class="flex justify-between  pt-6 items-end">
        <h1 class="text-3xl font-bold text-indigo-600" >
             {{$user->name}} Payments
        </h1>
        <a id="payment" class="px-8 py-2 bg-emerald-500 hover:bg-emerald-700 text-white rounded-md shadow-lg hover:text-white">
            Add Payment
        </a>
    </div>
    <hr>

    <table class="w-full shadow-md" id="table">
        <thead>
            <tr class="border border-gray-400 ">
                <td class="py-2 border border-gray-300 pl-1">
                    ID
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Month
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Basic Salary
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Incentive Pay
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Tax
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Deduction
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Net Pay
                </td>
                <td class="py-2 border border-gray-300 px-2">
                    Payment Date
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
            @foreach ($payments as $payment)
                <tr class="border border-gray-400 ">
                    <td class="py-2 border border-gray-300 px-2">
                        @php
                            echo $i++;
                        @endphp
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                        {{$payment->month}}
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                        Rs. {{$payment->salary}}
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                        Rs. {{$payment->incentive}}
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                        Rs. {{($payment->tax/100) * $payment->salary}}
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                        @if($payment->other_field) {{$payment->other_field}} (Rs. {{$payment->other_field_amount}}) @else - @endif
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                        Rs. {{($payment->salary + $payment->incentive)- (($payment->tax/100) * $payment->salary + $payment->other_field_amount)}}
                    </td>
                    <td class="py-2 border border-gray-300 px-2">
                    {{ $payment->date}}
                    </td>
                    <td class="flex py-2 px-2">
                        

                        <a href=""><i class="text-2xl px-2 fa-solid fa-print text-green-500 hover:text-green-600 cursor-pointer"></i></a>



                        <a href="{{route('payments.edit',$payment->id)}}"><i class="fa-solid fa-pen-to-square text-2xl px-2 text-indigo-500 hover:text-indigo-600"></i></a>


                        <form action="{{route('payments.delete',$payment->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit"><i class="fa-solid fa-trash text-2xl px-2 text-red-500 hover:text-red-600"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>


    </table>
@endsection

@section('model')
    <div class="w-full h-screen z-50 overflow-auto absolute top-0  bg-black bg-opacity-60  justify-center items-center hidden" id="show">
        <div class="flex justify-center mt-[5%]">
            <div class="relative  w-auto h-auto bg-white rounded-md">

                <div class="absolute top-2 right-3">
                    <i class="fa-solid fa-circle-xmark text-gray-300 text-xl hover:text-red-500 cursor-pointer" id="hidee"></i>
                </div>
    
                <div class="flex justify-center">
                    <img src="{{asset('images/logo.png')}}" class="py-2 w-52">
                </div>
                <h1 class="text-center font-bold text-emerald-700 text-2xl">Add Payment</h1>

    
                <form>
    
                    <div class="flex ">
                        <div class="py-2 mx-4">
                            <label for="month" class="text-gray-600 font-semibold">Month</label>
                            <input type="text" class="rounded-lg  shadow-lg border border-gray-100 focus:ring-gray-200 w-full  focus:border-gray-600" name="month" id="month" placeholder="Enter Month">
        
                        </div>
    
                        <div class="py-2 mx-4">
                            <label for="date" class="text-gray-600 font-semibold">Date</label>
                            <input type="text" class="rounded-lg  shadow-lg border border-gray-100 focus:ring-gray-200 w-full  focus:border-gray-600" name="date" id="date" placeholder="20xx-xx-xx">
        
                        </div>
                    </div>

                    <h2 class="text-gray-500 text-2xl font-semibold mx-4 mt-2">
                        Earning Field
                    </h2>
                    <div class="flex">
                        <div class="py-2 mx-4">
                            <label for="salary" class="text-gray-600 font-semibold">Basic Salary</label>
                            <input type="number" class="rounded-lg  shadow-lg border border-gray-100 focus:ring-gray-200 w-full  focus:border-gray-600" name="salary" id="salary" placeholder="Basic Salary">
        
                        </div>
    
                        <div class="py-2 mx-4">
                            <label for="incentive" class="text-gray-600 font-semibold">Incentive Pay</label>
                            <input type="number" class="rounded-lg  shadow-lg border border-gray-100 focus:ring-gray-200 w-full  focus:border-gray-600" name="incentive" id="incentive" placeholder="Enter Incentive Pay">
        
                        </div>
                    </div>

                    <h2 class="text-gray-500 text-2xl font-semibold mx-4 mt-2">
                        Deduction Field
                    </h2>

                    <div class="py-2 mx-4">
                        <label for="tax" class="text-gray-600 font-semibold">Tax (in Percentage)</label>
                        <input type="text" class="rounded-lg  shadow-lg border border-gray-100 focus:ring-gray-200 w-full  focus:border-gray-600" name="tax" id="tax" value="1">
    
                    </div>

                    <div class="flex">
    
                        <div class="py-2 mx-4">
                            <label for="other_field" class="text-gray-600 font-semibold">Other Field</label>
                            <input type="text" class="rounded-lg  shadow-lg border border-gray-100 focus:ring-gray-200 w-full  focus:border-gray-600" name="other_field" id="other_field" placeholder="Enter Other Field">
        
                        </div>

                        <div class="py-2 mx-4">
                            <label for="other_field_amount" class="text-gray-600 font-semibold">Other Field Amount</label>
                            <input type="number" class="rounded-lg  shadow-lg border border-gray-100 focus:ring-gray-200 w-full  focus:border-gray-600" name="other_field_amount" id="other_field_amount" placeholder="Enter Other Field Amount">
        
                        </div>
                    </div>


                    <div class="flex justify-center mt-2 mb-6">
                        <input type="submit" value="Add Payment" class="py-2 px-8 rounded-md bg-gray-500 hover:bg-gray-600 text-white text-xl cursor-pointer" id="submit">
                        <a id="hide" class="py-2 px-8 rounded-md bg-red-500 hover:bg-red-600 text-white hover:text-white ml-4 text-xl cursor-pointer"> Close </a>
                    </div>
                </form>
            </div>
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
        $('#payment').click(function(e) {
            e.preventDefault();

            $('#show').removeClass('hidden');
            $('#show').addClass('flex');

        });
        

        $('#hide').click(function(e) {
            e.preventDefault();

            $('#show').removeClass('flex');
            $('#show').addClass('hidden');

        });

        $('#hidee').click(function(e) {
            e.preventDefault();

            $('#show').removeClass('flex');
            $('#show').addClass('hidden');

        });

    </script>

    <script>
        $("#submit").click(function (e) {
            e.preventDefault();         
            console.log($('#salary').val() * 0.01);
                $.ajax({
                    type: 'POST',
                    url: "{{route('payments.store')}}",
                    dataType:"json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'user_id': '{{$user->id}}',
                        'month' : $('#month').val(),
                        'date': $('#date').val(),
                        'salary': $('#salary').val(),
                        'incentive': $('#incentive').val(),
                        'tax': $('#tax').val(),
                        'other_field': $('#other_field').val(),
                        'other_field_amount': $('#other_field_amount').val(),

                    },
                    success: function (data) {
                        
                    },
                    error: function(xhr, textStatus, error) {
                                $('#message').toggle('hidden');
                                $('#message_text').html(xhr.responseText);
                                window.setTimeout(function(){location.reload()},2000)

                                
                            },
                });
        });
    </script>
@endsection