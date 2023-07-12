<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/user/login');
    }

    public function userLogin(){

        return view('user.user_login');
    }

    public function index()
    {
        $data_user = User::latest()->get();
        
        return view('admin.backend.user.index', compact('data_user'));
    }

    public function userDashboard(){
        return redirect()->route('user.list.room');
    }

    public function create()
    {
        $data_user = User::latest()->get();
        return view('admin.backend.user.create',compact('data_user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request-> name;
        $user->email = $request->email;
        $user->role = 'user';
        $user->password = Hash::make($request->password);
        $user->save();

        $notification_success = array(
            'message' => 'Data User Baru berhasil ditambahkan!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.user.create')
            ->with($notification_success);
    }

    public function show($user_id)
    {
        //
        $data_user = User::findOrFail($user_id);

        return view('admin.backend.user.index', compact('data_user'));
    }

    public function edit($user_id)
    {
        $data_user = User::findOrFail($user_id);

        return view('admin.backend.user.edit', compact('data_user'));
    }

    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $user->name = $request-> name;
        $user->email = $request->email;
        $user->save();

        $notification_success = array(
            'message' => 'Data User berhasil diupdate!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.user.edit', $user_id)
            ->with($notification_success);
    }

    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();

        $notification_success = array(
            'message' => 'Data User berhasil dihapus!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.user.index')
            ->with($notification_success);
    }
}
