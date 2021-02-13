<?php

namespace App\Http\Livewire\Admin\Customer\Ranking;

use Livewire\Component;

use App\Models\CustomerRanking;
use Livewire\WithPagination;

class Index extends Component
{
	use WithPagination;

	public $q;
	public $sortBy="id";
	public $sortAsc= true;

// to add update a  modal
	public $message;
    public $rank;
    public $selected_ranks;

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
		'rank.name' => 'required|string|min:2',
        'rank.rank' => 'required|string',
	];
    public function render()
    {
        $this->rank== new CustomerRanking;
        $ranks=CustomerRanking::all();

    	$ranks=CustomerRanking::where('id','like','%'.$this->q.'%')
    	->orWhere('name','like','%'.$this->q.'%')
    	->orderBy($this->sortBy,$this->sortAsc ? 'ASC': 'DESC')
    	->paginate(5);
        return view('livewire.admin.customer.ranking.index',[
        	'ranks'=> $ranks,
            'rank'=> $this->rank,
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
    public function destory(CustomerRanking $rank){

        $this->detailmodal=false;
    	$rank->delete();	
		session()->flash('danger','rank Deleted Successfully');

        $this->resetPage();
    	$this->confirmingDeletion=false;
    }

// Detail
    public function show(CustomerRanking $rank){
        $this->rank=$rank;
    	$this->detailmodal=true;
    }
// Add
    public function create(){
        $this->reset(['rank']);
        $this->reset(['selected_ranks']);

        // $ranks=rank::all();
        $this->addmodal=true;
    }
// Edit Category
    public function edit(CustomerRanking $rank){
    	$this->reset(['rank']);
        $this->reset(['selected_ranks']);
    	$this->rank=$rank;

        $this->detailmodal=false;
    	$this->editmodal=true;
    }
// Update / Save

    // save and update
    public function store(){
        // dd($this->rank);
    	$this->validate();
    	if( isset( $this->rank->id ) ){
    		$this->rank->save();
    		session()->flash('primary','rank Updated Successfully');
	    	$this->editmodal=false;
    	}else{
	    	$rank=CustomerRanking::create([
	    		'name'=>$this->rank['name'],
	    		'rank'=>$this->rank['rank']
	    	]);
            $this->rank=$rank;
    		session()->flash('success','rank Added Successfully');
	    	$this->addmodal=false;
    	}
        $this->detailmodal=true;
    }
}
