<?php

namespace App\Http\Livewire\Admin;

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
    public $prize = true;

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

    public function updatingPrize()
    {
        $this->resetPage();
    }

    public function render()
    {
//        $products = Product::where('name', 'LIKE', "%{$this->search}%")->paginate($this->pagination);
        $products = Product::query()->applyFilters(['search' => $this->search])->paginate($this->pagination);

        return view('livewire.admin.show-products2', compact('products'))->layout('layouts.admin');
    }
}
