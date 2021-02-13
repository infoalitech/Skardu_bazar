<div>
    <x-jet-label for="name" value="{{ __('Name') }}" />
    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="customer.name" autocomplete="customer.name" />
    <x-jet-input-error for="customer.name" class="mt-2" />
</div>
<div>
    <x-jet-label for="email" value="{{ __('Email') }}" />
    <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="customer.email" autocomplete="customer.user.email" value="{{$customer}}" />
    <x-jet-input-error for="customer.email" class="mt-2" />
</div>
<div>
    <x-jet-label for="password" value="{{ __('Password') }}" />
    <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="customer.password" autocomplete="customer.password" />
    <x-jet-input-error for="customer.password" class="mt-2" />
</div>
<div>
    <x-jet-label for="type" value="{{ __('Customer Type') }}" />
    <select id="type"  name="type" class="mt-1 block w-full" wire:model.defer="customer.type" autocomplete="customer.type" >
    	<option  selected="">Select Type</option>
    	@foreach($types as $type)
    		<option value="{{$type->id}}">{{$type->name}}</option>
    	@endforeach
    </select>    
    <x-jet-input-error for="customer.type" class="mt-2" />
</div>
<div>
    <x-jet-label for="type" value="{{ __('Customer Rank') }}" />
    <select id="rank"  name="rank" class="mt-1 block w-full" wire:model.defer="customer.rank" autocomplete="customer.rank" >
    	<option  selected="">Select Rank</option>
    	@foreach($ranks as $rank)
    		<option value="{{$rank->id}}">{{$rank->name}}</option>
    	@endforeach
    </select>    
    <x-jet-input-error for="customer.rank" class="mt-2" />
</div>
