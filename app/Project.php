<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
        'project_id', 'partner_id',
        'lead_id', 'start_date', 'end_date'
    ];
}
