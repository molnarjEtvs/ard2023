<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tavolsag extends Model
{
    use HasFactory;
    public $table = "tavolsagok";
    public $primaryKey = "uh_id";
    public $timestamps = false;
    public $guarded = [];
}
