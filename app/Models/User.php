<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
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
}
