<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    //
    protected $fillable = [
        'lead_id',
        'name', 'email', 'url', 'city',
        'country', 'worldwide', 'language', 'translation',
        'initial_requirement', 'note_to_partner', 'partner_search_keywords',
        'c2c', 'tags', 'description', 'requirement'
    ];
}
