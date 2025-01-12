<div class="p-6 space-y-6 pb-20">
    <x-card title="{{ $name }}" subtitle="{{ $email }}" shadow separator>
        <x-slot:figure>
            @if ($avatar)
            <img src="{{ Storage::url($avatar) }}" alt="Profile Avatar" class="w-full h-48 object-cover" />
            @else
            <img src="https://picsum.photos/500/200" alt="Default Avatar" />
            @endif
        </x-slot:figure>
        {{$bio}}
    </x-card>

    <div class="p-6 shadow-md rounded-lg">
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        <form wire:submit.prevent="updateProfile">
            <div class="mb-4">
                <x-input label="Name" wire:model="name" placeholder="Your name" icon="o-user" />
                @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-input label="Email" type="email" wire:model="email" placeholder="Your email" />
                @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-input label="New Password" type="password" wire:model="password" placeholder="Leave blank to keep current password" />
                @error('password') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-input label="Bio" wire:model="bio" placeholder="Leave blank to keep current bio" />
                @error('bio') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Profile Picture</label>



                <x-input type="file" label="Avatar" wire:model="newAvatar" accept="image/jpeg,image/png,image/gif" />


                @error('newAvatar')
                <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-full">Update Profile</button>
        </form>

        <a href="/logout" class="btn btn-primary w-full mt-4">Log Out</a>
    </div>
</div>