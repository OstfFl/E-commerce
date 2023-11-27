<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\ProductImages;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
class AdminProductComponent extends Component
{
    public $product_id;
    use WithPagination,WithFileUploads;
    public function deleteProduct(){
        $product=Product::find($this->product_id);

        $product->delete();
        session()->flash('message','Produkt Usunięty!');
    }



    public $title;
    public $slug;
    public $description;
    public $price;
    public $stock;
    public $image;
    public $category;
    public $jsonFile;
    public $xmlFile;
    public function generateSlug()
    {
        $this->slug = Str::slug($this->title);
    }

    public function addProduct()
    {
        $this->validate([
            'title' => ['required'],
            'slug' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
            'stock' => ['required'],
            'image' => ['required'],
            'category' => ['required'],
        ]);

        $nameExists = DB::table('products')->where('name', $this->name)->exists();
        if ($nameExists) {
            session()->flash('error', 'Produkt już istnieje w bazie danych!');
            return;
        }

        $product = new Product();
        $productDetails = new ProductDetails();
        $productImage = new ProductImages();

        $product->name = $this->title;
        $product->slug = $this->slug;

        $productDetails->short_description = $this->description;
        $productDetails->description = $this->generateLoremIpsum();
        $product->sale_price = $this->price;

        $product->sku = '';
        $product->stock_status = 'instock';
        $product->featured = 0;
        $product->quantity = $this->stock;

        $productImage->image = $this->image;




        $product->category_id = $this->getCategoryId($this->category);

        $product->save();
        $productImage->product_id = $product->id;
        $productDetails->product_id = $product->id;
        $productDetails->save();
        $productImage->save();
        session()->flash('message', 'Produkt dodany!');
    }
    private function generateLoremIpsum()
    {
        // Generate lorem ipsum text with 150 words
        $loremIpsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel vulputate mauris. Vestibulum et consectetur lorem. In id dignissim eros, et pharetra urna. Vivamus ullamcorper enim a nisi faucibus, sed pellentesque metus mattis. Sed pretium laoreet lobortis. Curabitur efficitur lectus at tortor accumsan pulvinar. Pellentesque tristique ligula ut gravida condimentum. Sed dapibus dolor in metus efficitur, ut tristique purus gravida. Nunc et iaculis neque. Nam a augue eget magna malesuada efficitur. Cras laoreet mi orci, eu placerat lacus semper a. Vivamus non felis in purus sagittis egestas. Sed auctor metus in diam elementum varius. Sed tincidunt est urna, nec suscipit odio convallis nec. Proin sed est rutrum, egestas turpis eget, venenatis odio.';
        $words = str_word_count($loremIpsum, 1);
        shuffle($words);
        $selectedWords = array_slice($words, 0, 150);
        $randomLoremIpsum = implode(' ', $selectedWords);

        return $randomLoremIpsum;
    }

    private function getCategoryId($categoryName)
    {
        $category = Category::where('name', $categoryName)->first();

        if ($category) {
            return $category->id;
        }

        return null;
    }



    public function exportToJson()
    {
        $products = Product::get();

        $data = [];
        foreach ($products as $product) {
            $productDetails = ProductDetails::where('product_id', $product->id)->first();
            $productImages = ProductImages::where('product_id', $product->id)->get();

            $images = [];
            foreach ($productImages as $image) {
                $images[] = $image->image;
            }

            $data[] = [
                'title' => $product->name,
                'slug' => $product->slug,
                'short_description' => $productDetails->short_description,
                'description'=>$productDetails->description,
                'price' => $product->sale_price,
                'stock' => $product->quantity,
                'images' => $images,
                'category' => $product->category->name,
                'created_at'=>$product->created_at,
                'updated_at'=>$product->updated_at
            ];
        }

        $jsonData = json_encode(['products' => $data], JSON_PRETTY_PRINT);

        // Save JSON data to a file

        $filePath = public_path('data/JSON/exportProductsJSON.json');
        File::ensureDirectoryExists(dirname($filePath));
        File::put($filePath, $jsonData);

        session()->flash('message', 'Dane zostały wyeksportowane do pliku JSON: ');
    }



