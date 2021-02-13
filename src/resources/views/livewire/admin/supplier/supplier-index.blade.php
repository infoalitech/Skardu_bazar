<div>

	<x-flash-message />
	<div class="row">
		<div class="col-sm-4 pl-4">
		   <h3>Supplier</h3>
		</div>
		<div class="col-sm-8 text-right pr-5">
			<input type="text" name="" wire:model="q" placeholder="Search">
			<button class="btn btn-primary" wire:click="create()">Add Supplier</button>
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
   				<button wire:click="sortBy('address')">Adress</button>
   				<x-sort-icon sortfield="type" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>
   				<button wire:click="sortBy('email')">Email</button>
   				<x-sort-icon sortfield="email" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>Action</td>
   		</tr>
   	</thead>
   	<tbody>
   		@foreach($objects as $supplierr)
   		<tr>
   			<td>{{$supplierr->id}}</td>
   			<td>{{$supplierr->name}}</td>
   			<td>{{$supplierr->address}}</td>
   			<td>{{$supplierr->user_id}}</td>
   			<td>
				<button class="btn btn-primary" wire:click="show({{$supplierr->id}})">Detail</button>
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
		    {{ __('Delete Supplier') }}
		</x-slot>
		<x-slot name="content">
		    {{ __('Are you sure you want to delete the supplier? Once your account is deleted, all of its resources and data will be permanently deleted.') }}
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
		    {{ __('New Supplier') }}
		</x-slot>
		<x-slot name="content">
			@include('livewire.admin.supplier.form')
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
		    {{ __('Edit Supplier') }}
		</x-slot>
		<x-slot name="content">
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
			    <x-jet-label for="password" value="{{ __('Password') }}" />
			    <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="password"/>
			    <x-jet-input-error for="password" class="mt-2" />
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
					<th>Email</th>
					<td>@if(@isset($object->user->email)){{$object->user->email}}@endif</td>
				</tr>
				<tr>
					<th>Address</th>
					<td>@if(@isset($object->address)){{$object->address}}@endif</td>
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