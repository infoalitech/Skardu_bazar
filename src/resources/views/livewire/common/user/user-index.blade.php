<div>
	<x-flash-message />
	<div class="row">
		<div class="col-sm-4 pl-4">
		   <h3>Users</h3>
		</div>
		<div class="col-sm-8 text-right pr-5">
			<input type="text" name="" wire:model="q" placeholder="search">
			<button class="btn btn-primary" wire:click="create()">Add user</button>
		</div>
	</div>
  @if(@count($users) >0)
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
   				<button wire:click="sortBy('email')">Email</button>
   				<x-sort-icon sortfield="email" :sort-by="$sortBy" :sort-asc="$sortAsc" />
	   		</td>
   			<td>Action</td>
   		</tr>
   	</thead>
   	<tbody>
   		@foreach($users as $userr)
   		<tr>
   			<td>{{$userr->id}}</td>
   			<td>{{$userr->name}}</td>
   			<td>{{$userr->email}}</td>
   			<td>
				<button class="btn btn-primary" wire:click="show({{$userr->id}})">Detail</button>
   			</td>
   		</tr>
   		@endforeach
   	</tbody>
   </table>

   <!-- Pagination Links -->
   <div class="px-5 py-2">
	   	{{$users->links()}}
   </div>

	@else
		<h3 class="text-center">No User Found</h3>
	@endif

<!-- Delete Model -->
	<x-jet-confirmation-modal wire:model="confirmingDeletion">
		<x-slot name="title">
		    {{ __('Delete user') }}
		</x-slot>
		<x-slot name="content">
		    {{ __('Are you sure you want to delete the user? Once your account is deleted, all of its resources and data will be permanently deleted.') }}
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
		    {{ __('New user') }}
		</x-slot>
		<x-slot name="content">
			@include('livewire.common.user.user-form')
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
		    {{ __('Edit User') }}
		</x-slot>
		<x-slot name="content">
			@include('livewire.common.user.user-form')
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
			@if(@isset($user->image))
				<img src="{{ storage_path('app/'.$user->image) }}" alt="Profile Picture" title=""></a>
			@endif

			<table class="table">
				<tr>
					<td colspan="2">
					</td>
				</tr>
				<tr>
					<th>Name</th>
					<td>@if(@isset($user->name)){{$user->name}}@endif</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>@if(@isset($user->email)){{$user->email}}@endif</td>
				</tr>
				<tr>
					<th>Groups</th>
					<td>@if(@isset($user->groups))
						<table class="table p-0">
							@foreach($user->groups as $grp)
							<tr><td>{{$grp->name}}</td></tr>
							@endforeach
						</table>
					@endif</td>
				</tr>
				<tr>
					<th>Permissions</th>
					<td>@if(@isset($user->permissions))
						<table class="table p-0">
							@foreach($user->permissions as $perm)
							<tr><td>{{$perm->name}}</td></tr>
							@endforeach
						</table>
					@endif</td>
				</tr>
			</table>
		</x-slot>
		<x-slot name="footer">
			@if(@isset($user->id))
			<button class="btn btn-primary" wire:click="edit({{$user->id}})">Edit</button>
            <x-jet-danger-button wire:click="confirmdelete({{$user->id}})" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>

		    <x-jet-secondary-button wire:click="$set('detailmodal',false )" wire:loading.attr="disabled">{{ __('Close') }}</x-jet-secondary-button>
		    @endif
		</x-slot>
	</x-jet-dialog-modal>
</div>