<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Invoice extends Model
{
    use LogsActivity;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoices';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'project_ids', 'date'];
    protected static $logAttributes = ['user_id', 'project_ids', 'date'];

    
}
