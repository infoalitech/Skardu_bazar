<?php

namespace App\Http\Livewire\Admin\Customer;

use Livewire\Component;

use App\Models\User;
use App\Models\CustomerRanking;
use App\Models\CustomerTypes;
use App\Models\Customer;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
class Index extends Component
{


    use WithPagination;

    public $q;
    public $sortBy="id";
    public $sortAsc= true;

// to add update a  modal
    public $message;
    public $customer;

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
        'customer.name' => 'required|string|min:2',
        'customer.rank' => 'required',
        'customer.type' => 'required',
    ];
    public function render()
    {

        $this->customer== new Customer;

        $ranks=CustomerRanking::all();
        $types=CustomerTypes::all();
        $customers=Customer::where('id','like','%'.$this->q.'%')
        ->orWhere('name','like','%'.$this->q.'%')
        ->orderBy($this->sortBy,$this->sortAsc ? 'ASC': 'DESC')
        ->paginate(5);
        return view('livewire.admin.customer.index',[
        	'ranks'=> $ranks,
            'types'=> $types,
            'customers'=> $customers,
            'customer'=> $this->customer,
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
        if( $this->sortBy==$fieldname){
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
    public function destory(Customer $customer){

        $this->detailmodal=false;
        $customer->delete();    
        session()->flash('danger','customer Deleted Successfully');

        $this->resetPage();
        $this->confirmingDeletion=false;
    }

// Detail
    public function show(Customer $customer){
        $this->customer=$customer;
        $this->detailmodal=true;
    }
// Add
    public function create(){
        $this->reset(['customer']);
        $this->reset(['q']);
        $this->addmodal=true;
    }
// Edit Category
    public function edit(Customer $customer){
        $this->reset(['customer']);
        $this->reset(['q']);
        $this->customer=$customer;

        $this->detailmodal=false;
        $this->editmodal=true;
    }
// Update / Save

    // save and update
    public function store(){
        // dd($this->customer);
        if( isset( $this->customer->id ) ){
            $this->validate();
            $this->customer->save();
            session()->flash('primary','customer Updated Successfully');
            $this->editmodal=false;
        }else{
            $this->validate([
                'customer.email' => 'required|email|min:2',
                'customer.password' => 'required|min:8',
            ]);
            $user=User::create([
                'name'=>$this->customer['name'],
                'email'=>$this->customer['email'],
                'password'=>Hash::make($this->customer['password']),
            ]);

            $customer=Customer::create([
                'name'=>$this->customer['name'],
                'rank'=>$this->customer['rank'],
                'type'=>$this->customer['type'],
                'user_id'=>$user->id,
            ]);
            $this->customer=$customer;
            session()->flash('success','customer Added Successfully');
            $this->addmodal=false;
        }
        $this->detailmodal=true;
        $this->reset(['q']);
    }


}
