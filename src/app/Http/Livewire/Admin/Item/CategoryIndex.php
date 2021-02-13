<?php

namespace App\Http\Livewire\Admin\Item;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;


class CategoryIndex extends Component
{

    use WithPagination;

	public $active;
	public $q;
	public $category;

	public $sortBy="id";
	public $sortAsc= true;
	public $categoryadd=false;
	public $categoryeditmodal=false;
	public $confirmingCategoryDeletion=false;

	public $queryString=[
		'q'=> ['except' => ''],
		'sortBy'=> ['except' => 'id'],
		'sortAsc'=> ['except' => true]
	];


	protected $rules=[
		'category.name' => 'required|string|min:2'
	];
    
    public function render()
    {
    	$categories=Category::where('id','like','%'.$this->q.'%')
    	->orWhere('name','like','%'.$this->q.'%')
    	->orderBy($this->sortBy,$this->sortAsc ? 'ASC': 'DESC')
    	->paginate(5);
        return view('livewire.admin.item.category-index',[
        	'categories'=> $categories,
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
    public function categorydeleteconfirmation($id){
    	// $category->delete();	

    	$this->confirmingCategoryDeletion=$id;
    }
    public function categorydelete(Category $category){
    	$category->delete();	
		session()->flash('danger','Category Deleted Successfully');
        $this->resetPage();
    	$this->confirmingCategoryDeletion=false;
    }

    // Add Category
    public function categoryadd(){
    	$this->reset(['category']);
    	$this->categoryadd=true;
    }
    // Edit Category
    public function categoryedit(Category $category){
    	$this->reset(['category']);
    	$this->category=$category;
    	$this->categoryeditmodal=true;
    }

    // save and update
    public function categorysave(){
    	$this->validate();

    	if( isset( $this->category->id ) ){
    		$this->category->save();
    		session()->flash('primary','Category Updated Successfully');
	    	$this->categoryeditmodal=false;
    	}else{
	    	Category::create([
	    		'name'=>$this->category['name']
	    	]);
    		session()->flash('success','Category Added Successfully');
	    	$this->categoryadd=false;
    	}
    }




}
