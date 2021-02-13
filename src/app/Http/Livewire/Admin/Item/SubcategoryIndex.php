<?php

namespace App\Http\Livewire\Admin\Item;

use Livewire\Component;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\WithPagination;

class SubcategoryIndex extends Component
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
        'object.category' => 'required',
	];
    public function render()
    {
        $this->object== new SubCategory;
        $categories=Category::all();

    	$objects=SubCategory::where('id','like','%'.$this->q.'%')
    	->orWhere('name','like','%'.$this->q.'%')
    	->orderBy($this->sortBy,$this->sortAsc ? 'ASC': 'DESC')
    	->paginate(5);
        return view('livewire.admin.item.subcategory-index',[
        	'categories'=> $categories,
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
    public function destory(SubCategory $object){

        $this->detailmodal=false;
    	$object->delete();	
		session()->flash('danger','rank Deleted Successfully');
        $this->resetPage();
    	$this->confirmingDeletion=false;
    }

// Detail
    public function show(SubCategory $object){
        $this->object=$object;
    	$this->detailmodal=true;
    }
// Add
    public function create(){
        $this->reset(['object']);
        $this->addmodal=true;
    }
// Edit Category
    public function edit(SubCategory $object){
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
    		session()->flash('primary','Object Updated Successfully');
	    	$this->editmodal=false;
    	}else{
	    	$object=SubCategory::create([
	    		'name'=>$this->object['name'],
	    		'category'=>$this->object['category']
	    	]);
            $this->object=$object;
    		session()->flash('success','Object Added Successfully');
	    	$this->addmodal=false;
    	}
        $this->detailmodal=true;
    }
}
