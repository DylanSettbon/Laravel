<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class GroupUsers extends Model
{
    protected $fillable = [
        'idUser', 'idGroup'
    ];

    protected $table = 'groupUsers';

    public $timestamps = false;
}
