<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function users()
    {
        $users = User::all();

        return view('user',compact('users'));
    }

    public function attendance()
    {
        $employees = User::all();
        return view('attendance',compact('employees'));
    }

    public function attendanceView($id)
    {
        $user = User::find($id);
        $attendances = Attendance::where('user_id',$id)->get();
        $month = Attendance::where('user_id',$user->id)->whereMonth('created_at',date('m'))->count();
        $total = Attendance::where('user_id',$user->id)->count();
        $late = Attendance::where('user_id',$user->id)->whereNotNull('late_entry')->whereMonth('created_at',date('m'))->count();


        return view('viewattendance',compact('attendances','user','month','total','late'));
    }
    public function monthview($id)
    {
        $user = User::find($id);
        $months = Attendance::where('user_id',$user->id)->whereMonth('created_at',date('m'))->get();

        return view('month',compact('user','months'));
    }
    public function lateview($id)
    {
        $user = User::find($id);
        $late = Attendance::where('user_id',$user->id)->whereNotNull('late_entry')->whereMonth('created_at',date('m'))->get();

        return view('lateview',compact('user','late'));
    }

    public function empAttendance()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $attendances = Attendance::where('user_id',$id)->get();
        return view('employee.attendance',compact('attendances','user'));
    }

    public function dashboard(){

        $attendances = Attendance::where('user_id',Auth::user()->id)->get();


        $date = Carbon::parse(Auth::user()->dob)->format('d');
        $date1 = Carbon::now()->format('d');
        $mybirthday = $date-$date1 == 0 ? true: false;


        $total_employee = User::where('role','user')->count();
        $clocked_in = Attendance::where('date_recorded',Carbon::now()->format('Y-m-d'))->count();
        $not_clocked_in =$total_employee - Attendance::where('date_recorded',Carbon::now()->format('Y-m-d'))->count();
        $total_application = Leave::all()->count();
        
        $today_leave = Leave::where('created_at','=' ,Carbon::now()->format('Y-m-d'))->count();


        $totalBirthday = 0;
        $hbirthday = 0;
        $birthdays = User::whereMonth('dob',Carbon::now())->get();
        foreach ($birthdays as $birthday) {
            $datee = Carbon::parse($birthday->dob)->format('d');


            $totalBirthday= $datee-$date1;
            if($totalBirthday > 0){
                $hbirthday++;
            }

        }

        $ta = Attendance::where('user_id',Auth::user()->id)->count();
        $month = Attendance::where('user_id',Auth::user()->id)->whereMonth('created_at',date('m'))->count();
        $le =  Attendance::where('user_id',Auth::user()->id)->whereNotNull('late_entry')->count();
        $ee =  Attendance::where('user_id',Auth::user()->id)->whereNotNull('early_exit')->count();

        return view('dashboard',compact('attendances','ta','le','ee','total_employee','clocked_in', 'not_clocked_in','total_application','today_leave','month','birthdays','mybirthday', 'hbirthday'));
    }

    public function clockedin()
    {
        $users = Attendance::where('date_recorded',Carbon::now()->format('Y-m-d'))->get();

        return view('clocked.clockedin',compact('users'));
        
    }

    public function notclocked()
    {
        $user = Attendance::where('date_recorded',Carbon::now()->format('Y-m-d'))->pluck('user_id');
        $users = User::whereNotIn('id',$user)->where('role','user')->get();
        return view('clocked.notclocked',compact('users'));
        
    }

    public function application()
    {
        $applications = Leave::all();

        return view('employee.leave',compact('applications'));
    }

    public function todayapplication()
    {
        $applications = Leave::where('created_at','=' ,Carbon::now()->format('Y-m-d'))->get();
        
        return view('employee.leave',compact('applications'));
    }

    public function birthday()
    {
        $birthdays = User::whereMonth('dob',Carbon::now())->get();
        // $birthdays = User::whereMonth('dob',Carbon::now())->count();
        // dd($birthdays);


        foreach ($birthdays as $birthday) {
            $date = Carbon::parse($birthday->dob)->format('d');
            $date1 = Carbon::now()->format('d');


            $birthday->date = $date-$date1;

        }

        
        return view('birthdays',compact('birthdays'));
    }

    public function payments()
    {
        $payments = Payment::where('user_id',Auth::user()->id)->get();

        return view('payments',compact('payments'));
    }
}
