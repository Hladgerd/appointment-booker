<?php

namespace App\Rules;

use App\Models\BusinessTime;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class WithinBusinessTime implements DataAwareRule, ValidationRule
{

    /**
     * All the data under validation.
     *
     * @var array<string, mixed>
     */
    protected array $data = [];


    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->isBusinessHour()){
            $fail('A foglalás nyitvatartási időn kívül esik!');
        }
    }

    /**
     * Check if selected day is business day.
     */
    private function isBusinessDay(): bool
    {
        $dayOfWeek = $this->data['dayOfWeek'];
        $businessDays = BusinessTime::all()->pluck('by_day')[0];
        return in_array($dayOfWeek, $businessDays);
    }

    /**
     * Check if selected hours are business hours.
     */
    private function isBusinessHour(): bool
    {
        $startHour = $this->data['startHour'];
        $endHour = $this->data['endHour'];
        $endMinutes = $this->data['endMinutes'];
        $businessStart = BusinessTime::all()->pluck('by_hour')[0];
        $duration = (int)substr(BusinessTime::all()->pluck('duration')[0], 0, 2);
        $businessEnd = $businessStart + $duration;

        return (($startHour >= $businessStart) && ($startHour < $businessEnd)) &&
            (($endHour > $businessStart) && ($endMinutes > 0 ? $endHour < $businessEnd : $endHour <= $businessEnd));
    }
}
