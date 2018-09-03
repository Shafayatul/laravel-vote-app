<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Project extends Model
{
  use LogsActivity;

  protected $table = 'projects';
  protected $primaryKey = 'id';

  protected $fillable = ['name','user_id','cat_id', 'beschreibung', 'youtube', 'copyright','testimonial','check','projektname'];

  protected static $logAttributes = ['name','user_id','cat_id', 'beschreibung', 'youtube', 'copyright','testimonial','check','projektname'];

  /*
  public function user() {
        return $this->belongsTo('App\User');
        return $this->hasOne('App\User');
  }
  */
  /*public function cat() {
        return $this->belongsTo('App\Cat');
        return $this->hasOne('App\Cat');
  }
*/
  public function image() {
        return $this->belongsTo('App\Image');
        return $this->hasMany('App\Image');
  }

  public function count() {

    return $this->hasOne('App\Count');
  }

  public function images()
    {
        return $this->hasMany(\App\Image::class, 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function cat()
      {
          return $this->belongsTo(\App\Cat::class, 'cat_id');
      }
}
