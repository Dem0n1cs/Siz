<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use App\Models\Ppe;

class UniqueNamePpe implements DataAwareRule,ValidationRule
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
        if (Ppe::query()
            ->when($id, function (Builder $query, int $id) {
                return $query->whereNot('id', $id);
            })
            ->whereTitle($this->data['title'])
            ->whereClassificationId($this->data['classification_id'])
            ->exists()) {
            $fail('СИЗ с таким именем существует в базе данных');
        }
    }
}
