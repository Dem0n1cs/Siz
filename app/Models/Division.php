<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected function fullNameWork(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->department->branch->title.'/'.$this->department->title.'/'.$this->short_title
        );
    }

    public function department()
    {
        return $this->belongsTo(Department::class)->select('id','title','branch_id');
    }

    public function user()
    {
        return $this->HasMany(User::class);
    }
}
