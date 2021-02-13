<?php

namespace App\Http\Livewire\Common\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class ProfileIndex extends Component
{

    use WithPagination;
    use WithFileUploads;
    
    public $photo;
    public $old_password;
    public $new_password;

	public $editmodal=false;
	public $profilemodal=false;

    public function render()
    {
    	$user=Auth::user();
        return view('livewire.common.profile.profile-index',[
        	'user'=>$user,
        ]);
    }
    public function updateprofilemodal()
    {
    	$this->profilemodal=true;
    }
    public function updatepasswordmodal()
    {
    	$this->editmodal=true;
    }


    public function updateprofile()
    {
        $this->photo->storeAs('photos\profile_pics',Auth::user()->id.'.jpg');
        Auth::user()->image='photos\profile_pics\ '.Auth::user()->id.' .jpg';
    	Auth::user()->save();
    	$this->profilemodal=false;
		session()->flash('primary','Profile Picture Updated Successfully');
    }
    public function updatepassword()
    {
    	$this->validate([
		    'old_password' => 'required',
		    'new_password' => 'required|string|min:8'
		]);

		if (Hash::check($this->old_password, Auth::user()->password)) { 
		   Auth::user()->fill([
		    'password' => Hash::make($this->new_password)
			    ])->save();

			Auth::user()->password=Hash::make($this->new_password);
			Auth::user()->save();
    		session()->flash('primary','Password Updated Successfully');
    	}else{
    		session()->flash('danger','Unauthorized Access..!');
    	}
    	$this->editmodal=false;
    }
}
