<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'date_recorded' => 'required',
            'entry_time' => 'required',
            'late_entry' => 'nullable',
        ]);
        $c = Attendance::where('user_id',Auth::user()->id )->where('date_recorded', Carbon::now()->format('Y-m-d'))->count();
        if($c == 0) {
            Attendance::create($data);
    
            return 'Sucessfull';
        }
        else {
             return 'Already ';

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Attendance $attendance)
    {
    }

    public function updated(Request $request)
    {

        $data = $request->validate([
            'user_id' => 'required',
            'date_recorded' => 'required',
            'exit_time' => 'required',
            'early_exit' => 'nullable',
        ]);

        $id = Attendance::where('user_id',Auth::user()->id )->where('date_recorded',Carbon::now()->format('Y-m-d'))->first();

        $c = Attendance::find($id->id);

        $c->exit_time = $data['exit_time'];
        if($request->has('early_exit')){
            $c->early_exit = $data['early_exit'];

        }

        $c->save();
        return 'Sucessfull';


        // if($id->exit_time == null) {
        //     if(Auth::user()->exit_time > Carbon::now()->format('H:i:m')){
        //         $request->validate([
        //             'early_exit' => 'required',
        //         ],[
        //             'early_exit.required' => 'Explain why do you want to go Earlier',
        //         ]);
        //     }


        //     $id->update([
        //         'exit_time'=> Carbon::now()->format('H:i:m'),
        //         'early_exit' => $request->early_exit,
        //     ]);
    
        //     return redirect()->back()->with('success', 'Sucessfully Clocked Out');
        // }
        // else {
        //     return redirect()->back()->with('success', 'Already Clocked Out');

        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
