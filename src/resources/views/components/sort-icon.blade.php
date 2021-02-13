@props(['sortBy','sortAsc','sortfield'])

@if($sortBy == $sortfield)
	@if($sortAsc!=true)
		<i class="fa fa-sort-asc" aria-hidden="true"></i>
	@else 
		<i class="fa fa-sort-desc" aria-hidden="true"></i>
	@endif
@endif