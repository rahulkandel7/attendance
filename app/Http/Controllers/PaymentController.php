<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        $payments =  Payment::where('user_id',$id)->get();
        return view('payments.index',compact('payments','user'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'=> 'required',
            'month' => 'required',
            'date'=> 'required',
            'salary'=> 'required',
            'incentive'=> 'required',
            'tax'=> 'required',
            'other_field'=> 'nullable',
            'other_field_amount'=> 'nullable',

        ]);
        
        Payment::create($data);
        return 'Payment Added Succesfully';
    }

    public function edit($id)
    {
        $payment = Payment::find($id);
        return view('payments.edit',compact('payment'));
    }

    public function update(Request $request,$id)
    {
        $payment = Payment::find($id);
        $data = $request->validate([
            'user_id'=> 'nullable',
            'month' => 'required',
            'date'=> 'required',
            'salary'=> 'required',
            'incentive'=> 'required',
            'tax'=> 'required',
            'other_field'=> 'nullable',
            'other_field_amount'=> 'nullable',

        ]);


        
        $payment->update($data);
        return redirect(route('payments.index',$payment->user_id))->with('success', 'Payment Updated Successfully');
    }

    public function delete($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return redirect()->back()->with('success', 'Payment Delete Successfully');

    }
}
