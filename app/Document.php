<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    // Table Name
    protected $table = 'documents';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
