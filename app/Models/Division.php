<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

     protected $fillable = [
         'department_id',
         'short_title',
         'full_title'
     ];
     protected $casts = [
         'department_id' => 'integer',
         'short_title'=> 'string',
         'full_title'=> 'string',
     ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
