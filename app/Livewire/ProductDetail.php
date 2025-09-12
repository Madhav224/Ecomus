<?php

namespace App\Livewire;

use Livewire\Component; 
use App\Models\Product; 
use App\Models\Categorie; 
use App\Models\Variant; 
use Illuminate\Support\Str;

class ProductDetail extends Component
{
    public $slug;
    public $product;
    public $images = [];
    public $variant_color = [];
    public $variant_size = [];

     public $quantity = 1;

    public $filter = [
        'variant_colors' => [],
        'variant_sizes' => [],
    ];

    public function mount($slug)
    {
        $this->slug = $slug;

        $this->product = Product::with('ProductVariants')
            ->where('status', 'active')
            ->where('product_slug', $this->slug)
            ->firstOrFail();

        // --- Normalize product images into $this->images (full URLs) ---
        $raw = $this->product->product_images ?? [];

        if (is_string($raw)) {
            $decoded = json_decode($raw, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $rawImages = $decoded;
            } else {
                $trimmed = trim($raw, "[] \t\n\r\0\x0B\"'");
                $rawImages = $trimmed === '' ? [] : array_map('trim', explode(',', $trimmed));
            }
        } elseif (is_array($raw)) {
            $rawImages = $raw;
        } else {
            $rawImages = [];
        }

        $processed = [];
        foreach ($rawImages as $item) {
            if (!$item) continue;

            if (is_array($item)) {
                $path = $item['path'] ?? $item['url'] ?? $item['image'] ?? null;
            } elseif (is_object($item)) {
                $path = $item->path ?? $item->url ?? null;
            } else {
                $path = (string) $item;
            }

            $path = trim($path);
            if (!$path) continue;

            if (preg_match('/^https?:\/\//i', $path)) {
                $processed[] = $path;
                continue;
            }

            $path = ltrim($path, '/');
            if (Str::startsWith($path, 'storage/')) {
                $processed[] = asset($path);
            } else {
                $processed[] = asset('storage/' . $path);
            }
        }

        $this->images = array_values(array_unique($processed));

        $this->loadVariants();
    }


        public function increaseQuantity()
    {
        $this->quantity++;
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }


    protected function loadVariants()
    {
        $variants = $this->product->ProductVariants;

        $colorIds = [];
        $sizeIds = [];

        foreach ($variants as $pv) {
            foreach ($pv->variant_ids ?? [] as $variantId) {
                $v = Variant::find($variantId);
                if (!$v) continue;

                $parent = Variant::find($v->variant_parent_id);
                $parentName = strtolower($parent?->variant_name ?? '');

                if (in_array($parentName, ['color', 'colors', 'colour'])) {
                    $colorIds[$v->id] = $v;
                } elseif ($parentName === 'size') {
                    $sizeIds[$v->id] = $v;
                }
            }
        }

        $this->variant_color = collect($colorIds)->unique('id')->values();
        $this->variant_size  = collect($sizeIds)->unique('id')->values();
    }

    public function render()
    {
        return view('livewire.product-detail', [
            'product'       => $this->product,
            'images'        => $this->images,
            'variant_color' => $this->variant_color,
            'variant_size'  => $this->variant_size,
        ]);
    }
}
