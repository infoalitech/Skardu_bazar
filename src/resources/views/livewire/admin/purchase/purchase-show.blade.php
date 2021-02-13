<div>
	<x-flash-message />
	<h3>Purchase</h3>
   	<table class="table">
   		<tr>
   			<th>Id</th>
   			<td>{{$purchase->id}}</td>
   			<th colspan="2">Supplier</th>
   			<td colspan="2">{{$purchase->supplier_id}}</td>
   			<th>Date</th>
   			<td>{{$purchase->date}}</td>
   		</tr>
   		<tr>
   			<th>Total Price</th>
   			<td>{{$purchase->total_price}}</td>
   			<th>Paid</th>
   			<td>{{$purchase->paid}}</td>
   			<th>left</th>
   			<td>{{$purchase->left}}</td>
   			<th>status</th>
   			<td>{{$purchase->status}}</td>
   		</tr>
   </table>

   <hr>
   <div class="row">
   	<div class="col-md-6"><h3>Purchase Items</h3></div>
   	<div class="col-md-6">
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
   				<button wire:click="sortBy('available_item_id')">Item</button>
   				<x-sort-icon sortfield="available_item_id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>
   				<button wire:click="sortBy('quantity')">Quantity</button>
   				<x-sort-icon sortfield="quantity" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>
   				<button wire:click="sortBy('unit_price')">Unit Price</button>
   				<x-sort-icon sortfield="unit_price" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>
   				<button wire:click="sortBy('total_price')">Total Price</button>
   				<x-sort-icon sortfield="total_price" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>
   				<button wire:click="sortBy('unit_sale_price')">Unit Sale Price</button>
   				<x-sort-icon sortfield="unit_sale_price" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>Action</td>
   		</tr>
   	</thead>

   	<tbody>
   		@foreach($purchase_items as $objectt)
   		<tr>
   			<td>{{$objectt->id}}</td>
   			<td>{{$objectt->available_item_id}}</td>
   			<td>{{$objectt->quantity}}</td>
   			<td>{{$objectt->unit_price}}</td>
   			<td>{{$objectt->total_price}}</td>
   			<td>{{$objectt->total_price}}</td>
   			<td>
				<button class="btn btn-primary" wire:click="edit({{$objectt->id}})">Edit</button>

	            <x-jet-danger-button wire:click="confirmdelete({{$objectt->id}})" wire:loading.attr="disabled">
	                {{ __('Delete') }}
	            </x-jet-danger-button>

   			</td>
   		</tr>
   		@endforeach
   	</tbody>
   </table>

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
			    <x-jet-label for="available_item_id" value="{{ __('Available Item Id') }}" />
			    <select id="available_item_id"  name="available_item_id" class="mt-1 block w-full" wire:model.defer="object.available_item_id" autocomplete="object.available_item_id" >
			    	<option  selected="">Select Item</option>
			    	@foreach($items as $obj)
			    		<option value="{{$obj->id}}">{{$obj->name}}</option>
			    	@endforeach
			    </select>    
			    <x-jet-input-error for="object.available_item_id" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="quantity" value="{{ __('Quantity') }}" />
			    <x-jet-input id="quantity" type="number" class="mt-1 block w-full" wire:model.defer="object.quantity" autocomplete="object.quantity" />
			    <x-jet-input-error for="object.quantity" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="unit_price" value="{{ __('Unit Price') }}" />
			    <x-jet-input id="unit_price" type="number" class="mt-1 block w-full" wire:model.defer="object.unit_price" autocomplete="object.unit_price" />
			    <x-jet-input-error for="object.unit_price" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="unit_sale_price" value="{{ __('Unit Sale Price') }}" />
			    <x-jet-input id="unit_sale_price" type="number" class="mt-1 block w-full" wire:model.defer="object.unit_sale_price" autocomplete="object.unit_sale_price" />
			    <x-jet-input-error for="object.unit_sale_price" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="total_price" value="{{ __('Total Price') }}" />
			    <x-jet-input id="total_price" type="number" class="mt-1 block w-full" wire:model.defer="object.total_price" autocomplete="object.total_price" />
			    <x-jet-input-error for="object.total_price" class="mt-2" />
			</div>
		</x-slot>
		<x-slot name="footer">
		    <x-jet-secondary-button wire:click="$set('addmodal',false )" wire:loading.attr="disabled">{{ __('Close') }}</x-jet-secondary-button>
		    <x-jet-secondary-button class="ml-2" wire:click="store()" wire:loading.attr="disabled">
		        {{ __('Save') }}
		    </x-jet-secondary-button>
		    <x-jet-secondary-button class="ml-2" wire:click="next()" wire:loading.attr="disabled">
		        {{ __('Next') }}
		    </x-jet-secondary-button>
		</x-slot>
	</x-jet-dialog-modal>


<!-- Edit Model -->
	<x-jet-dialog-modal wire:model="editmodal">
		<x-slot name="title">
		    {{ __('Edit object') }}
		</x-slot>
		<x-slot name="content">
<div>
			    <x-jet-label for="available_item_id" value="{{ __('Available Item Id') }}" />
			    <select id="available_item_id"  name="available_item_id" class="mt-1 block w-full" wire:model.defer="object.available_item_id" autocomplete="object.available_item_id" >
			    	<option  selected="">Select Item</option>
			    	@foreach($items as $obj)
			    		<option value="{{$obj->id}}">{{$obj->name}}</option>
			    	@endforeach
			    </select>    
			    <x-jet-input-error for="object.available_item_id" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="quantity" value="{{ __('Quantity') }}" />
			    <x-jet-input id="quantity" type="number" class="mt-1 block w-full" wire:model.defer="object.quantity" autocomplete="object.quantity" />
			    <x-jet-input-error for="object.quantity" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="unit_price" value="{{ __('Unit Price') }}" />
			    <x-jet-input id="unit_price" type="number" class="mt-1 block w-full" wire:model.defer="object.unit_price" autocomplete="object.unit_price" />
			    <x-jet-input-error for="object.unit_price" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="unit_sale_price" value="{{ __('Unit Sale Price') }}" />
			    <x-jet-input id="unit_sale_price" type="number" class="mt-1 block w-full" wire:model.defer="object.unit_sale_price" autocomplete="object.unit_sale_price" />
			    <x-jet-input-error for="object.unit_sale_price" class="mt-2" />
			</div>
			<div>
			    <x-jet-label for="total_price" value="{{ __('Total Price') }}" />
			    <x-jet-input id="total_price" type="number" class="mt-1 block w-full" wire:model.defer="object.total_price" autocomplete="object.total_price" />
			    <x-jet-input-error for="object.total_price" class="mt-2" />
			</div>
		</x-slot>
		<x-slot name="footer">
		    <x-jet-secondary-button wire:click="$set('editmodal',false )" wire:loading.attr="disabled">{{ __('Cancel') }}</x-jet-secondary-button>
		    <x-jet-danger-button class="ml-2" wire:click="store()" wire:loading.attr="disabled">
		        {{ __('Update') }}
		    </x-jet-danger-button>
		</x-slot>
	</x-jet-dialog-modal>

</div>