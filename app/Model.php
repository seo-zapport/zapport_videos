<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $guarded = [
    	'id',
    	'user_id',
    	'role_id',
    ];
}
