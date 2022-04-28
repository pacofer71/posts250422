<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['titulo', 'contenido', 'status', 'img', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function titulo(): Attribute{
        return Attribute::make(
            get : fn($v) => ucfirst($v),
            set: fn($v) =>ucfirst($v)
        );
    }
    public function contenido(): Attribute{
        return Attribute::make(
            get : fn($v) => ucfirst($v),
            set: fn($v) =>ucfirst($v)
        );
    }
}
