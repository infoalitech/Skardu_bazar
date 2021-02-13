<?php

namespace App\Http\Livewire\Common\User;

use Livewire\Component;
use Livewire\Group;
use Livewire\Permission;
use Livewire\User;
class UserShow extends Component
{
    public function render()
    {
        return view('livewire.common.user.user-show');
    }
}
