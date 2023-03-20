<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducts2 extends Component
{
    use WithPagination;

    public $search;
    public $pagination = 10;
    public $name = true;
    public $category = true;
    public $brand = true;
    public $sold = true;
    public $stock = true;
    public $date = true;
    public $state = true;
    public $price = true;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $selectedCategory;
    public $selectedBrand;
    public $selectedPrice;
    public $selectedDate;


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPagination()
    {
        $this->resetPage();
    }

    public function updatingName()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingBrand()
    {
        $this->resetPage();
    }

    public function updatingSold()
    {
        $this->resetPage();
    }

    public function updatingStock()
    {
        $this->resetPage();
    }

    public function updatingDate()
    {
        $this->resetPage();
    }

    public function updatingState()
    {
        $this->resetPage();
    }

    public function updatingPrice()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if($this->sortField === $field)
        {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else{
            if($field === 'subcategory.category.name'){
                $this->sortField = 'subcategory_id';
            }else if($field === 'brand_id.name'){
                $this->sortField = 'brand_id';
            }else
            {
                $this->sortField = $field;
            }
        }
    }

    public function render()
    {
//        $products = Product::where('name', 'LIKE', "%{$this->search}%")
//            ->orderBy($this->sortField, $this->sortDirection)
//            ->paginate($this->pagination);
//
//        $products = Product::query()->applyFilters(['search' => $this->search])->paginate($this->pagination);

        $products = Product::query()
            ->when($this->selectedCategory, function ($query)
            {
               return $query->whereHas('subcategory.category', function ($query){
                   $query->where('id', $this->selectedCategory);
               });
            })
            ->when($this->selectedBrand, function ($query)
            {
                return $query->whereHas('brand', function ($query){
                    $query->where('brand_id', $this->selectedBrand);
                });
            })
            ->when($this->selectedPrice, function ($query){
                return $query->where('price', $this->selectedPrice);
            })
            ->when($this->selectedDate, function ($query){
                return $query->whereDate('created_at', $this->selectedDate);
            })
            ->where('name', 'LIKE', "%{$this->search}%")
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->pagination);

        return view('livewire.admin.show-products2', compact('products'),[
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ])->layout('layouts.admin');
    }
}
