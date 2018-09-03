<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class InvoiceRow extends Model
{
    use LogsActivity;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoice_rows';

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
    protected $fillable = ['project_id', 'name', 'group'];
    protected static $logAttributes = ['project_id', 'name', 'group'];

    
}
