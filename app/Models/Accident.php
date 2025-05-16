<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accident extends Model
{
    use HasFactory;

    // 关联pet表
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    // 关联admin表
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
