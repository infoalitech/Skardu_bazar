<div>

	<x-flash-message />
	<div class="row">
		<div class="col-md-4 pl-4">
		   <h3>Groups</h3>
		   <input type="number" name="" min="1" max="100"  wire:model="page" >
		</div>
		<div class="col-md-8 text-right pr-5">
			<input type="text" name="" wire:model="q" placeholder="search">
			<button class="btn btn-primary" wire:click="create()">Add Group</button>
		</div>
	</div>

   <table class="table">
   	<thead>
   		<tr>
   			<td>
   				<button wire:click="sortBy('id')">Id</button>
   				<x-sort-icon sortfield="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>
   				<button wire:click="sortBy('name')">Name</button>
   				<x-sort-icon sortfield="name" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>
   				<button wire:click="sortBy('description')">Description</button>
   				<x-sort-icon sortfield="description" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>Action</td>
   		</tr>
   	</thead>
   	<tbody>
   		@foreach($groups as $group)
   		<tr>
   			<td>{{$group->id}}</td>
   			<td>{{$group->name}}</td>
   			<td>{{$group->description}}</td>
   			<td>
				<button class="btn btn-primary" wire:click="show({{$group->id}})">Detail</button>
   			</td>
   		</tr>
   		@endforeach
   	</tbody>
   </table>

   <!-- Pagination Links -->
   <div class="px-5 py-2">
	   	{{$groups->links()}}
   </div>


<!-- Delete Model -->
	<x-jet-confirmation-modal wire:model="confirmingDeletion">
		<x-slot name="title">
		    {{ __('Delete Group') }}
		</x-slot>
		<x-slot name="content">
		    {{ __('Are you sure you want to delete the group? Once your account is deleted, all of its resources and data will be permanently deleted.') }}
		</x-slot>
		<x-slot name="footer">
		    <x-jet-secondary-button wire:click="$set('confirmingDeletion',false )" wire:loading.attr="disabled">{{ __('Nevermind') }}</x-jet-secondary-button>
		    <x-jet-danger-button class="ml-2" wire:click="destory({{$confirmingDeletion}})" wire:loading.attr="disabled">
		        {{ __('Delete group') }}
		    </x-jet-danger-button>
		</x-slot>
	</x-jet-confirmation-modal>



<!-- Add Model -->
	<x-jet-dialog-modal wire:model="addmodal">
		<x-slot name="title">
		    {{ __('New Group') }}
		</x-slot>
		<x-slot name="content">
			<div>
	            <x-jet-label for="name" value="{{ __('Name') }}" />
	            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="group.name" autocomplete="group.name" />
	            <x-jet-input-error for="group.name" class="mt-2" />
			</div>
			<div>
	            <x-jet-label for="description" value="{{ __('Description') }}" />
	            <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="group.description" autocomplete="group.description" />
	            <x-jet-input-error for="group.description" class="mt-2" />
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

		</x-slot>



		<x-slot name="footer">
		    <x-jet-secondary-button wire:click="$set('addmodal',false )" wire:loading.attr="disabled">{{ __('Cancel') }}</x-jet-secondary-button>
		    <x-jet-danger-button class="ml-2" wire:click="store()" wire:loading.attr="disabled">
		        {{ __('Save') }}
		    </x-jet-danger-button>
		</x-slot>
	</x-jet-dialog-modal>


<!-- Edit Model -->
	<x-jet-dialog-modal wire:model="editmodal">
		<x-slot name="title">
		    {{ __('Edit Group') }}
		</x-slot>
		<x-slot name="content">
			<div>
	            <x-jet-label for="name" value="{{ __('Name') }}" />
	            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="group.name" autocomplete="group.name" />
	            <x-jet-input-error for="group.name" class="mt-2" />
			</div>
			<div>
	            <x-jet-label for="description" value="{{ __('Description') }}" />
	            <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="group.description" autocomplete="group.description" />
	            <x-jet-input-error for="group.description" class="mt-2" />
			</div>
			<div>
	            <x-jet-label for="permissions" value="{{ __('Description') }}" />
	            <select id="permissions" name="selected_permissions" multiple="" wire:model.defer="selected_permissions" class="form-control">
	            	<option value="0">None</option>
	            	@foreach($permissions as $permission)
	            		<option value="{{$permission->id}}"> {{$permission->name}}</option>
	            	@endforeach	
	            </select>
	            <x-jet-input-error for="group.permissions" class="mt-2" />
			</div>
		</x-slot>
		<x-slot name="footer">
		    <x-jet-secondary-button wire:click="$set('editmodal',false )" wire:loading.attr="disabled">{{ __('Cancel') }}</x-jet-secondary-button>
		    <x-jet-danger-button class="ml-2" wire:click="store()" wire:loading.attr="disabled">
		        {{ __('Update') }}
		    </x-jet-danger-button>
		</x-slot>
	</x-jet-dialog-modal>

<!-- Detail Model -->
	<x-jet-dialog-modal wire:model="detailmodal">
		<x-slot name="title">
		    {{ __('Detail') }}
		</x-slot>
		<x-slot name="content">
			<table class="table">
				<tr>
					<th>Name</th>
					<td>@if(@isset($group->name)){{$group->name}}@endif</td>
				</tr>
				<tr>
					<th>Description</th>
					<td>@if(@isset($group->description)){{$group->description}}@endif</td>
				</tr>
				<tr>
					<th>Permissions</th>
					<td>@if(@isset($group->permissions))
						<table class="table p-0">
							@foreach($group->permissions as $perm)
							<tr><td>{{$perm->name}}</td></tr>
							@endforeach
						</table>
					@endif</td>
				</tr>
			</table>
		</x-slot>
		<x-slot name="footer">
		@if(@isset($group->id))
			<button class="btn btn-primary" wire:click="edit({{$group->id}})">Edit</button>

            <x-jet-danger-button wire:click="confirmdelete({{$group->id}})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>

		    <x-jet-secondary-button wire:click="$set('detailmodal',false )" wire:loading.attr="disabled">{{ __('Close') }}</x-jet-secondary-button>
		@endif
		</x-slot>
	</x-jet-dialog-modal>
</div>