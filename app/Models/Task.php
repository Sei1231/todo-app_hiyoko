<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'description', 'time', 'kind_id', 'done_at', 'user_id'];

    public function kind()

    {
        return $this->belongsTo(kind::class);
    }
}
