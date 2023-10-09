<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_id',
        'title'
    ];
    protected $casts = [
        'id'=>'integer',
        'branch_id'=>'integer',
        'title'=>'string'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function divisions()
    {
        return $this->HasMany(Division::class);
    }
}
