<?php

namespace App\Http\Livewire\Common\Group;

use Livewire\Component;
use App\Models\Group;
use App\Models\Permission;
use App\Models\User;
use Livewire\WithPagination;

class GroupIndex extends Component
{

    use WithPagination;


	public $q;
	public $sortBy="id";
	public $sortAsc= true;

// to add update a  modal
	public $message;
    public $group;
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
		'group.name' => 'required|string|min:2|unique:groups',
        'group.description' => 'string|min:4',
	];

    public function render()
    {
        $this->group== new Group;
        $permissions=Permission::all();

    	$groups=Group::where('description','like','%'.$this->q.'%')
    	->orWhere('name','like','%'.$this->q.'%')
    	->orderBy($this->sortBy,$this->sortAsc ? 'ASC': 'DESC')
    	->paginate(5);
        return view('livewire.common.group.group-index',[
        	'groups'=> $groups,
            'group'=> $this->group,
            'permissions'=> $permissions,
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
    public function destory(Group $group){

        $this->detailmodal=false;
    	$group->delete();	
		session()->flash('danger','Group Deleted Successfully');

        $this->resetPage();
    	$this->confirmingDeletion=false;
    }

// Detail
    public function show(Group $group){
        $this->group=$group;
    	$this->detailmodal=true;
    }
// Add
    public function create(){
        $this->reset(['group']);
        $this->reset(['selected_permissions']);

        $permissions=Permission::all();
        $this->addmodal=true;
    }
// Edit Category
    public function edit(Group $group){
    	$this->reset(['group']);
        $this->reset(['selected_permissions']);
    	$this->group=$group;

        $this->detailmodal=false;
    	$this->editmodal=true;
    }
// Update / Save

    // save and update
    public function store(){
    	$this->validate();
        // dd($this->selected_permissions);
    	if( isset( $this->group->id ) ){
    		$this->group->save();

            $this->group->permissions()->detach();
            $this->group->permissions()->attach($this->selected_permissions);

    		session()->flash('primary','Group Updated Successfully');
	    	$this->editmodal=false;
    	}else{
	    	$group=Group::create([
	    		'name'=>$this->group['name'],
	    		'description'=>$this->group['description']
	    	]);
            $group->permissions()->attach($this->selected_permissions);

            $this->group=$group;
    		session()->flash('success','Group Added Successfully');
	    	$this->addmodal=false;
    	}
        

        $this->detailmodal=true;
    }
}
