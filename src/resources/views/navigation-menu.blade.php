<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">{{ config('app.name', 'Drop Shop') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <!-- Right of navbar -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>

    </ul>

    <!-- Left of navbar -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item"><a class="nav-link" href="{{ route('services')}}">Services</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('help')}}">Help</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('getapp')}}">Get The App</a></li>
    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('orders') }}">{{ __('Orders') }}</a>
        </li>        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('purchases') }}">{{ __('Purchses') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('companies') }}">{{ __('Company') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('suppliers') }}">{{ __('Suppliers') }}</a>
        </li>



        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Item  
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('category') }}">{{ __('Categories') }}</a>
                <a class="dropdown-item" href="{{ route('subcategory') }}">{{ __('Sub Categories') }}</a>
                <a class="dropdown-item" href="{{ route('items') }}">{{ __('Items') }}</a>
                <a class="dropdown-item" href="{{ route('itemmodels') }}">{{ __('Item Models') }}</a>
                <a class="dropdown-item" href="{{ route('availableitemmodels') }}">{{ __('Available Item Models') }}</a>
                <a class="dropdown-item" href="{{ route('itemsizedimension') }}">{{ __('Item Size Dimensions') }}</a>
                <a class="dropdown-item" href="{{ route('itemsizes') }}">{{ __('Item Sizes') }}</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Customers  
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('customer') }}">{{ __('Customers') }}</a>
                <a class="dropdown-item" href="{{ route('customertypes') }}">{{ __('Customer Types') }}</a>
                <a class="dropdown-item" href="{{ route('customerranking') }}">{{ __('Customer Ranks') }}</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="fa fa-usesr">
                    <img src="{{ Auth::user()->image }}" width="20px" height="20px" class="rounded-circle"> {{ Auth::user()->name }}  &nbsp;&nbsp; <span class="caret"></span>
                </i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                <a class="dropdown-item" href="{{ route('group') }}">{{ __('Groups') }}</a>
                <a class="dropdown-item" href="{{ route('permission') }}">{{ __('Permissions') }}</a>
                <a class="dropdown-item" href="{{ route('user') }}">{{ __('Users') }}</a>
                <a class="dropdown-item" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
    </ul>
  </div>
</nav>








