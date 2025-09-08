<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Variant;

class ProductList extends Component
{
    
    use WithPagination;
    public $categorieslug = null;
    // public $sortBy = 'default'; // default sorting

    public $filter = [
        'categories_ids' => [],
        'sort_by' => 'latest',
        'variant_sizes' => [],
        'variant_colors' => [],
        'min_price' => null,
        'max_price' => null,
       
    ];

    protected $paginationTheme = 'bootstrap';

    public function mount($categorieslug = null)
    {
        $this->categorieslug = $categorieslug;
    }

    public function updated($name, $value)
    {
        if (str_starts_with($name, 'filter.')) {
            $this->resetPage();
            
        }
    }


    public function render()
    {
        $slug_categorie = Categorie::select('id', 'categorie_name', 'categorie_slug')
            ->where('categorie_slug', $this->categorieslug)
            ->where('status', 'active')
            ->first();

        $slug_categorie_ids = array_values(array_unique($slug_categorie?->allCategoryIds()->toArray() ?? []));

        $parent_categories = Categorie::select('id', 'categorie_name', 'categorie_slug')
            ->where('status', 'active')
            ->whereNull('categorie_parent_id')
            ->orderByDesc('id')
            ->get();
            
         // Price range (global min/max)
        $priceRange = Product::where('status', 'active')
            ->selectRaw('MIN(product_price) as min_price, MAX(product_price) as max_price')
            ->first();

        // Initialize filter values only once
        if (!$this->filter['min_price']) {
            $this->filter['min_price'] = (int) $priceRange->min_price;
        }
        if (!$this->filter['max_price']) {
            $this->filter['max_price'] = (int) $priceRange->max_price;
        }

        $variant_size = Variant::select('id', 'variant_name')
            ->whereIN('variant_name', ['size', 'Size'])
            ->first()?->children ?? collect();

        $variant_color = Variant::select('id', 'variant_name')
            ->whereIN('variant_name', ['color', 'colors', 'colour'])
            ->first()?->children ?? collect();

        $products = Product::select('id','product_slug')
            ->where('status', 'active')
            ->when(!$this->filter['categories_ids'] && $slug_categorie_ids, function ($query) use ($slug_categorie_ids) {
                $query->where(function ($query) use ($slug_categorie_ids) {
                    foreach ($slug_categorie_ids as $cateId) {
                        $query->orWhereJsonContains('product_categorie_id', (string) $cateId);
                    }
                });
            })
            ->when($this->filter['categories_ids'], function ($query) {
                $query->where(function ($query) {
                    $cats = array_values(array_unique(array_merge(...array_map('json_decode', $this->filter['categories_ids'] ?? []))));

                    foreach ($cats as $categoryId) {
                        $query->orWhereJsonContains('product_categorie_id', (string) $categoryId);
                    }
                });
            })
            ->when($this->filter['sort_by'] ?? false, function ($query) {
                if ($this->filter['sort_by'] == 'latest') {
                    return $query->orderByDesc('id');
                } elseif ($this->filter['sort_by'] == 'discountHighToLow') {
                    return $query->orderByDesc('product_discount');
                } elseif ($this->filter['sort_by'] == 'priceLowToHigh') {
                    return $query->orderBy('product_price');
                } elseif ($this->filter['sort_by'] == 'priceHighToLow') {
                    return $query->orderByDesc('product_price');
                }
            })

             ->when($this->filter['min_price'] && $this->filter['max_price'], function ($query) {
                $query->whereBetween('product_price', [
                    $this->filter['min_price'],
                    $this->filter['max_price']
                ]);
            })
            ->when(
                $this->filter['variant_sizes'] ?? false,
                fn($q) =>
                $q->whereHas(
                    'ProductVariants',
                    fn($q2) =>
                    $q2->orwhereJsonContains('variant_ids', $this->filter['variant_sizes'])
                )
            )
            ->when(
                $this->filter['variant_colors'] ?? false,
                fn($q) =>
                $q->whereHas(
                    'ProductVariants',
                    fn($q2) =>
                    $q2->whereJsonContains('variant_ids', $this->filter['variant_colors'])
                )
            )
    
        ->paginate(12);

        return view('livewire.product-list', compact(
            'parent_categories',
            'priceRange',
            'variant_size',
            'variant_color',

            'products'
        ));
    }





}

