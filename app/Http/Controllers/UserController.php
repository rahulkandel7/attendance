<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class UserController extends Controller
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
        return view('users.user');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => 'required',
            'phone' => 'required|digits:10',
            'entry_time'=>'required',
            'exit_time'=>'required',
            'position' => 'required|string',
            'dob' => 'required',

        ]);

        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->back()->with('success','User Created Sucessfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable'],
            'address' => 'required',
            'phone' => 'required|digits:10',
            'entry_time'=>'required',
            'exit_time'=>'required',
            'position' => 'required|string',

        ]);

        if($request->has('password')){
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->back()->with('success','User Updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success','User Deleted Sucessfully');

    }
    public function expire($id)
    {
        $user = User::findOrFail($id);
        $user->role = "expire";
        $user->update();

        return redirect()->back()->with('success','User Removed Sucessfully');

    }
    public function revive($id)
    {
        $user = User::findOrFail($id);
        $user->role = "user";
        $user->update();

        return redirect()->back()->with('success','User Removed Sucessfully');

    }
}
