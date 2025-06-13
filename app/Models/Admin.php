<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'id_admin'; // karena bukan "id"

    protected $fillable = ['nama_admin', 'username', 'password'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'admin_id');
    }
}


