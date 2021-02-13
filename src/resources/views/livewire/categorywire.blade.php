<div>

	<x-flash-message />
	<div class="row">
		<div class="col-md-4 pl-4">
		   <h3>Categories</h3>
		   <input type="number" name="" min="1" max="100"  wire:model="page" >
		</div>
		<div class="col-md-8 text-right pr-5">
			<input type="text" name="" wire:model="q" placeholder="search">
			<button class="btn btn-primary" wire:click="categoryadd()">Add Category</button>
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
   			<td>Action</td>
   		</tr>
   	</thead>
   	<tbody>
   		@foreach($categories as $category)
   		<tr>
   			<td>{{$category->id}}</td>
   			<td>{{$category->name}}</td>
   			<td>
				<button class="btn btn-primary" wire:click="categoryedit({{$category->id}})">Edit</button>
	            <x-jet-danger-button wire:click="categorydeleteconfirmation({{$category->id}})" wire:loading.attr="disabled">
	                {{ __('Delete') }}
	            </x-jet-danger-button>
   			</td>
   		</tr>
   		@endforeach
   	</tbody>
   </table>

   <!-- Pagination Links -->
   <div class="px-5 py-2">
	   	{{$categories->links()}}
   </div>





<!-- Delete Model -->
	<x-jet-confirmation-modal wire:model="confirmingCategoryDeletion">
		<x-slot name="title">
		    {{ __('Delete Category') }}
		</x-slot>
		<x-slot name="content">
		    {{ __('Are you sure you want to delete the category? Once your account is deleted, all of its resources and data will be permanently deleted.') }}
		</x-slot>
		<x-slot name="footer">
		    <x-jet-secondary-button wire:click="$set('confirmingCategoryDeletion',false )" wire:loading.attr="disabled">{{ __('Nevermind') }}</x-jet-secondary-button>
		    <x-jet-danger-button class="ml-2" wire:click="categorydelete({{$confirmingCategoryDeletion}})" wire:loading.attr="disabled">
		        {{ __('Delete Category') }}
		    </x-jet-danger-button>
		</x-slot>
	</x-jet-confirmation-modal>



<!-- Add Model -->
	<x-jet-dialog-modal wire:model="categoryadd">
		<x-slot name="title">
		    {{ __('New Category') }}
		</x-slot>
		<x-slot name="content">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="category.name" autocomplete="category.name" />
            <x-jet-input-error for="category.name" class="mt-2" />
		</x-slot>
		<x-slot name="footer">
		    <x-jet-secondary-button wire:click="$set('categoryadd',false )" wire:loading.attr="disabled">{{ __('Cancel') }}</x-jet-secondary-button>
		    <x-jet-danger-button class="ml-2" wire:click="categorysave()" wire:loading.attr="disabled">
		        {{ __('Save Category') }}
		    </x-jet-danger-button>
		</x-slot>
	</x-jet-dialog-modal>


<!-- Edit Model -->
	<x-jet-dialog-modal wire:model="categoryeditmodal">
		<x-slot name="title">
		    {{ __('Edit Category') }}
		</x-slot>
		<x-slot name="content">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="category.name" autocomplete="category.name" />
            <x-jet-input-error for="category.name" class="mt-2" />
		</x-slot>
		<x-slot name="footer">
		    <x-jet-secondary-button wire:click="$set('categoryeditmodal',false )" wire:loading.attr="disabled">{{ __('Cancel') }}</x-jet-secondary-button>
		    <x-jet-danger-button class="ml-2" wire:click="categorysave()" wire:loading.attr="disabled">
		        {{ __('Save Category') }}
		    </x-jet-danger-button>
		</x-slot>
	</x-jet-dialog-modal>
</div>