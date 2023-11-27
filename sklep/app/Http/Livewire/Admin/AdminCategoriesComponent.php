<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;
use SimpleXMLElement;
use Spatie\ArrayToXml\ArrayToXml;
use Livewire\WithFileUploads;

class AdminCategoriesComponent extends Component
{
    public $category_id;
    public $jsonFile;
    public $xmlFile;
    use WithPagination, WithFileUploads;

    public function deleteCategory(){
        $category=Category::find($this->category_id);
        $category->delete();
        session()->flash('message','Usunięto');
    }
    public function exportToJson(){
        $categories = Category::all();
        $jsonData = $categories->toJson();
        $filePath = public_path('data/JSON/exportCategoriesJSON.json');
        File::ensureDirectoryExists(dirname($filePath));
        File::put($filePath, $jsonData);
        session()->flash('message','Wyeksportowano JSON!');
    }
    public function exportToXML(){
        $categories = Category::all();
        $xml = new SimpleXMLElement('<categories></categories>');

        foreach ($categories as $category) {
            $categoryElement = $xml->addChild('category');
            $categoryElement->addChild('name', $category->name);
            $categoryElement->addChild('slug', $category->slug);
            $categoryElement->addChild('created_at', $category->created_at);
            $categoryElement->addChild('updated_at', $category->updated_at);
        }

        $xmlData = $xml->asXML();
        $filePath = public_path('data/XML/exportCategoriesXML.xml');
        File::ensureDirectoryExists(dirname($filePath));
        File::put($filePath, $xmlData);
        session()->flash('message','Wyeksportowano XML!');
    }





    public function storeCategory()
    {
        $this->validate(['jsonFile' => 'required|mimes:json']);

        $jsonContents = File::get($this->jsonFile->path());
        $categories = json_decode($jsonContents);

        if (is_array($categories)) {
            $newCategories = [];

            foreach ($categories as $categoryName) {
                if (is_string($categoryName)) {
                    $existingCategory = Category::where('name', $categoryName)->first();

                    if (!$existingCategory) {
                        $newCategory = new Category();
                        $newCategory->name = $categoryName;
                        $newCategory->slug = Str::slug($categoryName);
                        $newCategory->save();
                        $newCategories[] = $newCategory->name;
                    }
                } else {
                    session()->flash('error', 'Podany plik JSON zawiera niepoprawny typ danych!');
                    $this->jsonFile = null;
                    return;
                }
            }

            if (empty($newCategories)) {
                session()->flash('error', 'Wszystkie kategorie już istnieją w bazie danych!');
            } else {
                session()->flash('message', 'Kategorie dodane z pliku JSON: ' . implode(', ', $newCategories));
            }
        } else {
            session()->flash('error', 'Podany plik JSON nie zawiera poprawnej listy kategorii!');
        }

        $this->jsonFile = null;
    }
    public function importFromXml()
    {
        $this->validate(['xmlFile' => 'required|mimes:xml']);

        $xmlContents = File::get($this->xmlFile->path());
        $categories = simplexml_load_string($xmlContents);

        if ($categories instanceof SimpleXMLElement) {
            $newCategories = [];

            foreach ($categories as $category) {
                $categoryName = (string) $category;

                if (!empty($categoryName)) {
                    $existingCategory = Category::where('name', $categoryName)->first();

                    if (!$existingCategory) {
                        $newCategory = new Category();
                        $newCategory->name = $categoryName;
                        $newCategory->slug = Str::slug($categoryName);
                        $newCategory->save();
                        $newCategories[] = $newCategory->name;
                    }
                } else {
                    session()->flash('error', 'Podany plik XML zawiera nieprawidłowy format danych!');
                    $this->xmlFile = null;
                    return;
                }
            }

            if (empty($newCategories)) {
                session()->flash('error', 'Wszystkie kategorie już istnieją w bazie danych!');
            } else {
                session()->flash('message', 'Kategorie dodane z pliku XML: ' . implode(', ', $newCategories));
            }
        } else {
            session()->flash('error', 'Podany plik XML nie zawiera poprawnej listy kategorii!');
        }

        $this->xmlFile = null;
    }



    public function render()
    {
        $categories = Category::orderBy('name','ASC')->paginate(10);
        return view('livewire.admin.admin-categories-component',['categories'=>$categories]);
    }
}
