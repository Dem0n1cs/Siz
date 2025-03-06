<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function scopeApplyRoleBasedFilters(Builder $query, $user)
    {
        return $query
            // Для начальника межрайонного отделения: фильтр по departments
            ->when($user->hasRole('Начальник межрайонного отделения'), function ($query) use ($user) {
                $query->whereHas('departments', function ($q) use ($user) {
                    $q->where('id', $user->department_id);
                });
            })
            // Для начальника районной энергогазинспекции: фильтр по divisions
            ->when($user->hasRole('Начальник районной энергогазинспекции'), function ($query) use ($user) {
                $query->whereHas('departments.divisions', function ($q) use ($user) {
                    $q->where('id', $user->division_id);
                });
            })
            // Администраторы и другие разрешенные роли не фильтруются
            ->when($user->hasRole(['Администратор', 'Экономист МТС']), function ($query) {
                return $query;
            });
    }

    public function departments(): HasMany
    {
        return $this->HasMany(Department::class);
    }
}
