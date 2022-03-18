<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Food extends Model
{
    use HasFactory;

    protected $with =["owner"];

    protected $table = "foods";

    public function owner (){
        return $this->belongsTo(User::class,"user_id");
    }
}
