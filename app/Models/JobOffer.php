<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;
    protected $table = 'joboffers';
    protected $primaryKey = 'offerid';

    public function company() {
        return $this->belongsTo(Company::class, 'companyid');
    }
}
