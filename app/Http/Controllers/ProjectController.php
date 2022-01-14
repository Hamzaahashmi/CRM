<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Timelog;
use App\Models\User;
use App\Models\Project;
use App\Models\Kanban;
use Illuminate\Support\Facades\Mail;


class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        $projects = Project::all();
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.allprojects', compact('users', 'projects'));
    }

    public function addproject(Request $request)
    {
        $stu = new Project;
        $stu->title = $request->ptitle;
        $stu->description = $request->pdescription;
        $stu->assign_user = implode(",", $request->users);
        $stu->save();
        return 'success';
    }

    public function projectboard(Request $request, $id)
    {
        $project_id = $id;
        $users = Project::select('assign_user')->where('id', '=', $id)->get();
        foreach ($users as $user) {
            $user_id = $user['assign_user'];
        }
        $useridarrys = (explode(",", $user_id));
        $userdata = [];
        foreach ($useridarrys as $useridarry) {
            $userdata[] = User::find($useridarry);
        }
        $donetisckets = Kanban::where('project_id', '=', $id)->where('status', '=', 'done')->get();
        $todotisckets = Kanban::where('project_id', '=', $id)->where('status', '=', 'todo')->get();
        $progresstisckets = Kanban::where('project_id', '=', $id)->where('status', '=', 'progress')->get();
        $deletetisckets = Kanban::where('project_id', '=', $id)->where('status', '=', 'delete')->get();
        return view('admin.projectboard', compact('donetisckets', 'todotisckets', 'progresstisckets', 'deletetisckets', 'userdata', 'project_id'));

    }

    public function adminaddticket(Request $request)
    {

        if ($request->ajax()) {
            $kanban = new Kanban;
            $kanban->title = $request->ttitle;
            $kanban->description = $request->tdescription;
            $kanban->employe_id = $request->ticketsuser;
            $kanban->project_id = $request->pid;
            $kanban->save();
            $userdata = User::find($request->ticketsuser);

            $details = [
                'email' => $userdata['email'],
                'title' => $request->ttitle,
                'description' => $request->tdescription,
            ];
            $to_email = $userdata['email'];
            $form_email = 'crm@gmail.com';
            try {
                mail::send('admin.ContactEmail', $details, function ($message) use ($to_email, $form_email) {
                    $message->to($to_email)
                        // ->subject('Contact Message')
                        ->from($form_email);
                });
            } catch (\Exception $e) {
                return $e->getMessage();
            }
            return 'success';
        }
    }

    public function deleteproject(Request $request)
    {
        if ($request->ajax()) {
            Project::find($request->id)->delete();
            Kanban::where('project_id', '=', $request->id)->delete();
            return 'success';
        }
    }
}
