<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Count extends Model
{
  public function project()
    {
        return $this->belongsTo(\App\Project::class, 'project_id');
    }

    public function user()
      {
          return $this->belongsTo(\App\User::class, 'user_id');
      }
}
