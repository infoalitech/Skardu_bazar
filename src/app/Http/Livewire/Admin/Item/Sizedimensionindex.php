<?php

namespace App\Http\Livewire\Admin\Item;

use Livewire\Component;
use App\Models\SizeDimension;
use App\Models\Size;
use Livewire\WithPagination;

class Sizedimensionindex extends Component
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
		'object.size_id' => 'required',
		'object.parent_id' => '',
		'object.parent_value' => 'required|Numeric|min:2',
	];
    public function render()
    {
        $this->object== new Sizedimension;
		$this->object['parent_id']=0;
        $sizes=Size::all();
        $parents=SizeDimension::all();

    	$objects=Sizedimension::where('id','like','%'.$this->q.'%')
    	->orWhere('name','like','%'.$this->q.'%')
    	->orderBy($this->sortBy,$this->sortAsc ? 'ASC': 'DESC')
    	->paginate(5);
        return view('livewire.admin.item.sizedimensionindex',[
            'sizes'=> $sizes,
            'parents'=> $parents,
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
    public function destory(SizeDimension $object){

        $this->detailmodal=false;
    	$object->delete();	
		session()->flash('danger','Size Dimension Deleted Successfully');
        $this->resetPage();
    	$this->confirmingDeletion=false;
    }

// Detail
    public function show(SizeDimension $object){
        $this->object=$object;
    	$this->detailmodal=true;
    }
// Add
    public function create(){
        $this->reset(['object']);
        $this->addmodal=true;
    }
// Edit Category
    public function edit(SizeDimension $object){
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
    		session()->flash('primary','Size Dimension Updated Successfully');
	    	$this->editmodal=false;
    	}else{
	    	$object=SizeDimension::create([
	    		'name'=>$this->object['name'],
	    		'parent_id'=>$this->object['parent_id'],
	    		'size_id'=>$this->object['size_id'],
	    		'parent_value'=>$this->object['parent_value'],
	    	]);
            $this->object=$object;
    		session()->flash('success','Size Dimension Added Successfully');
	    	$this->addmodal=false;
    	}
        $this->detailmodal=true;
    }
}
