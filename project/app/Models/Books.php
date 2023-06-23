<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class Books extends Model
{
    use HasTimestamps, SoftDeletes;

    protected $table = "tb_books";
    protected $primaryKey = "id";
    protected $fillable = [
        'title',
        'author',
        'description',
        'price',
        'genre',
    ];

    protected $dates = ['deleted_at']; //implement softdelete
}
