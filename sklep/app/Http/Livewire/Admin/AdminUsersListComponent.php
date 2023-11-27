<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class AdminUsersListComponent extends Component
{
    public function render()
    {
        $users=User::orderBy('created_at', 'DESC')->paginate(12);
        return view('livewire.admin.admin-users-list-component',['users'=>$users]);
    }
}
