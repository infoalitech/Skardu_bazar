<?php

namespace App\Http\Livewire\Admin\Purchase;

use Livewire\Component;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use App\Models\Item;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
class PurchaseShow extends Component
{
	use WithPagination;
	public $purchase;
	public $sortBy="id";
	public $sortAsc= true;

// to add update a  modal
	public $q;
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
        'object.available_item_id' => 'required',
        'object.quantity' => 'required',
        'object.unit_price' => 'required',
        'object.unit_sale_price' => 'required',
        'object.total_price' => 'required',
	];
    public function render()
    {
        $this->object== new Purchase;
        $suppliers=Supplier::all();
        $items=Item::all();

    	$purchase_items=PurchaseItem::where('purchase_id',$this->purchase->id)
    	->orderBy($this->sortBy,$this->sortAsc ? 'ASC': 'DESC')
    	->paginate(5);

        return view('livewire.admin.purchase.purchase-show',[
        	'purchase_items'=> $purchase_items,
        	'suppliers'=> $suppliers,
            'items'=> $items,
            'purchase'=> $this->purchase,
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
    public function destory(PurchaseItem $object){

        $this->detailmodal=false;
    	$object->delete();	
		session()->flash('danger','Purchase Deleted Successfully');
        $this->resetPage();
    	$this->confirmingDeletion=false;
    }

// Detail
    public function show(PurchaseItem $object){
        $this->object=$object;
    	$this->detailmodal=true;
    }
// Add
    public function create(){
        $this->reset(['object']);
        $this->addmodal=true;
    }
// Edit Category
    public function edit(PurchaseItem $object){
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
    		session()->flash('primary','Purchase Updated Successfully');
	    	$this->editmodal=false;
    	}else{

	    	$object=PurchaseItem::create([
	    		'purchase_id'=>$this->purchase->id,
	    		'available_item_id'=>$this->object['available_item_id'],
	    		'quantity'=>$this->object['quantity'],
	    		'unit_price'=>$this->object['unit_price'],
                'unit_sale_price'=>$this->object['unit_sale_price'],
                'total_price'=>$this->object['total_price'],
	    	]);
            $this->object=$object;
    		session()->flash('success','Purchase Added Successfully');
	    	$this->addmodal=false;
    	}
        $this->detailmodal=true;
    }
    // save and update
    public function next(){
        // dd($this->object);
    	$this->validate();
    	$object=PurchaseItem::create([
    		'purchase_id'=>$this->purchase->id,
    		'available_item_id'=>$this->object['available_item_id'],
    		'quantity'=>$this->object['quantity'],
    		'unit_price'=>$this->object['unit_price'],
            'unit_sale_price'=>$this->object['unit_sale_price'],
            'total_price'=>$this->object['total_price'],
    	]);
        $this->object=new PurchaseItem;
		session()->flash('success','Purchase Added Successfully');
    	$this->addmodal=true;
    }
}
