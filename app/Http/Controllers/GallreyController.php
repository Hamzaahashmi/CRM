<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Gallrey;
use Illuminate\Support\Facades\File;


class GallreyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        $user_id = Auth::User()->id;
        $gallreys = Gallrey::where('employe_id', '=', $user_id)->get();
        return view('employe.gallrey', compact('gallreys'));
    }

    public function dropzone(Request $request)
    {
        $user_id = Auth::User()->id;
        if ($request->hasFile('files')) {
            $images = $request->allFiles('files');
            foreach ($images['files'] as $image) {
                $file_size = $image->getSize();
                $file_name = str_replace(" ", "_", $image->getClientOriginalName());
                $file_name = time() . '_' . $file_name;

                $file_extension = $image->getClientOriginalExtension();
                // Uploaded file move into folder
                $folder_path = public_path('storage/gallrey') . '/' . $user_id;
                $image->move($folder_path, trim($file_name));
                // generate uploaded file url
                $image_path = 'gallrey/' . $user_id;
                $file_url = Storage::url($image_path . '/' . $file_name);
                // // insert file information into email resource
                Gallrey::create([
                    'file_name' => $file_name,
                    'file_extension' => $file_extension,
                    'file_size' => $file_size,
                    'file_url' => $file_url,
                    'employe_id' => $user_id,
                ]);
            }
        }
        $user_id = Auth::User()->id;
        $gallreys = Gallrey::where('employe_id', '=', $user_id)->get();
        return view('employe.filegallrey', compact('gallreys'))->render();

    }

    public function deletefiles(Request $request)
    {

        $image = Gallrey::Find($request->id);
        $image_path = public_path($image['file_url']);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        Gallrey::find($request->id)->delete();
        $user_id = Auth::User()->id;
        $gallreys = Gallrey::where('employe_id', '=', $user_id)->get();
        return view('employe.filegallrey', compact('gallreys'))->render();
    }


}
