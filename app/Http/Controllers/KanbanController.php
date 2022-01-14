<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Kanban;
use App\Models\Project;
use Illuminate\Http\Request;

class KanbanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function kanban($id)
    {
        $donetisckets = Kanban::where('project_id', '=', $id)->where('status', '=', 'done')->get();
        $todotisckets = Kanban::where('project_id', '=', $id)->where('status', '=', 'todo')->get();
        $progresstisckets = Kanban::where('project_id', '=', $id)->where('status', '=', 'progress')->get();
        $deletetisckets = Kanban::where('project_id', '=', $id)->where('status', '=', 'delete')->get();
        return view('employe.kanbanboard', compact('donetisckets', 'todotisckets', 'progresstisckets', 'deletetisckets', 'id'));
    }

    public function addticket(Request $request)
    {
        $id = $request->pid;
        if ($request->ajax()) {
            $user_id = Auth::User()->id;
            $kanban = new Kanban;
            $kanban->title = $request->ttitle;
            $kanban->description = $request->tdescription;
            $kanban->employe_id = $user_id;
            $kanban->project_id = $request->pid;
            $kanban->save();
            return $id;
            // $donetisckets= Kanban::where('employe_id','=',$user_id)->where('status', '=', 'done')->get();
            //  $todotisckets= Kanban::where('employe_id','=',$user_id)->where('status', '=', 'todo')->get();
            //  $progresstisckets= Kanban::where('employe_id','=',$user_id)->where('status', '=', 'progress')->get();
            //  $deletetisckets= Kanban::where('employe_id','=',$user_id)->where('status', '=', 'delete')->get();
            //  return view('employe.kanbanboardcontent',compact('donetisckets','todotisckets','progresstisckets','deletetisckets','id'))->render();
        }
    }

    public function updticketstatus(Request $request)
    {
        $dropstatus = explode(" ", $request->cname);
        switch ($dropstatus[1]) {
            case "progress":
                $updatestatus = Kanban::find($request->id);
                $updatestatus->status = 'progress';
                $updatestatus->save();
                return 'progress';
                break;
            case "Gone":
                $updatestatus = Kanban::find($request->id);
                $updatestatus->status = 'delete';
                $updatestatus->save();
                return 'delete';
            case "To-do":
                $updatestatus = Kanban::find($request->id);
                $updatestatus->status = 'todo';
                $updatestatus->save();
                return 'todo';
            default:
                $updatestatus = Kanban::find($request->id);
                $updatestatus->status = 'done';
                $updatestatus->save();
                return 'done';
        }
    }

    public function deleteticket(Request $request)
    {
        if ($request->ajax()) {
            Kanban::find($request->id)->delete();
            return 'success';
        }
    }

    public function eallprojects(Request $request)
    {
        $projects = Project::all();
        return view('employe.allprojects', compact('projects'));
    }
}
