<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Timelog;
use App\Models\User;


class TimelogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function starttime(Request $request)
    {
        if ($request->ajax()) {
            $user_id = Auth::User()->id;
            $timelogs = Timelog::select('id')->where('employe_id', '=', $user_id)->where('end_time', '=', null)->get();
            date_default_timezone_set("Asia/Karachi");
            if (!empty($timelogs[0]->id)) {
                $updatetimelog = Timelog::find($timelogs[0]->id);
                $updatetimelog->end_time = date("Y-m-d h:i:s");
                $updatetimelog->save();
                return 'update';
            } else {
                $timelog = new Timelog;
                $timelog->start_time = date("Y-m-d h:i:s");
                $timelog->employe_id = $user_id;
                $timelog->save();
                return 'create';
            }
        }
    }
}
