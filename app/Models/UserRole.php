<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Role;

class UserRole extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }
    public function role()
    {
        return $this->belongsTo("App\Models\Role");
    }
}
