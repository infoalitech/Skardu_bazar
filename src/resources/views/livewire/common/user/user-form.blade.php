<div>
    <div class="text-center align-center row">
	    @if ($photo)
	    <div class="col-lg-4 col-md-6">
	    	<img src="{{ $photo->temporaryUrl() }}" class="img img-thumbnail align-center	" width="250px" alt="Profile Picture" style="align-self: center;">
	    </div>
	    @endif

	    @if(@isset($user->image))
	    	<img src="{{ storage_path('app/'.$user->image)  }}" class="img img-thumbnail align-center	" width="250px" alt="Profile Picture" style="align-self: center;">

	    @endif
		<x-jet-label for="name" value="{{ __('Profile Picture') }}" />
    </div>
	<x-jet-input id="file" type="file"  class="mt-1 block w-full" wire:model="photo" />
	
    @error('photo') <span class="error">{{ $message }}</span> @enderror

    <div wire:loading wire:target="photo">Uploading...</div>
</div>
<div>
	<x-jet-label for="name" value="{{ __('Name') }}" />
	<x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="user.name" autocomplete="user.name" />
	<x-jet-input-error for="user.name" class="mt-2" />
</div>
<div>
	<x-jet-label for="email" value="{{ __('Email') }}" />
	<x-jet-input id="email" type="text" class="mt-1 block w-full" wire:model.defer="user.email" autocomplete="user.email" />
	<x-jet-input-error for="user.email" class="mt-2" />
</div>
<div>
	<x-jet-label for="password" value="{{ __('Password') }}" />
	<x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="user.password"  />
	<x-jet-input-error for="user.password" class="mt-2" />
</div>


<div>
    <x-jet-label for="groups" value="{{ __('Groups') }}" />
    <select id="groups" name="selected_groups" multiple="" wire:model.defer="selected_groups">
    	<option value="0">None</option>
    	@foreach($groups as $group)
    		<option value="{{$group->id}}"> {{$group->name}}</option>
    	@endforeach	
    </select>
    <x-jet-input-error for="group.permissions" class="mt-2" />
</div>
<div>
    <x-jet-label for="permissions" value="{{ __('Permissions') }}" />
    <select id="permissions" name="selected_permissions" multiple="" wire:model.defer="selected_permissions">
    	<option value="0">None</option>
    	@foreach($permissions as $permission)
    		<option value="{{$permission->id}}"> {{$permission->name}}</option>
    	@endforeach	
    </select>
    <x-jet-input-error for="group.permissions" class="mt-2" />
</div>

