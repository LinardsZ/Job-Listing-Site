<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $primaryKey = 'companyid';

    public function user() {
        return $this->hasOne(User::class, 'userid');
    }

    public function joboffers() {
        return $this->hasMany(JobOffer::class, 'companyid');
    }

    public function review() {
        return $this->hasMany(Review::class, 'companyid');
    }
}
