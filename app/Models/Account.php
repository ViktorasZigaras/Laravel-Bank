<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['uuid', 'account', 'personal_code', 'name', 'surname', 'value'];

    public function canDelete() {
        return $this->value === 0;
    } 

    # possible defaults
}
