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
             My Payments
        </h1>
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