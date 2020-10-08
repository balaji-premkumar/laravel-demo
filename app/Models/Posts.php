<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = "posts";
    use HasFactory;

    protected $fillable = ['title','description','status','deleted'];
    protected $hidden = ['deleted','status'];
}
