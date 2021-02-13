<div>

	<x-flash-message />
	<div class="row">
		<div class="col-sm-4 pl-4">
		   <h3>Sub Category</h3>
		</div>
		<div class="col-sm-8 text-right pr-5">
			<input object="text" name="" wire:model="q" placeholder="Search">
			<button class="btn btn-primary" wire:click="create()">Add Sub Category</button>
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
   				<button wire:click="sortBy('category')">Category</button>
   				<x-sort-icon sortfield="category" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>Action</td>
   		</tr>
   	</thead>
   	<tbody>
   		@foreach($objects as $objectt)
   		<tr>
   			<td>{{$objectt->id}}</td>
   			<td>{{$objectt->name}}</td>
   			<td>{{$objectt->category}}</td>
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
		    {{ __('Delete Sub Category') }}
		</x-slot>
		<x-slot name="content">
		    {{ __('Are you sure you want to delete the sub category? Once your account is deleted, all of its resources and data will be permanently deleted.') }}
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
		    {{ __('New Sub Category') }}
		</x-slot>
		<x-slot name="content">
			<div>
			    <x-jet-label for="name" value="{{ __('Name') }}" />
			    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="object.name" autocomplete="object.name" />
			    <x-jet-input-error for="object.name" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="type" value="{{ __('object Rank') }}" />
			    <select id="rank"  name="category" class="mt-1 block w-full" wire:model.defer="object.category" autocomplete="object.category" >
			    	<option  selected="">Select Rank</option>
			    	@foreach($categories as $category)
			    		<option value="{{$category->id}}">{{$category->name}}</option>
			    	@endforeach
			    </select>    
			    <x-jet-input-error for="object.rank" class="mt-2" />
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
		    {{ __('Edit object') }}
		</x-slot>
		<x-slot name="content">
			<div>
			    <x-jet-label for="name" value="{{ __('Name') }}" />
			    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="object.name" autocomplete="object.name" />
			    <x-jet-input-error for="object.name" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="type" value="{{ __('object Rank') }}" />
			    <select id="rank"  name="category" class="mt-1 block w-full" wire:model.defer="object.category" autocomplete="object.category" >
			    	<option  selected="">Select Rank</option>
			    	@foreach($categories as $category)
			    		<option value="{{$category->id}}">{{$category->name}}</option>
			    	@endforeach
			    </select>    
			    <x-jet-input-error for="object.rank" class="mt-2" />
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
					<th>Category</th>
					<td>@if(@isset($object->category)){{$object->category}}@endif</td>
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