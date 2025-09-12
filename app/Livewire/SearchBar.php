<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Categorie;

class SearchBar extends Component
{
     public $query = '';
    public $products = [];
    public $categories = [];

    public function updatedQuery()
    {
        $search = $this->query;

        if (strlen($search) >= 2) {
            $this->products = Product::where('status', 'active')
                ->where('product_name', 'like', "%{$search}%")
                ->take(5)
                ->get();

            $this->categories = Categorie::where('status', 'active')
                ->where('categorie_name', 'like', "%{$search}%")
                ->take(5)
                ->get();
        } else {
            $this->products = [];
            $this->categories = [];
        }
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}




// namespace App\Livewire;

// use Livewire\Component;
// use App\Models\Product;
// use App\Models\Categorie;
// use Illuminate\Support\Collection;

// class SearchBar extends Component
// {
//     public string $query = '';
//     public Collection $products;
//     // public Collection $categories;

//     public function mount()
//     {
//         // Always initialize as empty collections
//         $this->products = collect();
//         // $this->categories = collect();
//     }

//     public function updatedQuery()
//     {
//         $search = $this->query;

//         if (strlen($search) >= 2) {
//             $this->products = Product::where('status', 'active')
//                 ->where('product_name', 'like', "%{$search}%")
//                 ->take(5)
//                 ->get();
//         } else {
//             // Reset with empty collections instead of arrays
//             $this->products = collect();
//             // $this->categories = collect();
//         }
//     }

//     public function render()
//     {
//         return view('livewire.search-bar');
//     }
// }

