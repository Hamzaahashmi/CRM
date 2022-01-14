<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Timelog;
use App\Models\Gallrey;



class EmployeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('employe');
    }

    public function index()
    {
        $user_id = Auth::User()->id;
        $timelog_record = Timelog::select('start_time', 'end_time')->where('employe_id', '=', $user_id)->get();
        $timelogs = Timelog::where('employe_id', '=', $user_id)->where('end_time', '=', null)->count();
        $data= Gallrey::where('employe_id', '=', $user_id)->sum('file_size');
        $data = $data / 1000000 ;
        return view('employe.employedashboard', compact('timelogs', 'timelog_record','data'));
    }
}
