<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    use HasFactory;

    //关联pet
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

}
