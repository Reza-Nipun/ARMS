<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
