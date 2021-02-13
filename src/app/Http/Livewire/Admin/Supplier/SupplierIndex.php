<?php

namespace App\Http\Livewire\Admin\Supplier;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class SupplierIndex extends Component
{
	use WithPagination;
	public $q;
	public $sortBy="id";
	public $sortAsc= true;

// to add update a  modal
	public $email;
	public $password;
	public $message;
    public $object;

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
		'object.name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'object.address' => 'required',
	];
    public function render()
    {
        $this->object== new Supplier;

    	$objects=Supplier::where('id','like','%'.$this->q.'%')->orderBy($this->sortBy,$this->sortAsc ? 'ASC': 'DESC')
    	->paginate(5);
        return view('livewire.admin.supplier.supplier-index',[
            'email'=> $this->email,
            'password'=> $this->password,
            'objects'=> $objects,
            'object'=> $this->object,
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
    public function destory(Supplier $object){

        $this->detailmodal=false;
    	$object->delete();	
		session()->flash('danger','Item Model Deleted Successfully');
        $this->resetPage();
    	$this->confirmingDeletion=false;
    }

// Detail
    public function show(Supplier $object){
        $this->object=$object;
    	$this->detailmodal=true;
    }
// Add
    public function create(){
        $this->reset(['object']);
        $this->addmodal=true;
    }
// Edit Category
    public function edit(Supplier $object){
    	$this->reset(['object']);
    	$this->object=$object;
        $this->detailmodal=false;
    	$this->editmodal=true;
    }
// Update / Save

    // save and update
    public function store(){
        // dd($this->object);
    	$this->validate();
    	if( isset( $this->object->id ) ){
    		$user=User::create([
    			'password'=>Hash::make($this->password),
    		]);

    		$this->object->save();
    		session()->flash('primary','Item Model Updated Successfully');
	    	$this->editmodal=false;
    	}else{
    		$user=User::create([
                'name'=>$this->object['name'],
    			'email'=>$this->email,
    			'password'=>Hash::make($this->password),
    		]);
	    	$object=Supplier::create([
                'name'=>$this->object['name'],
	    		'address'=>$this->object['address'],
	    		'user_id'=>$user->id,
	    	]);
            $this->object=$object;
    		session()->flash('success','Item Model Added Successfully');
	    	$this->addmodal=false;
    	}
        $this->detailmodal=true;
    }       	
}
