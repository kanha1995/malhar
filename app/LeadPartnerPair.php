<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadPartnerPair extends Model
{
    //
    protected $fillable = [
        'lead_id', 'partner_id'
    ];
}
