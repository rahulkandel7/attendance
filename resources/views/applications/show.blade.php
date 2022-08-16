@extends('layouts.app')



@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-indigo-600 pt-6" >
             Leave Letter
        </h1>
       
    </div>
    <hr>

    @if ($leave->remarks)
    <h1 class="mt-3 text-lg font-bold">
        Remarks: {{$leave->remarks}}
    </h1>
    @endif

    <h1 class="mt-3 text-xl font-bold">
        {{$leave->subject}}
    </h1>

    {!!$leave->description!!}

    @if ($leave->filepath)
        <img src="/storage/{{$leave->filepath}}">
    @endif
@endsection