    public function exportToXml()
    {
        $products = Product::get();

        $xmlData = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><products></products>');

        foreach ($products as $product) {
            $productDetails = ProductDetails::where('product_id', $product->id)->first();
            $productImages = ProductImages::where('product_id', $product->id)->get();

            $productNode = $xmlData->addChild('product');
            $productNode->addChild('title', htmlspecialchars($product->name));
            $productNode->addChild('slug', htmlspecialchars($product->slug));
            $productNode->addChild('short_description', htmlspecialchars($productDetails->short_description));
            $productNode->addChild('description', htmlspecialchars($productDetails->description));
            $productNode->addChild('price', $product->sale_price);
            $productNode->addChild('stock', $product->quantity);

            $imagesNode = $productNode->addChild('images');
            foreach ($productImages as $image) {
                $imagesNode->addChild('image', htmlspecialchars($image->image));
            }

            $productNode->addChild('category', htmlspecialchars($product->category->name));
            $productNode->addChild('created_at', $product->created_at);
            $productNode->addChild('updated_at', $product->updated_at);
        }

        // Save XML data to a file
        $filePath = public_path('data/XML/exportProductsXML.xml');
        File::ensureDirectoryExists(dirname($filePath));
        $xmlData->asXML($filePath);

        session()->flash('message', 'Dane zostały wyeksportowane do pliku XML: ');
    }






    public function importFromJson()
    {
        $this->validate(['jsonFile' => 'required|mimes:json']);

        $jsonContents = File::get($this->jsonFile->path());
        $products = json_decode($jsonContents, true);

        if (!isset($products['products'])) {
            session()->flash('error', 'Nieprawidłowy format pliku JSON!');
            return;
        }

        foreach ($products['products'] as $product) {
            $existingProduct = Product::where('name', $product['title'])->first();

            if ($existingProduct) {
                session()->flash('error', 'Są produkty istniejące w bazie ');
                continue;
            }

            $category = $this->getCategoryId($product['category']);

            if (!$category) {
                session()->flash('error', 'Nie znaleziono kategorii dla produktu: ' . $product['title']);
                continue;
            }

            $newProduct = new Product();
            $newImage = new ProductImages();
            $newDescription = new ProductDetails();
            $newProduct->name = $product['title'];
            $newProduct->slug = Str::slug($product['title']);
            $newProduct->sale_price = $product['price'];
            $newProduct->quantity = $product['stock'];
            $newProduct->category_id = $category;
            $newProduct->sku = $product['brand'];
            $newDescription->short_description = $product['description'];
            $newDescription->description = $this->generateLoremIpsum();
            $newImage->image = $product['thumbnail'];


            $newProduct->save();
            $newImage->product_id = $newProduct->id;
            $newDescription->product_id = $newProduct->id;
            $newImage->save();
            $newDescription->save();
            session()->flash('message', 'Produkty zaimportowane z pliku JSON!');
        }


    }


    public function importFromXml()
    {
        $this->validate(['xmlFile' => 'required|mimes:xml']);

        $xmlContents = File::get($this->xmlFile->path());
        $xml = simplexml_load_string($xmlContents);

        if (!$xml) {
            session()->flash('error', 'Nieprawidłowy format pliku XML!');
            return;
        }

        $importedProducts = 0;

        foreach ($xml->products as $product) {
            $existingProduct = Product::where('name', (string)$product->title)->exists();

            if ($existingProduct) {
                continue;
            }

            $category = $this->getCategoryId((string)$product->category);

            if (!$category) {
                session()->flash('error', 'Nie znaleziono kategorii dla produktu: ' . $product->title);
                continue;
            }

            $newProduct = new Product();
            $newImage = new ProductImages();
            $newDescription = new ProductDetails();
            $newProduct->name = (string)$product->title;
            $newProduct->slug = Str::slug((string)$product->title);
            $newProduct->sale_price = (float)$product->price;
            $newProduct->quantity = (int)$product->stock;
            $newProduct->category_id = $category;
            $newProduct->sku = (string)$product->brand;
            $newDescription->short_description = (string)$product->description;
            $newDescription->description = $this->generateLoremIpsum();
            $newImage->image = (string)$product->thumbnail;

            $newProduct->save();
            $newImage->product_id = $newProduct->id;
            $newDescription->product_id = $newProduct->id;
            $newImage->save();
            $newDescription->save();

            $importedProducts++;
        }

        if ($importedProducts === 0) {
            session()->flash('error', 'Wszystkie produkty z pliku XML już istnieją w bazie danych, lub czegoś nie ma zaimportowanych kategorii!');
        } else {
            session()->flash('message', 'Zaimportowano ' . $importedProducts . ' nowych produktów z pliku XML!');
        }
    }







    public function render()
    {
        $products=Product::orderBy('created_at', 'DESC')->paginate(12);
        $images=ProductImages::get();
        return view('livewire.admin.admin-product-component',['products'=>$products,'images'=>$images]);
    }
}
