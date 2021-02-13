<?php

namespace App\Http\Livewire\Admin\Customer\Type;

use Livewire\Component;
use App\Models\CustomerTypes;
use Livewire\WithPagination;

class Index extends Component
{

	use WithPagination;

	public $q="";
	public $sortBy="id";
	public $sortAsc= true;

// to add update a  modal
	public $message;
    public $type;

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
		'type.name' => 'required|string|min:2',
	];
    public function render()
    {

        $this->type== new CustomerTypes;

    	$types=CustomerTypes::where('id','like','%'.$this->q.'%')
    	->orWhere('name','like','%'.$this->q.'%')
    	->orderBy($this->sortBy,$this->sortAsc ? 'ASC': 'DESC')
    	->paginate(5);
        return view('livewire.admin.customer.type.index',[
        	'types'=> $types,
            'type'=> $this->type,
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
    public function destory(type $type){

        $this->detailmodal=false;
    	$type->delete();	
		session()->flash('danger','type Deleted Successfully');

        $this->resetPage();
    	$this->confirmingDeletion=false;
    }

// Detail
    public function show(CustomerTypes $type){
        $this->type=$type;
    	$this->detailmodal=true;
    }
// Add
    public function create(){
        $this->reset(['type']);
        $this->addmodal=true;
    }
// Edit Category
    public function edit(CustomerTypes $type){
    	$this->reset(['type']);
    	$this->type=$type;

        $this->detailmodal=false;
    	$this->editmodal=true;
    }
// Update / Save

    // save and update
    public function store(){
        // dd($this->type);
    	$this->validate();
    	if( isset( $this->type->id ) ){
    		$this->type->save();
    		session()->flash('primary','Type Updated Successfully');
	    	$this->editmodal=false;
    	}else{
	    	$type=CustomerTypes::create([
	    		'name'=>$this->type['name'],
	    	]);
            $this->type=$type;
    		session()->flash('success','Type Added Successfully');
	    	$this->addmodal=false;
    	}
        $this->detailmodal=true;
    }
}
