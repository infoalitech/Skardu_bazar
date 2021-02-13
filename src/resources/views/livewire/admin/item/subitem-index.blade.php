<div>

	<x-flash-message />
	<div class="row">
		<div class="col-md-4 pl-4">
		   <h3>Sub Item</h3>
		   <input type="number" name="" min="1" max="100"  wire:model="page" >
		</div>
		<div class="col-md-8 text-right pr-5">
			<input type="text" name="" wire:model="q" placeholder="search">
			<button class="btn btn-primary" wire:click="categoryadd()">Add Category</button>
		</div>
	</div>
</div>