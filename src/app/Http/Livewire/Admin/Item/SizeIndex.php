<?php

namespace App\Http\Livewire\Admin\Item;

use Livewire\Component;
use App\Models\Size;
use Livewire\WithPagination;

class SizeIndex extends Component
{
	use WithPagination;

	public $q;
	public $sortBy="id";
	public $sortAsc= true;

// to add update a  modal
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
		'object.name' => 'required|string|min:2',
	];
    public function render()
    {
        $this->object== new Size;
    	$objects=Size::where('id','like','%'.$this->q.'%')
    	->orWhere('name','like','%'.$this->q.'%')
    	->orderBy($this->sortBy,$this->sortAsc ? 'ASC': 'DESC')
    	->paginate(5);
        return view('livewire.admin.item.size-index',[
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
    public function destory(Size $object){

        $this->detailmodal=false;
    	$object->delete();	
		session()->flash('danger','Size Deleted Successfully');
        $this->resetPage();
    	$this->confirmingDeletion=false;
    }

// Detail
    public function show(Size $object){
        $this->object=$object;
    	$this->detailmodal=true;
    }
// Add
    public function create(){
        $this->reset(['object']);
        $this->addmodal=true;
    }
// Edit Category
    public function edit(Size $object){
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
    		$this->object->save();
    		session()->flash('primary','Size Updated Successfully');
	    	$this->editmodal=false;
    	}else{
	    	$object=Size::create([
	    		'name'=>$this->object['name'],
	    	]);
            $this->object=$object;
    		session()->flash('success','Size Added Successfully');
	    	$this->addmodal=false;
    	}
        $this->detailmodal=true;
    }
}
