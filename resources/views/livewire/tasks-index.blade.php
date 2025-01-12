<div>
    <div class="container pb-20">
        <x-header title="Your assignments" size="text-xl" />
        <x-button class="btn-primary" label="See Calendar" link="/calendar" />


        <div class="mb-4">
            <x-select
                :options="$dates"
                option-value="value"
                option-label="label"
                wire:model.live="dateRange"
                id="dateRange" />
        </div>
        @if($assignments->isEmpty())
        <p>You have no assignments assigned.</p>
        @else
        <div class="grid grid-cols-3 gap-8">
            @foreach($assignments as $assignment)
            <a href="{{ route('assignment.show', ['assignmentId' => $assignment->id]) }}">
                <div>
                    <x-card title="{{ $assignment->title }}" subtitle="{{ $assignment->description }}" separator>
                        <p>Due by {{ $assignment->due_date->format('M d, Y') }}</p>
                    </x-card>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</div>