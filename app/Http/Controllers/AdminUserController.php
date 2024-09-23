<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    function index()
    {
        $users = User::paginate(5);
        return view('admin.users.index', compact('users'));
    }
    function create()
    {
        return view('admin.users.create');
    }
    function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ] );
            return redirect()->route('users.index')->with('success', 'User create successfully');

    }
    function edit($id){
        $users = User::findOrFail($id);
        return view('admin.users.edit',compact('users'));
    }
    function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $users = User::findOrFail($id);
        $users->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'usertype' =>$request->usertype,
            ] );
            return redirect()->route('users.index')->with('success', 'User update successfully');
    }
    function destroy($id){
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'Delete successfully');
    }

}
