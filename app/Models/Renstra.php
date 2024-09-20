<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renstra extends Model
{
    use HasFactory;

    protected $table = 'renstra';

    protected $fillable = ['filename', 'version', 'uploaded_at'];

    public $timestamps = false;
}
