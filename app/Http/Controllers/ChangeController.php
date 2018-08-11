<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ChangeController extends Controller
{

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\User
   */
/*  protected function create(array $data)
  {
      return User::update([


      ]);

  }

  */

  public function __construct()
  {
      $this->middleware('auth');

  }

  public function change(Request $data) {

    $validatedData = $data->validate([
      'name' => 'required|string|max:255',
      'vorname' => 'required|string|max:255',
      'email' => 'required|string|email|max:255',
      'firma' => 'required|string|max:255',
      'anr' => 'required|string|max:10',
      'titel' => 'nullable|string|max:10',
      'form' => 'nullable|string|max:40',
      'adresse' => 'required|string|max:255',
      'plz' => 'required|string|max:255',
      'ort' => 'required|string|max:255',
      'bundesland' => 'required|string|max:255',
      'founded' => 'required|string|max:255',
      'url' => 'nullable|string|max:255',
      'companymail' => 'nullable|string|email|max:255',
      'atu' => 'nullable|string|max:255',
      'tel' => 'required|string|max:255',
      'fb' => 'nullable|string|max:255',
    ]);

    $id = \Auth::user()->id;
    $first = '1';

    DB::table('users')
            ->where('id', $id)
            ->update(['name' => $data['name'],
            'vorname' => $data['vorname'],
            'email' => $data['email'],
            'firma' => $data['firma'],
            'anr' => $data['anr'],
            'firma' => $data['firma'],
            'form' => $data['form'],
            'adresse' => $data['adresse'],
            'plz' => $data['plz'],
            'ort' => $data['ort'],
            'bundesland' => $data['bundesland'],
            'founded' => $data['founded'],
            'url' => $data['url'],
            'companymail' => $data['companymail'],
            'atu' => $data['atu'],
            'titel' => $data['titel'],
            'fb' => $data['fb'],
            'tel' => $data['tel'],
            'first' => $first,

          ]);




    //PUT HERE AFTER YOU SAVE
    \Session::flash('flash_message','successfully saved.');

    return redirect()->route("home");
  }






}
