<?php

namespace App\Rules;

use App\Models\Equipment;
use Closure;
use App\Models\Branch;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class UniqueNameEquipment implements DataAwareRule,ValidationRule
{
    protected array $data = [];
    protected int|null $id;
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    /**
     * .
     *
     * @param int|null $id
     */
    public function __construct(int $id = null)
    {
        $this->id = $id;
        return $this;
    }

    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $id = $this->id;
        if (Equipment::query()
            ->when($id, function (Builder $query, int $id) {
                return $query->whereNot('id', $id);
            })
            ->whereTitle($this->data['title'])
            ->whereClassificationId($this->data['classification_id'])
            ->whereWearPeriod($this->data['wear_period'])
            ->exists()) {
            $fail('СИЗ с таким именем существует в базе данных');
        }
    }
}
