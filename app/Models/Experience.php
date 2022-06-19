<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $table = 'experience';
    protected $primaryKey = 'expid';

    public function user() {
        return $this->belongsTo(User::class, 'userid');
    }
}
