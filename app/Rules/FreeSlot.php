<?php

namespace App\Rules;

use App\Models\Appointment;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use RRule\RRule;


class FreeSlot implements DataAwareRule, ValidationRule
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
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->isFreeAmongOnetime() || !$this->isFreeAmongRecurring()){
            $fail('Az időpont már foglalt!');
        }
    }

    /**
     * Check if selected timeslot doesn't overlap any onetime appointment
     */
    private function isFreeAmongOnetime(): bool
    {
        $selectedStart = Carbon::parse($this->data['start']);
        $selectedEnd = Carbon::parse($this->data['end']);
        $bookedOneTimeAppointments = Appointment::whereNotNull('start')->pluck('start', 'end');
        foreach ($bookedOneTimeAppointments as $end=>$start) {
            // If A event is later: StartA > EndB
            // If B event is later: StartB > EndA
            // De Morgan's law: Not (A Or B) <=> Not A And Not B
            // Which translates to: (StartA <= EndB) and (StartB <= EndA)
            if (($selectedStart <= $end) && ($start <= $selectedEnd)){
                return false;
            }
        }
        return true;
    }

    /**
     * Check if selected timeslot doesn't overlap any recurring appointment
     */
    private function isFreeAmongRecurring(): bool
    {
        $selectedStart = Carbon::parse($this->data['start']);
        $selectedEnd = Carbon::parse($this->data['end']);
        $bookedRecurringAppointments = Appointment::whereNotNull('rrule')->pluck('rrule', 'duration');
        foreach ($bookedRecurringAppointments as $duration=>$rrule) {
            $rruleAll = $this->generateCompleteRrule($rrule, $duration);
            $rruleToCheck = new RRule($rruleAll);
            $occurrences = $rruleToCheck->getOccurrencesBetween($selectedStart, $selectedEnd);
            if (count($occurrences)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Generate rrule with byhours value based on start hour and duration
     */
    private function generateCompleteRrule(string $rrule, string $duration): string
    {
        $rruleArray = explode('=', $rrule);
        $byHourValue = (int)end($rruleArray);
        $durationHourValue = (int)substr($duration, 0, 2);
        $byHours = implode(',', range($byHourValue+1,$byHourValue+$durationHourValue));
        return $rrule.','.$byHours;
    }
}
