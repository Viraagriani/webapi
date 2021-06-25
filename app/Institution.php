<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    public $timestamps = true;
    protected  $fillable = ['name','description']; 

}
