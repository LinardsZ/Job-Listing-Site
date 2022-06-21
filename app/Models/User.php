<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'userid';
    public function reviews() {
        return $this->hasMany(Review::class, 'userid');
    }

    public function sentmessages() {
        return $this->hasMany(Message::class, 'senderid');
    }

    public function receivedmessages() {
        return $this->hasMany(Message::class, 'receiverid');
    }

    public function education() {
        return $this->hasMany(Education::class, 'userid');
    }

    public function experience() {
        return $this->hasMany(Experience::class, 'userid');
    }

    public function company() {
        return $this->belongsTo(Comapny::class, 'userid');
    }
}
