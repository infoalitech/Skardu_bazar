	@if(session()->has('primary'))
		<div class="alert alert-primary" role="alert">
			  {{session('primary')}}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>
	@endif
	@if(session()->has('secondary'))
		<div class="alert alert-secondary" role="alert">
			  {{session('secondary')}}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>
	@endif
	@if(session()->has('success'))
		<div class="alert alert-success" role="alert">
			  {{session('success')}}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>
	@endif
	@if(session()->has('danger'))
		<div class="alert alert-danger" role="alert">
			  {{session('danger')}}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>
	@endif
	@if(session()->has('warning'))
		<div class="alert alert-warning" role="alert">
			  {{session('warning')}}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>
	@endif
	@if(session()->has('info'))
		<div class="alert alert-info" role="alert">
			  {{session('info')}}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>
	@endif
	@if(session()->has('light'))
		<div class="alert alert-light" role="alert">
			  {{session('light')}}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>
	@endif
	@if(session()->has('dark'))
		<div class="alert alert-dark" role="alert">
			  {{session('dark')}}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>
	@endif


