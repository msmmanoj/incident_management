<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncidentCategory extends Model
{
    protected $table = 'incident_category';

    protected $fillable = [
        'cat_id',
        'name',
    ];
}
