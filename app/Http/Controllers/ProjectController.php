<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

use App\Mail\RejectingProject;
use App\Mail\AcceptingProject;
use Illuminate\Support\Facades\Mail;

use App\Cat;
use App\User;
use App\InvoiceRow;
use App\Invoice;
use App\Project;
use App\Count;
use DB;
use PDF;
use Image;
use storage;
use File;
use Log;
use Session;

class ProjectController extends Controller
{

    private $photos_path;

    public function __construct()
    {
        $this->middleware('auth');

        $this->photos_path = public_path('/images');

    }

    public function insertProjectStepOne(Request $data) {

        $user = Auth::user();

        $cat_id = $data->input("cat_id");

        $cats = DB::table('cats')->where('id', '=', $cat_id)->first();

        return view('project-insert-two', get_defined_vars())->with(['user' => $user]);

    }


    public function invoice(Request $data) {

        $user = Auth::user();
        
        $users = User::paginate(15);
        
        return view('invoice', get_defined_vars())->with(['user' => $user, 'users' => $users ]);

    }


    public function my_pdf_download() {

        $user = Auth::user();
        
        $projects = Project::where('user_id', $user->id)->where('stat', '2')->get();
        $project_ids = "";

        foreach ($projects as $project) {
          $project_ids .= $project->id.',';
        }
        $project_ids = rtrim($project_ids, ',');
        $date = date("Y-m-d");
        $year = date("Y");

        $invoice = Invoice::create(['user_id'=>$user->id, 'project_ids'=>$project_ids, 'date'=>$date]);


        $pdf = PDF::loadView('pdf.invoice', compact('projects', 'user', 'date', 'invoice', 'year'));
        return $pdf->download('Invoice.pdf');
    }

    public function pdf_download($id) {

      Log::debug($id);

        $user = User::where('id', $id)->first();
        
        $projects = Project::where('user_id', $id)->where('stat', '2')->get();
        $project_ids = "";

        foreach ($projects as $project) {
          $project_ids .= $project->id.',';
        }
        $project_ids = rtrim($project_ids, ',');
        $date = date("Y-m-d");
        $year = date("Y");

        $invoice = Invoice::create(['user_id'=>$user->id, 'project_ids'=>$project_ids, 'date'=>$date]);


        $pdf = PDF::loadView('pdf.invoice', compact('projects', 'user', 'date', 'invoice', 'year'));
        return $pdf->download('Invoice.pdf');
    }



    public function insertProjectStepTwo(Request $data) {

      $user = Auth::user();

      $cat_id = $data->input("cat_id");
      $cats = DB::table('cats')->where('id', '=', $cat_id)->first();

      return view('project-insert-three', get_defined_vars())->with(['user' => $user]);

    }

    public function rejectProject(Request $data) {

        $id = $data->id;
        $project = Project::find($id);
        $project->stat = '3';
        $project->save();  

        //get user email
        $project = Project::where('id', $id)->first();
        $user_id = $project->user_id;
        $user = User::where('id', $user_id)->first();

        // Send Email
        Mail::to($user->email)->send(new RejectingProject($data->emailBody, $project->name, $user->vorname.' '.$user->name));

        Session::flash('alert-success','Project has been successfully rejected.');

        return response()->json(array('msg'=> 'Success'), 200);
    } 


    public function deleteProject(Request $data) {

        $id = $data->id;
        $project = Project::find($id);
        $project->stat = '1';
        $project->save();  

/*        //get user email
        $project = Project::where('id', $id)->first();
        $user_id = $project->user_id;
        $user = User::where('id', $user_id)->first();

        // Send Email
        Mail::to($user->email)->send(new RejectingProject($data->emailBody, $project->name, $user->vorname.' '.$user->name));*/

        Session::flash('alert-success','Project has been successfully deleted.');

        return response()->json(array('msg'=> 'Success'), 200);
    } 


