<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Categorie;

class HeaderMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public $parentCategories;
    public function __construct()
    {
        // Load only active parent categories with their children
        $this->parentCategories = Categorie::where('status', 'active')
            ->whereNull('categorie_parent_id')
            ->with('children')
            ->orderBy('categorie_name')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.header-menu');
    }
}
