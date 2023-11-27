<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class AdminAddCategoryComponent extends Component
{
    public $name;
    public $slug;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, ['name' => 'required', 'slug' => 'required']
        );
    }

    public function storeCategory()
    {
        $this->validate(['name' => ['required', 'regex:/^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłóńśźż]+\s?[A-ZĄĆĘŁŃÓŚŹŻ]?[a-ząćęłóńśźż]+$/u'], 'slug' => 'required'],
            ['regex'=>'Nazwa kategorii musi spełniac warunek, min: zaczynać się od dużej litery!']
        );
        $nameExists = DB::table('categories')->where('name', $this->name)->exists();
        if ($nameExists) {
            session()->flash('error', 'Categoria już istnieje w bazie danych!');
            return;
        }
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->save();
        session()->flash('message', 'Categoria Dodana!');
    }

    public function render()
    {

        return view('livewire.admin.admin-add-category-component');
    }
}
