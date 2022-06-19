<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $primaryKey = 'reviewid';

    public function company() {
        return $this->belongsTo(Company::class, 'companyid');
    }

    public function user() {
        return $this->belongsTo(User::class, 'userid');
    }
}
