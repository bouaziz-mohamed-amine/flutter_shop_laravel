<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'role',
    ];


    public function users(){
       return $this->belongsToMany(User::class);
    }
}
