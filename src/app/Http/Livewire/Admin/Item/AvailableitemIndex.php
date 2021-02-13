<?php

namespace App\Http\Livewire\Admin\Item;

use Livewire\Component;

use Livewire\WithPagination;

use App\Models\ItemModel;
use App\Models\SizeDimension;
use App\Models\AvailableItem;
class AvailableitemIndex extends Component
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
		'object.item_model_id' => 'required',
        'object.size_id' => 'required',
        'object.quantity' => 'required',
	];
    public function render()
    {
        $this->object== new AvailableItem;
        $itemmodels=ItemModel::all();
        $sizedimensions=SizeDimension::all();

    	$objects=AvailableItem::where('id','like','%'.$this->q.'%')->orderBy($this->sortBy,$this->sortAsc ? 'ASC': 'DESC')
    	->paginate(5);
        return view('livewire.admin.item.availableitem-index',[
        	'sizedimensions'=> $sizedimensions,
            'itemmodels'=> $itemmodels,
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
    public function destory(AvailableItem $object){

        $this->detailmodal=false;
    	$object->delete();	
		session()->flash('danger','Item Model Deleted Successfully');
        $this->resetPage();
    	$this->confirmingDeletion=false;
    }

// Detail
    public function show(AvailableItem $object){
        $this->object=$object;
    	$this->detailmodal=true;
    }
// Add
    public function create(){
        $this->reset(['object']);
        $this->addmodal=true;
    }
// Edit Category
    public function edit(AvailableItem $object){
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
    		session()->flash('primary','Item Model Updated Successfully');
	    	$this->editmodal=false;
    	}else{
	    	$object=AvailableItem::create([
	    		'item_model_id'=>$this->object['item_model_id'],
	    		'size_id'=>$this->object['size_id'],
                'quantity'=>$this->object['quantity'],
	    	]);
            $this->object=$object;
    		session()->flash('success','Item Model Added Successfully');
	    	$this->addmodal=false;
    	}
        $this->detailmodal=true;
    }
}
