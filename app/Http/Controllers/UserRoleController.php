<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\User_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UserRoleRequest;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::check('isSuperAdmin')) {
            $users = User::get();
            $roles = Role::get();
            return view('admin.index', compact('users', 'roles'));
        }else{
            return back();
        }
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
    public function store(UserRoleRequest $request)
    {
        if (Gate::check('isSuperAdmin')) {
            $atts = $this->validate($request, $request->rules(), $request->messages());
            $userID = $request->input('user_id');
            $roleID = $request->input('role_id');
            $user = User::find($userID);
            $user->roles()->attach($roleID);
            return back();
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function show(User_role $user_role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function edit(User_role $user_role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function update(UserRoleRequest $request, User_role $user_role, $user_id, $role_id)
    {
        if (Gate::check('isSuperAdmin')) {
            $atts = $this->validate($request, $request->rules(), $request->messages());
            $user = User::find($user_id);
            $user->roles()->updateExistingPivot($role_id, $atts);
            return back();
        }else{
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_role $user_role)
    {
        //
    }
}
