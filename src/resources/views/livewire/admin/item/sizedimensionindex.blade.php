<div>

	<x-flash-message />
	<div class="row">
		<div class="col-sm-4 pl-4">
		   <h3>Size Dimension</h3>
		</div>
		<div class="col-sm-8 text-right pr-5">
			<input object="text" name="" wire:model="q" placeholder="Search">
			<button class="btn btn-primary" wire:click="create()">Add Size</button>
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
   				<button wire:click="sortBy('size_id')">Size</button>
   				<x-sort-icon sortfield="name" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>Action</td>
   		</tr>
   	</thead>
   	<tbody>
   		@foreach($objects as $objectt)
   		<tr>
   			<td>{{$objectt->id}}</td>
   			<td>{{$objectt->name}}</td>
   			<td>{{$objectt->size_id}}</td>
   			<td>
				<button class="btn btn-primary" wire:click="show({{$objectt->id}})">Detail</button>
   			</td>
   		</tr>
   		@endforeach
   	</tbody>
   </table>

   <!-- Pagination Links -->
   <div class="px-5 py-2">
	   	{{$objects->links()}}
   </div>
<!-- Delete Model -->
	<x-jet-confirmation-modal wire:model="confirmingDeletion">
		<x-slot name="title">
		    {{ __('Delete Size') }}
		</x-slot>
		<x-slot name="content">
		    {{ __('Are you sure you want to delete the Size? Once your account is deleted, all of its resources and data will be permanently deleted.') }}
		</x-slot>
		<x-slot name="footer">
		    <x-jet-secondary-button wire:click="$set('confirmingDeletion',false )" wire:loading.attr="disabled">{{ __('Nevermind') }}</x-jet-secondary-button>
		    <x-jet-danger-button class="ml-2" wire:click="destory({{$confirmingDeletion}})" wire:loading.attr="disabled">
		        {{ __('Delete') }}
		    </x-jet-danger-button>
		</x-slot>
	</x-jet-confirmation-modal>



<!-- Add Model -->
	<x-jet-dialog-modal wire:model="addmodal">
		<x-slot name="title">
		    {{ __('New Size') }}
		</x-slot>
		<x-slot name="content">
			<div>
			    <x-jet-label for="name" value="{{ __('Name') }}" />
			    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="object.name" autocomplete="object.name" />
			    <x-jet-input-error for="object.name" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="size_id" value="{{ __('Size') }}" />
			    <select id="size_id"  name="size_id" class="mt-1 block w-full" wire:model.defer="object.size_id" autocomplete="object.size_id" >
			    	<option  selected="">Select Size</option>
			    	@foreach($sizes as $obj)
			    		<option value="{{$obj->id}}">{{$obj->name}}</option>
			    	@endforeach
			    </select>    
			    <x-jet-input-error for="object.rank" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="parent_id" value="{{ __('Parent') }}" />
			    <select id="parent_id"  name="parent_id" class="mt-1 block w-full" wire:model.defer="object.parent_id" autocomplete="object.parent_id" >
			    	<option  selected="">Select Parent</option>
			    	@foreach($parents as $obj)
			    		<option value="{{$obj->id}}">{{$obj->name}}</option>
			    	@endforeach
			    </select>    
			    <x-jet-input-error for="object.parent_id" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="parent_value" value="{{ __('Parent Value') }}" />
			    <x-jet-input id="parent_value" type="text" class="mt-1 block w-full" wire:model.defer="object.parent_value" autocomplete="object.parent_value" />
			    <x-jet-input-error for="object.parent_value" class="mt-2" />
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
		    {{ __('Edit Size') }}
		</x-slot>
		<x-slot name="content">
			<div>
			    <x-jet-label for="name" value="{{ __('Name') }}" />
			    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="object.name" autocomplete="object.name" />
			    <x-jet-input-error for="object.name" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="size_id" value="{{ __('Size') }}" />
			    <select id="size_id"  name="size_id" class="mt-1 block w-full" wire:model.defer="object.size_id" autocomplete="object.size_id" >
			    	<option  selected="">Select Size</option>
			    	@foreach($sizes as $obj)
			    		<option value="{{$obj->id}}">{{$obj->name}}</option>
			    	@endforeach
			    </select>    
			    <x-jet-input-error for="object.rank" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="parent_id" value="{{ __('Parent') }}" />
			    <select id="parent_id"  name="parent_id" class="mt-1 block w-full" wire:model.defer="object.parent_id" autocomplete="object.parent_id" >
			    	<option  selected="">Select Parent</option>
			    	@foreach($parents as $obj)
			    		<option value="{{$obj->id}}">{{$obj->name}}</option>
			    	@endforeach
			    </select>    
			    <x-jet-input-error for="object.parent_id" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="parent_value" value="{{ __('Parent Value') }}" />
			    <x-jet-input id="parent_value" type="text" class="mt-1 block w-full" wire:model.defer="object.parent_value" autocomplete="object.parent_value" />
			    <x-jet-input-error for="object.parent_value" class="mt-2" />
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
					<td>@if(@isset($object->name)){{$object->name}}@endif</td>
				</tr>
				<tr>
					<th>Size</th>
					<td>@if(@isset($object->size_id)){{$object->size_id}}@endif</td>
				</tr>
				<tr>
					<th>Parent </th>
					<td>@if(@isset($object->parent_id)){{$object->parent_id}}@endif</td>
				</tr>
				<tr>
					<th>Value</th>
					<td>@if(@isset($object->parent_value)){{$object->parent_value}}@endif</td>
				</tr>
				<tr>
					<th>Default</th>
					<td>@if(@isset($object->default)){{$object->default}}@endif</td>
				</tr>
			</table>
		</x-slot>
		<x-slot name="footer">
		@if(@isset($object->id))
			<button class="btn btn-primary" wire:click="edit({{$object->id}})">Edit</button>

            <x-jet-danger-button wire:click="confirmdelete({{$object->id}})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>

		    <x-jet-secondary-button wire:click="$set('detailmodal',false )" wire:loading.attr="disabled">{{ __('Close') }}</x-jet-secondary-button>
		@endif
		</x-slot>
	</x-jet-dialog-modal>
</div>
