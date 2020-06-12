<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    //
    protected $fillable = [
        'partner_id',
        'name', 'email', 'phone', 'city',
        'country', 'type', 'linked_in', 'fb', 'fiverr', 'twitter',
        'c2c', 'team_size', 'tags'
    ];
}
