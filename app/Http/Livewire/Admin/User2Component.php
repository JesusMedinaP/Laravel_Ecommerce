<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class User2Component extends Component
{
    use WithPagination;

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function assignRole(User $user, $value)
    {
        if ($value == '1') {
            $user->assignRole('admin');
        } else {
            $user->removeRole('admin');
        }
    }

    public function trash(User $user)
    {
        $user->delete();

    }

    public function render()
    {

//        $users = User::where('name', 'LIKE', "%{$this->search}%")
//            ->orWhere('email', 'LIKE', "%{$this->search}%")
//            ->paginate();
//        Antigua forma de buscar, en la que sale el usuario logueado

        $users = User::where('email', '<>', auth()->user()->email)
            ->where(function($query){
                $query->where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%');
            })->orderBy('id')->paginate();

        return view('livewire.admin.user2-component', compact('users'))->layout('layouts.admin');
    }
}
