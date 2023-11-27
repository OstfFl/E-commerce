<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\orders;
class OrdersListComponent extends Component
{
    public function render()
    {
        $orders=orders::orderBy('created_at', 'DESC')->paginate(5);
        return view('livewire.admin.orders-list-component',['orders'=>$orders]);
    }
}
