<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    // Table Name
    protected $table = 'units';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
