<div>
    <x-jet-label for="name" value="{{ __('Name') }}" />
    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="object.name" autocomplete="object.name" />
    <x-jet-input-error for="object.name" class="mt-2" />
</div>
<div>
    <x-jet-label for="address" value="{{ __('Address') }}" />
    <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="object.address" autocomplete="object.address" />
    <x-jet-input-error for="object.address" class="mt-2" />
</div>
<div>
    <x-jet-label for="email" value="{{ __('Email') }}" />
    <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model="email" autocomplete="email" value="{{$email}}" />
    <x-jet-input-error for="email" class="mt-2" />
</div>
<div>
    <x-jet-label for="password" value="{{ __('Password') }}" />
    <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="password" autocomplete="password" />
    <x-jet-input-error for="password" class="mt-2" />
</div>
