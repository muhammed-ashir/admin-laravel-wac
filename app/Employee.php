<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'name', 'email','photo','password','address','department_id','designation_id',
    ];
    protected $hidden = [
        'password',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
