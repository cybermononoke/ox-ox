<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Assignment;

class Calendar extends Component
{
    public function render()
    {
        $assignments = Assignment::all()->take(3)->map(function ($assignment) {
            return [
                'label' => $assignment->title,
                'description' => $assignment->description ?? 'No description available',
                'css' => '!bg-blue-200', 
                'date' => $assignment->due_date, 
            ];
        });

        $events = $assignments->toArray();
        return view('livewire.calendar', [
            'events' => $events,
        ]);
    }
}
