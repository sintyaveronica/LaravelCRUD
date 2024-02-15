<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function kategori_level(){
        return $this->belongsTo('App\Models\Kategori');
    }

    protected $fillable = [
        'image',
        'title',
        'id_kategori',
        'content',
    ];
}
