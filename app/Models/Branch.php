<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'title'
    ];
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
    ];

    public function departments()
    {
        return $this->HasMany(Department::class);
    }
}
