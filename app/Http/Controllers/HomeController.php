<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cat;
use App\User;
use DB;

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

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      return view('home')->with(['user' => $user]);

    }

    public function change()

    {
      $user = Auth::user();
      return view('user-change')->with(['user' => $user]);

    }

    public function insert()

    {
      $user = Auth::user();
      return view('project-insert')->with(['user' => $user]);

    }

    public function show()

    {
      $user = Auth::user();
      return view('project-show')->with(['user' => $user]);
    }




}
