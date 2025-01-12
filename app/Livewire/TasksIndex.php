<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Assignment;
use Carbon\Carbon;

class TasksIndex extends Component
{
    public $assignments = [];
    public $dateRange = 7;
    public $dates = [];

    public function mount()
    {
        $this->dates = [
            ['value' => 1, 'label' => 'Next 1 day'],
            ['value' => 3, 'label' => 'Next 3 days'],
            ['value' => 5, 'label' => 'Next 5 days'],
            ['value' => 7, 'label' => 'Next week'],
            ['value' => 14, 'label' => 'Next two weeks'],
            ['value' => 30, 'label' => 'Next month'],
        ];

        $this->filterAssignments();
    }

    public function updatedDateRange($value)
    {
        $this->filterAssignments();
    }

    public function filterAssignments()
    {
        $today = Carbon::today();

        $endDate = match ((int)$this->dateRange) {
            1 => $today->copy()->addDay(),
            3 => $today->copy()->addDays(3),
            5 => $today->copy()->addDays(5),
            7 => $today->copy()->addWeek(),
            14 => $today->copy()->addWeeks(2),
            30 => $today->copy()->addMonth(),
            default => $today->copy()->addWeek(),
        };

        $this->assignments = Assignment::query()
            ->whereDate('due_date', '>=', $today->toDateString())
            ->whereDate('due_date', '<=', $endDate->toDateString())
            ->with(['module.course'])
            ->orderBy('due_date', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.tasks-index');
    }
}