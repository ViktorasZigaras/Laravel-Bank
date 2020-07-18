<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = array('uuid', 'account', 'personal_code', 'name', 'surname', 'value');
}
