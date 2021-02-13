<?php

namespace App\Http\Livewire\Admin\Item;

use Livewire\Component;

use Livewire\WithPagination;

use App\Models\ItemModel;
use App\Models\Item;
use App\Models\SizeDimension;
use App\Models\SubCategory;
use App\Models\Company;
class ItemmodelIndex extends Component
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
		'object.item' => 'required',
        'object.company' => 'required',
        'object.sale_price' => 'required',
        'object.default_size' => 'required',
	];
    public function render()
    {
        $this->object== new ItemModel;
        $items=Item::all();
        $companies=Company::all();
        $sizedimensions=SizeDimension::all();

    	$objects=ItemModel::where('id','like','%'.$this->q.'%')->orderBy($this->sortBy,$this->sortAsc ? 'ASC': 'DESC')
    	->paginate(5);
        return view('livewire.admin.item.Itemmodel-index',[
        	'sizedimensions'=> $sizedimensions,
            'companies'=> $companies,
        	'items'=> $items,
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
    public function destory(ItemModel $object){

        $this->detailmodal=false;
    	$object->delete();	
		session()->flash('danger','Item Model Deleted Successfully');
        $this->resetPage();
    	$this->confirmingDeletion=false;
    }

// Detail
    public function show(ItemModel $object){
        $this->object=$object;
    	$this->detailmodal=true;
    }
// Add
    public function create(){
        $this->reset(['object']);
        $this->addmodal=true;
    }
// Edit Category
    public function edit(ItemModel $object){
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
	    	$object=ItemModel::create([
	    		'item'=>$this->object['item'],
	    		'company'=>$this->object['company'],
                'sale_price'=>$this->object['sale_price'],
                'default_size'=>$this->object['default_size'],
	    	]);
            $this->object=$object;
    		session()->flash('success','Item Model Added Successfully');
	    	$this->addmodal=false;
    	}
        $this->detailmodal=true;
    }
}
