<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    //

    public $table = 'library';

    protected $fillable  =  ['nombre', 'precio'];
}
