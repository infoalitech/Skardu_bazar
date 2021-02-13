<?php

namespace App\Http\Livewire\Admin\Purchase;

use Livewire\Component;

use App\Models\Purchase;
use App\Models\Supplier;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
class PurchaseIndex extends Component
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
        'object.supplier_id' => 'required|string',
        'object.date' => 'required',
        'object.total_price' => 'required',
        'object.paid' => 'required',
        'object.left' => 'required',
        // 'object.status' => 'required',
	];
    public function render()
    {
        $this->object== new Purchase;
        $suppliers=Supplier::all();
    	$objects=Purchase::where('id','like','%'.$this->q.'%')
    	->orderBy($this->sortBy,$this->sortAsc ? 'ASC': 'DESC')
    	->paginate(5);
        return view('livewire.admin.purchase.purchase-index',[
        	'suppliers'=> $suppliers,
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
    public function destory(Purchase $object){

        $this->detailmodal=false;
    	$object->delete();	
		session()->flash('danger','Purchase Deleted Successfully');
        $this->resetPage();
    	$this->confirmingDeletion=false;
    }

// Detail
    public function show(Purchase $object){
        $this->object=$object;
    	$this->detailmodal=true;
    }
// Add
    public function create(){
        $this->reset(['object']);
        $this->addmodal=true;
    }
// Edit Category
    public function edit(Purchase $object){
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

	    	$object=Purchase::create([
	    		'purchase_by'=>Auth::user()->id,
	    		'date'=>$this->object['date'],
	    		'supplier_id'=>$this->object['supplier_id'],
	    		'total_price'=>$this->object['total_price'],
                'paid'=>$this->object['paid'],
                'left'=>$this->object['left'],
                'status'=>$this->object['status'],
	    	]);
            $this->object=$object;
    		session()->flash('success','Purchase Added Successfully');
	    	$this->addmodal=false;
    	}
        $this->detailmodal=true;
    }
}