    public function acceptProject(Request $data) {

        $id = $data->id;
        $project = Project::find($id);
        $project->stat = '2';
        $project->save();   

        //get user email
        $project = Project::where('id', $id)->first();
        $user_id = $project->user_id;
        $user = User::where('id', $user_id)->first();

        // Send Email
        Mail::to($user->email)->send(new AcceptingProject($project->name, $user->vorname.' '.$user->name));

        Session::flash('alert-success','Project has been successfully accepted.');

        return response()->json(array('msg'=> 'Success'), 200);
    } 

    public function changeProject(Request $data) {

      if ($data->submit == 'change') {

        $user = Auth::user();
        $projectID = $data->projectID;
        $catID = $data->catID;
        $cats = DB::table('cats')->where('id', '=', $catID)->first();
        $project = DB::table('projects')->where('id', '=', $projectID)->first();
        $changeBlade = $cats->code .'-change';

        return view($changeBlade, compact('project', 'user','cats'))->with(['user' => $user]);

    } elseif ($data->submit=='delete') {

      $projectID = $data->projectID;

      DB::table('projects')
              ->where('id', $projectID)
              ->update(['stat' => 1,

            ]);


      return redirect()->route("project-show")->with('alert-success', 'Das Projekt mit der Projekt ID: ' . $projectID . ' wurde erfolgreich gelöscht!');

    }
  }

    public function ProjectChange(Request $data) {

      $user = Auth::user();

      $project_id = $data['project_id'];

      DB::table('projects')
              ->where('id', $project_id)
              ->update(['name' => $data['name'],
              'beschreibung' => $data['beschreibung'],
              'testimonial' => $data['testimonial'],
              'youtube' => $data['youtube'],
              'name' => $data['name'],
              'cat_name' => $data['cat_name'],
              'copyright' => $data['copyright'],
              'ort' => $data['ort'],
              'extra' => $data['extra'],

            ]);

      return redirect()->route("project-show")->with('alert-success', 'Das Projekt ' . $data['name'] . ' wurde erfolgreich geändert!');


    }

    public function insertProject(Request $data) {


      $cat_id = $data->input("cat_id");
      $group = $data['group'];

      if( $data->has('check') ){
        $check = 1;
      }

      $cats = DB::table('cats')->where('id', '=', $cat_id)->first();
      $userId = Auth::id();
      $user = Auth::user();

      $projectname = time();

      $project_id = DB::table('Projects')->insertGetId([
          'name' => $data->input("name"),
          'projektname' => $projectname,
          'cat_id' => $data->input("cat_id"),
          'cat_name' => $data->input("cat_name"),
          'group' => $group,
          'user_id' => $userId,
          'beschreibung' => $data->input("beschreibung"),
          'youtube' => $data->input("youtube"),
          'copyright' => $data->input("copyright"),
          'testimonial' => $data->input("testimonial"),
          'extra' => $data->input("extra"),
          'check' => $check,
          'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
          'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
      ]);

      Session::flash('alert-success','Project has been added. Please add images for the project');

      return view('project-insert-picture', get_defined_vars())->with(['user' => $user]);
    }


    public function AddImage($project_id, $cat_id) {

      $cats = DB::table('cats')->where('id', '=', $cat_id)->first();
      
      $userId = Auth::id();
      $user = Auth::user();

      //max image = 5 - current image
      $current_image_number = DB::table('images')->where('project_id', $project_id)->count();
      $max_img = 5-$current_image_number;

      if ($max_img <0 ) {
        $max_img = 0;
      }



      return view('project-add-new-picture', get_defined_vars())->with(['user' => $user, 'max_img' => $max_img]);
    }

