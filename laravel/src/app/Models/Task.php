<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * Retrieve related user
     *
     * @return User
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
