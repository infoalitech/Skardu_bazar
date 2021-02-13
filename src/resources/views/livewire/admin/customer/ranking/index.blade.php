<div>

	<x-flash-message />
	<div class="row">
		<div class="col-sm-4 pl-4">
		   <h3>Customer Ranks</h3>
		</div>
		<div class="col-sm-8 text-right pr-5">
			<input type="text" name="" wire:model="q" placeholder="search">
			<button class="btn btn-primary" wire:click="create()">Add Rank</button>
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
   				<button wire:click="sortBy('rank')">rank</button>
   				<x-sort-icon sortfield="rank" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>Action</td>
   		</tr>
   	</thead>
   	<tbody>
   		@foreach($ranks as $rankk)
   		<tr>
   			<td>{{$rankk->id}}</td>
   			<td>{{$rankk->name}}</td>
   			<td>{{$rankk->rank}}</td>
   			<td>
				<button class="btn btn-primary" wire:click="show({{$rankk->id}})">Detail</button>
   			</td>
   		</tr>
   		@endforeach
   	</tbody>
   </table>

   <!-- Pagination Links -->
   <div class="px-5 py-2">
	   	{{$ranks->links()}}
   </div>


<!-- Delete Model -->
	<x-jet-confirmation-modal wire:model="confirmingDeletion">
		<x-slot name="title">
		    {{ __('Delete Rank') }}
		</x-slot>
		<x-slot name="content">
		    {{ __('Are you sure you want to delete the Rank? Once your account is deleted, all of its resources and data will be permanently deleted.') }}
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
		    {{ __('New Rank') }}
		</x-slot>
		<x-slot name="content">
			<div>
	            <x-jet-label for="name" value="{{ __('Name') }}" />
	            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="rank.name" autocomplete="rank.name" />
	            <x-jet-input-error for="rank.name" class="mt-2" />
			</div>
			<div>
	            <x-jet-label for="rank" value="{{ __('rank') }}" />
	            <select class="form-control" id="rank" class="mt-1 block w-full" wire:model.defer="rank.rank" autocomplete="rank.rank" >
	            	<option >Select Rank</option>
	            	<option value="One">One</option>
	            	<option value="Two">Two</option>
	            	<option value="Three">Three</option>
	            	<option value="Four">Four</option>
	            	<option value="Five">Five<option>
	            </select>
	            <x-jet-input-error for="rank.rank" class="mt-2" />
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
		    {{ __('Edit rank') }}
		</x-slot>
		<x-slot name="content">
			<div>
	            <x-jet-label for="name" value="{{ __('Name') }}" />
	            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="rank.name" autocomplete="rank.name" />
	            <x-jet-input-error for="rank.name" class="mt-2" />
			</div>
			<div>
	            <x-jet-label for="rank" value="{{ __('rank') }}" />
	            <select class="form-control" id="rank" class="mt-1 block w-full" wire:model.defer="rank.rank" autocomplete="rank.rank" >
	            	<option >Select Rank</option>
	            	<option value="One">One</option>
	            	<option value="Two">Two</option>
	            	<option value="Three">Three</option>
	            	<option value="Four">Four</option>
	            	<option value="Five">Five<option>
	            </select>
	            <x-jet-input-error for="rank.rank" class="mt-2" />
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
					<td>@if(@isset($rank->name)){{$rank->name}}@endif</td>
				</tr>
				<tr>
					<th>rank</th>
					<td>@if(@isset($rank->rank)){{$rank->rank}}@endif</td>
				</tr>
			</table>
		</x-slot>
		<x-slot name="footer">
		@if(@isset($rank->id))
			<button class="btn btn-primary" wire:click="edit({{$rank->id}})">Edit</button>

            <x-jet-danger-button wire:click="confirmdelete({{$rank->id}})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>

		    <x-jet-secondary-button wire:click="$set('detailmodal',false )" wire:loading.attr="disabled">{{ __('Close') }}</x-jet-secondary-button>
		@endif
		</x-slot>
	</x-jet-dialog-modal>
</div>