    public function upload(Request $request)
    {


      // Log::debug('An informational message.');

      $cat_id = $request->input('cat_id');
      $userId = Auth::id();

      $photo = $request->file('file');


      $name = sha1(date('YmdHis') . str_random(30));
      $save_name = $name . '.' . $photo->getClientOriginalExtension();
      // $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();



      if(!File::exists($this->photos_path.'/'.$userId)) {
        File::makeDirectory($this->photos_path.'/'.$userId);
      }

      if(!File::exists($this->photos_path.'/'.$userId.'/'.$cat_id)) {
        File::makeDirectory($this->photos_path.'/'.$userId.'/'.$cat_id);
      }

      if(!File::exists($this->photos_path.'/'.$userId.'/'.$cat_id.'/thumbnail')) {
        File::makeDirectory($this->photos_path.'/'.$userId.'/'.$cat_id.'/thumbnail');
      }


      Image::make($photo)
          ->resize(200, null, function ($constraints) {
              $constraints->aspectRatio();
          })
          ->save($this->photos_path.'/'.$userId.'/'.$cat_id.'/thumbnail/'.$save_name);

      $photo->move($this->photos_path.'/'.$userId.'/'.$cat_id.'/', $save_name);



      if(!File::exists($this->photos_path.'/'.$userId.'/'.$cat_id.'/thumbnail/'.$save_name)) {
        $upload_success = false;
      }else{
        $upload_success = true;
      }




      DB::table('images')->insert([
          ['project_id' => $request['project_id'], 'filename' => $save_name, 'url' => 'images/'.$userId.'/'.$cat_id.'/'.$save_name, 'thumb_url' => 'images/'.$userId.'/'.$cat_id.'/thumbnail/'.$save_name]
      ]);


      Session::flash('alert-success','Images added to project.');


      if ($upload_success) {
          return json_encode(array('fileName' => $save_name , 'status' => 200));
      }else{
          return json_encode(array('fileName' => "" , 'status' => 400));
      }

    }

    public function delete(Request $request)
    {
      $fileName = $request->input('fileName');

      $dynamic_ids = DB::table('images')
            ->join('projects', 'images.project_id', '=', 'projects.id')
            ->select('projects.user_id', 'projects.cat_id')
            ->where('images.filename', $fileName)
            ->get();
      $user = $dynamic_ids[0]->user_id;
      $cat = $dynamic_ids[0]->cat_id;

      $thumb_filePath = 'images/'.$user.'/'.$cat.'/thumbnail/';
      File::delete($thumb_filePath.$fileName);
      $wide_filePath = 'images/'.$user.'/'.$cat.'/';
      File::delete($wide_filePath.$fileName);

      DB::table('Images')->where('filename', '=', $fileName)->delete();
      return $fileName;
    }

    public function show_delete(Request $request)
    {
      $fileName = $request->input('fileName');
      $userId = Auth::id();
      $user = DB::table('users')->where('id', $userId)->first();
      $role = $user->rolle;
      if ($role == 0 || $role == 9){
        $dynamic_ids = DB::table('images')
            ->join('projects', 'images.project_id', '=', 'projects.id')
            ->select('projects.user_id', 'projects.cat_id')
            ->where('images.filename', $fileName)
            ->get();
        $user = $dynamic_ids[0]->user_id;
        $cat = $dynamic_ids[0]->cat_id;
        $thumb_filePath = 'images/'.$user.'/'.$cat.'/thumbnail/';
        File::delete($thumb_filePath.$fileName);
        $wide_filePath = 'images/'.$user.'/'.$cat.'/';
        File::delete($wide_filePath.$fileName);

        DB::table('Images')->where('filename', '=', $fileName)->delete();

      }

      DB::table('images')
            ->where('filename', $fileName)
            ->update(['state' => 1]);
      return $fileName;
    }

    public function myform() {

      $user = Auth::user();
      $cats = DB::table('cats')->orderBy('name', 'asc')->get();

      return view('project-insert', get_defined_vars());

    }


    public function filter(Request $request)
    {
      $cat_id = $request->input("cat_id");
    //  return $cat_id;


    //  $code = DB::table('cats')->where('id', $cat_id)->first();
      $query = DB::table('cats')->where('id', '=', $cat_id);

      var_dump($code->code);

    //  return view('project-insert', get_defined_vars());
    }

