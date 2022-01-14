<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Timelog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('admin.home');
    }

    public function create(Request $request)
    {
        if ($request->file('image')) {
            $filePath = $request->file('image');
            $fileName = $filePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('profile', $fileName, 'public');
        }
        $emp = new User;
        $emp->name = $request->name;
        $emp->email = $request->email;
        $emp->role = $request->role;
        $emp->phone = $request->phone;
        $emp->salary_package = $request->salry;
        $emp->dob = $request->dob;
        $emp->image = 'storage/' . $path;
        $emp->password = Hash::make($request->password);
        $emp->save();
        return 'ok';
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $image = User::Find($request->id);
            $image_path = public_path($image['image']);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            User::find($request->id)->delete();
            return 'success';
        }
    }
}
