<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $table = 'designations';
    protected $fillable = [
        'designation',
    ];

    public function designation() {
        return $this->hasOne(Designation::class);
    }
}
