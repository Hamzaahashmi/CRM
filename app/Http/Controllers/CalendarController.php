<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function addevent(Request $request)
    {
        $user_id = Auth::User()->id;
        $calendar = new Calendar;
        $calendar->title = $request->title;
        $calendar->start = $request->start;
        $calendar->employe_id = $user_id;
        $calendar->end = $request->end;
        $calendar->save();
        return 'success';
    }

    public function fetchevent(Request $request)
    {
        $user_id = Auth::User()->id;
        $allevent = Calendar::where('employe_id', '=', $user_id)->get()->toArray();
        return response()->json($allevent);

    }

    public function editevent(Request $request)
    {
        $Calendar = Calendar::find($request->id);
        $Calendar->title = $request->title;
        $Calendar->start = $request->start;
        $Calendar->end = $request->end;
        $Calendar->save();
        return 'success';
    }

    public function deleteevent(Request $request)
    {
        Calendar::find($request->id)->delete();
        return 'ok';
    }


}
