<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncidentManagement extends Model
{
    const CREATED_AT = 'createDate';
    const UPDATED_AT = 'modifyDate';

    protected $table = 'incident_management';

    protected $fillable = [
        'latitude',
        'longitude',
        'title',
        'category',
        'people',
        'comments'
    ];

    protected $dates = [
        'createDate',
        'modifyDate',
        'incidentDate'
    ];

    protected $casts = [
        'people'     => 'json',
    ];

}
