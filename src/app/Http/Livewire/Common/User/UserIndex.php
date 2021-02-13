<?php

namespace App\Http\Livewire\Common\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Permission;
use App\Models\Group;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserIndex extends Component
{

    use WithPagination;
    use WithFileUploads;
    
    public $photo;

	public $q;
	public $sortBy="id";
	public $sortAsc= true;

// to add update a  modal
	public $message;
    public $user;
    public $selected_permissions;
    public $selected_groups;

// variable to show/hide models
	public $addmodal=false;
	public $editmodal=false;
    public $detailmodal=false;
	public $confirmingDeletion=false;

// setting default and remove from url
	public $queryString=[
		'q'=> ['except' => ''],
		'sortBy'=> ['except' => 'id'],
		'sortAsc'=> ['except' => true]
	];
// Rules for validation
	protected $rules=[
		'user.name' => 'required|string|min:2',
        'user.email' => 'required|email|string|min:4',
        'user.password' => 'required|min:8',
        'photo' => 'image|max:1024', // 1MB Max
	];
    public function render()
    {
        $this->user== new user;
        $permissions=Permission::all();
        $groups=Group::all();

    	$users=User::where('name','like','%'.$this->q.'%')
    	->orWhere('email','like','%'.$this->q.'%')
    	->orderBy($this->sortBy,$this->sortAsc ? 'ASC': 'DESC')
    	->paginate(5);
        return view('livewire.common.user.user-index',[
        	'users'=> $users,
        	'groups'=> $groups,
            'permissions'=> $permissions,
            'user'=> $this->user,
        ]);
    }
// Updating page on changes
    public function updatingActive(){
    	$this->resetPage();
    }
    public function updatingQ(){
    	$this->resetPage();
    }
// Sort
    public function sortBy($fieldname){
    	if(	$this->sortBy==$fieldname){
    		if ($this->sortAsc==true) {
		    	$this->sortAsc=false;
    		}else{
		    	$this->sortAsc=true;
    		}
    	}else{
	    	$this->sortBy=$fieldname;
    	}
    }
// Delete
    public function confirmdelete($id){
        $this->detailmodal=false;
    	$this->confirmingDeletion=$id;
    }
    public function destory(User $user){

        $this->detailmodal=false;
    	$user->delete();	
		session()->flash('danger','User Deleted Successfully');

        $this->resetPage();
    	$this->confirmingDeletion=false;
    }

// Detail
    public function show(User $user){
        $this->user=$user;
        // dd($this->user);
    	$this->detailmodal=true;
    }
// Add
    public function create(){
        $this->reset(['user']);
        $this->reset(['selected_permissions']);
        $this->reset(['selected_groups']);
        $this->reset(['photo']);
        $permissions=Permission::all();
        $groups=Group::all();
        $this->addmodal=true;
    }
// Edit Category
    public function edit(User $user){
    	$this->reset(['user']);
        $this->reset(['selected_permissions']);
        $this->reset(['selected_groups']);
        $this->reset(['photo']);
    	$this->user=$user;


        $this->detailmodal=false;
    	$this->editmodal=true;
    }
// Update / Save

    // save and update
    public function store(){


    	if( isset( $this->user->id ) ){
            $this->validate();
            $this->user->image='photos\profile_pics\ '.$this->user->id.' .jpg';
    		$this->user['password']=Hash::make($this->user['password']);
    		$this->user->save();

            $this->user->permissions()->detach();
            $this->user->permissions()->attach($this->selected_permissions);

            $this->user->groups()->detach();
            $this->user->groups()->attach($this->selected_groups);

            $this->photo->storeAs('photos\profile_pics',$this->user->id.'.jpg');

    		session()->flash('primary','User Updated Successfully');
	    	$this->editmodal=false;
    	}else{
        	$this->validate([
                'user.email' => 'unique:users,email'
            ]);
	    	$user=User::create([
	    		'name'=>$this->user['name'],
	    		'email'=>$this->user['email'],
	    		'password'=>Hash::make($this->user['password'])
	    	]);

            $user->image='photos\profile_pics\ '.$user->id.' .jpg';
            $user->save();

            $this->photo->storeAs('photos\profile_pics',$user->id);
            $user->permissions()->attach($this->selected_permissions);
            $user->groups()->attach($this->selected_groups);

            $this->user=$user;
    		session()->flash('success','User Added Successfully');
	    	$this->addmodal=false;
    	}
        $this->detailmodal=true;
    }
}
