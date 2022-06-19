<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Leave::where('user_id',Auth::user()->id)->get(); 
        return view('applications.index',compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('applications.create');
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
            'description' => 'required',
            'filepath' => 'nullable|image|mimes:png,jpg',
            'subject' => 'required',
        ]);

        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now()->format('Y-m-d');

        if($request->has('filepath')){
            $fname = Str::random(20);
            $fexe = $request->file('filepath')->extension();
            $fpath = "$fname.$fexe";

            $request->file('filepath')->storeAs('public/leave', $fpath);

            $data['filepath'] = 'leave/'.$fpath;
        }

        Leave::create($data);

        return redirect(route('dashboard'))->with('success', 'Your Leave has been successfully submitted');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leave = Leave::find($id);
        return view('applications.show',compact('leave'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leave = Leave::find($id);

        return view('applications.edit',compact('leave'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $leave = Leave::find($id);
        

        if(Auth::user()->role == "admin"){

            $leave->update([
                'status' => $request->status,
                'remarks' => $request->remarks,
            ]);

            return 'Sucessfully '.$request->status;
        }
        else {

            $data = $request->validate([
                'description' => 'required',
                'filepath' => 'nullable|image|mimes:png,jpg',
                'subject' => 'required',
                'status' => 'nullable',
            ]);
    
            if($request->has('filepath')){
                $fname = Str::random(20);
                $fexe = $request->file('filepath')->extension();
                $fpath = "$fname.$fexe";
    
                $request->file('filepath')->storeAs('public/leave', $fpath);
    
                $data['filepath'] = 'leave/'.$fpath;
            }
    
            $leave->update($data);

            return redirect(route('dashboard'))->with('success', 'Your Leave has been successfully updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        //
    }
}
