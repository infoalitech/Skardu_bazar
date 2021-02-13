<div>

	<x-flash-message />
	<div class="row">
		<div class="col-sm-4 pl-4">
		   <h3>Purchases</h3>
		</div>
		<div class="col-sm-8 text-right pr-5">
			<input object="text" name="" wire:model="q" placeholder="Search">
			<button class="btn btn-primary" wire:click="create()">Add Purchase</button>
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
   				<button wire:click="sortBy('purchase')">Supplier</button>
   				<x-sort-icon sortfield="purchase" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>
   				<button wire:click="sortBy('company')">Date</button>
   				<x-sort-icon sortfield="company" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>
   				<button wire:click="sortBy('company')">Total Price</button>
   				<x-sort-icon sortfield="company" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>
   				<button wire:click="sortBy('company')">Paid</button>
   				<x-sort-icon sortfield="company" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>
   				<button wire:click="sortBy('company')">left</button>
   				<x-sort-icon sortfield="company" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>
   				<button wire:click="sortBy('company')">status</button>
   				<x-sort-icon sortfield="company" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>Action</td>
   		</tr>
   	</thead>
   	<tbody>
   		@foreach($objects as $objectt)
   		<tr>
   			<td>{{$objectt->id}}</td>
   			<td>{{$objectt->supplier_id}}</td>
   			<td>{{$objectt->date}}</td>
   			<td>{{$objectt->total_price}}</td>
   			<td>{{$objectt->paid}}</td>
   			<td>{{$objectt->left}}</td>
   			<td>{{$objectt->status}}</td>
   			<td>
   				<a href=" {{ route('purchases.show',$objectt->id)}}" class="btn btn-primary">Detail</a>
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
		    {{ __('Delete purchase') }}
		</x-slot>
		<x-slot name="content">
		    {{ __('Are you sure you want to delete the purchase? Once your account is deleted, all of its resources and data will be permanently deleted.') }}
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
		    {{ __('New Purchase') }}
		</x-slot>
		<x-slot name="content">
			<div>
			    <x-jet-label for="supplier_id" value="{{ __('Company') }}" />
			    <select id="supplier_id"  name="supplier_id" class="mt-1 block w-full" wire:model.defer="object.supplier_id" autocomplete="object.supplier_id" >
			    		<option selected="">Select Company</option>
			    	@foreach($suppliers as $obj)
			    		<option value="{{$obj->id}}">{{$obj->name}}</option>
			    	@endforeach
			    </select>    
			    <x-jet-input-error for="object.supplier_id" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="date" value="{{ __('Date') }}" />
			    <x-jet-input id="date" type="date" class="mt-1 block w-full" wire:model.defer="object.date" autocomplete="object.date" />
			    <x-jet-input-error for="object.date" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="total_price" value="{{ __('Total Price') }}" />
			    <x-jet-input id="total_price" type="number" class="mt-1 block w-full" wire:model.defer="object.total_price" autocomplete="object.total_price" />
			    <x-jet-input-error for="object.total_price" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="paid" value="{{ __('Paid Price') }}" />
			    <x-jet-input id="paid" type="number" class="mt-1 block w-full" wire:model.defer="object.paid" autocomplete="object.paid" />
			    <x-jet-input-error for="object.paid" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="left" value="{{ __('Left Price') }}" />
			    <x-jet-input id="left" type="number" class="mt-1 block w-full" wire:model.defer="object.left" autocomplete="object.left" />
			    <x-jet-input-error for="object.left" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="status" value="{{ __('status') }}" />
			    <select id="status" class="mt-1 block w-full" wire:model.defer="object.status" autocomplete="object.status">
		    		<option selected="">Select Status</option>
			    	<option value="compelete">Compelete</option>
			    	<option value="return">Returned</option>
			    	<option value="canceled">Cacelled</option>
			    </select>
			    <x-jet-input-error for="object.status" class="mt-2" />
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
					<td>@if(@isset($object->purchase)){{$object->purchase}}@endif</td>
				</tr>
				<tr>
					<th>Company</th>
					<td>@if(@isset($object->company)){{$object->company}}@endif</td>
				</tr>
				<tr>
					<th>Sale Price</th>
					<td>@if(@isset($object->date)){{$object->date}}@endif</td>
				</tr>
				<tr>
					<th>Size</th>
					<td>@if(@isset($object->default_size)){{$object->default_size}}@endif</td>
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