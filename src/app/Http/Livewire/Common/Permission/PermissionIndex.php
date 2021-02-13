<?php

namespace App\Http\Livewire\Common\Permission;

use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
class PermissionIndex extends Component
{
use WithPagination;


	public $q;
	public $sortBy="id";
	public $sortAsc= true;

// to add update a  modal
	public $message;
    public $permission;
    public $selected_permissions;

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
		'permission.name' => 'required|string|min:2',
        'permission.description' => 'string|min:4',
	];
    public function render()
    {
        $this->permission== new Permission;
        $permissions=Permission::all();

    	$permissions=permission::where('id','like','%'.$this->q.'%')
    	->orWhere('name','like','%'.$this->q.'%')
    	->orderBy($this->sortBy,$this->sortAsc ? 'ASC': 'DESC')
    	->paginate(5);
        return view('livewire.common.permission.permission-index',[
        	'permissions'=> $permissions,
            'permission'=> $this->permission,
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
    public function destory(Permission $permission){

        $this->detailmodal=false;
    	$permission->delete();	
		session()->flash('danger','Permission Deleted Successfully');

        $this->resetPage();
    	$this->confirmingDeletion=false;
    }

// Detail
    public function show(Permission $permission){
        $this->permission=$permission;
    	$this->detailmodal=true;
    }
// Add
    public function create(){
        $this->reset(['permission']);
        $this->reset(['selected_permissions']);

        $permissions=Permission::all();
        $this->addmodal=true;
    }
// Edit Category
    public function edit(Permission $permission){
    	$this->reset(['permission']);
        $this->reset(['selected_permissions']);
    	$this->permission=$permission;

        $this->detailmodal=false;
    	$this->editmodal=true;
    }
// Update / Save

    // save and update
    public function store(){
        // dd($this->permission);
    	$this->validate();
    	if( isset( $this->permission->id ) ){
    		$this->permission->save();
    		session()->flash('primary','Permission Updated Successfully');
	    	$this->editmodal=false;
    	}else{
	    	$permission=Permission::create([
	    		'name'=>$this->permission['name'],
	    		'description'=>$this->permission['description']
	    	]);
            $this->permission=$permission;
    		session()->flash('success','Permission Added Successfully');
	    	$this->addmodal=false;
    	}
        $this->detailmodal=true;
    }
}