    public function ProjectShow () {

      $user = Auth::user();


      $projects = Project::with(['images' => function($query){
        $query->where('state' , 0 );
      }])
      ->where('stat', '!=', '1')
      ->whereHas('user', function ($query) use ($user) {
                        $query->where('id', '=', $user->id);

                    })->get();



    return view('project-show', compact('projects', 'user','cat'));

    }




    public function ProjectBewerten(Request $request) {

      $user = Auth::user();

      $pids = Count::pluck('project_id');
      $uids = Count::pluck('user_id');



                        

      $projects = Project::whereNotIn('id', $pids)
                        ->whereNotIn('user_id', $uids)
                        ->where('stat', '=', '2')
                        ->with('images')
                        ->paginate(5);


      if($request->ajax()) {

          $count = Project::whereNotIn('id', $pids)
                        ->whereNotIn('user_id', $uids)
                        ->where('stat', '=', '2')
                        ->with('images')
                        ->count();
          if ( ceil($count/5) == $request->input("page")) {
            $do_work = 0;
          }else{
            $do_work = 1;
          }

        
          return [
              'projects' => view('ajax-load')->with(compact('projects', 'user','cat','do_work'))->render(),
              'next_page' => $projects->nextPageUrl()
          ];
      }else{
        $count = Project::whereNotIn('id', $pids)
                        ->whereNotIn('user_id', $uids)
                        ->where('stat', '=', '2')
                        ->with('images')
                        ->count();
        if ( ceil($count/5) == $request->input("page")) {
          $do_work = 0;
        }else{
          $do_work = 1;
        }
      }

      return view('project-show-rater', compact('projects', 'user','cat', 'do_work'));

    }

    public function ProjectRated(Request $request) {

      $user = Auth::user();

      DB::table('Counts')->insert([
          'project_id' => $request['project_id'],
          'user_id' => $user->id,
          'counts' => $request->counts,
          'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
          'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
      ]);

      $pids = Count::pluck('project_id');
      $uids = Count::pluck('user_id');

      $projects = Project::whereNotIn('id', $pids)
          ->whereNotIn('user_id', $uids)
          ->where('stat', '=', '2')
          ->with('images')
          ->get();


      return view('project-show-rater', compact('projects', 'user','cat'));



    }

    public function ProjectFreigeben(Request $request) {

      $user = Auth::user();

      $projects = Project::where('stat', '=', '0')
                        ->with('images')
                        ->paginate(5);


      if($request->ajax()) {

          $count = Project::where('stat', '=', '0')
                          ->with('images')
                          ->count();
          if ( ceil($count/5) == $request->input("page")) {
            $do_work = 0;
          }else{
            $do_work = 1;
          }

          return [
              'projects' => view('ajax-load-admin')->with(compact('projects', 'user','cat', 'do_work'))->render(),
              'next_page' => $projects->nextPageUrl()
          ];
      }else{
          $count = Project::where('stat', '=', '0')
                          ->with('images')
                          ->count();
          if ( ceil($count/5) == $request->input("page")) {
            $do_work = 0;
          }else{
            $do_work = 1;
          }
      }

      return view('project-show-admin', compact('projects', 'user','cat', 'do_work'));

    }

    public function ProjectFreigegeben(Request $request) {

      $user = Auth::user();


      $projects = Project::where('stat', '=', '0')
                        ->with('images')
                        ->paginate(5);


      return view('project-show-admin', compact('projects', 'user','cat'));

    }

    public function EmailSenden(Request $request) {

      $userId = $request->input("user_id");
      $projectId = $request->input("project_id");

      $user = DB::table('users')->where('id', $userId)->first();
      $project = DB::table('projects')->where('id', $projectId)->first();

      return view('email-senden', compact('project', 'user'));


    }


}
