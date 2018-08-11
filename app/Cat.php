<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
  public function project() {

    return $this->hasMany('App\Project');
  }


}
