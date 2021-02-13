<div>

	<x-flash-message />
	<div class="row">
		<div class="col-sm-4 pl-4">
		   <h3>Customer</h3>
		</div>
		<div class="col-sm-8 text-right pr-5">
			<input customer="text" name="" wire:model="q" placeholder="Search">
			<button class="btn btn-primary" wire:click="create()">Add customers</button>
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
   				<button wire:click="sortBy('type')">Type</button>
   				<x-sort-icon sortfield="type" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>
   				<button wire:click="sortBy('rank')">Rank</button>
   				<x-sort-icon sortfield="rank" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>Action</td>
   		</tr>
   	</thead>
   	<tbody>
   		@foreach($customers as $customerr)
   		<tr>
   			<td>{{$customerr->id}}</td>
   			<td>{{$customerr->name}}</td>
   			<td>{{$customerr->customer_type->name}}</td>
   			<td>{{$customerr->customer_rank->name}}</td>
   			<td>
				<button class="btn btn-primary" wire:click="show({{$customerr->id}})">Detail</button>
   			</td>
   		</tr>
   		@endforeach
   	</tbody>
   </table>

   <!-- Pagination Links -->
   <div class="px-5 py-2">
	   	{{$customers->links()}}
   </div>


<!-- Delete Model -->
	<x-jet-confirmation-modal wire:model="confirmingDeletion">
		<x-slot name="title">
		    {{ __('Delete customer') }}
		</x-slot>
		<x-slot name="content">
		    {{ __('Are you sure you want to delete the customer? Once your account is deleted, all of its resources and data will be permanently deleted.') }}
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
		    {{ __('New customer') }}
		</x-slot>
		<x-slot name="content">
			@include('livewire.admin.customer.form')
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
		    {{ __('Edit customer') }}
		</x-slot>
		<x-slot name="content">
			<div>
			    <x-jet-label for="name" value="{{ __('Name') }}" />
			    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="customer.name" autocomplete="customer.name" />
			    <x-jet-input-error for="customer.name" class="mt-2" />
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
					<td>@if(@isset($customer->name)){{$customer->name}}@endif</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>@if(@isset($customer->user->email)){{$customer->user->email}}@endif</td>
				</tr>
				<tr>
					<th>Rank</th>
					<td>@if(@isset($customer->customer_rank->name)){{$customer->customer_rank->name}}@endif</td>
				</tr>
				<tr>
					<th>Type</th>
					<td>@if(@isset($customer->customer_type->name)){{$customer->customer_type->name}}@endif</td>
				</tr>
			</table>
		</x-slot>
		<x-slot name="footer">
		@if(@isset($customer->id))
			<button class="btn btn-primary" wire:click="edit({{$customer->id}})">Edit</button>

            <x-jet-danger-button wire:click="confirmdelete({{$customer->id}})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>

		    <x-jet-secondary-button wire:click="$set('detailmodal',false )" wire:loading.attr="disabled">{{ __('Close') }}</x-jet-secondary-button>
		@endif
		</x-slot>
	</x-jet-dialog-modal>
</div>