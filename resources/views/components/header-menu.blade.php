{{-- @foreach($parentCategories as $parent)
    <li class="menu-item position-relative">
        
        <a href="{{ route('shop', $parent->slug) }}" class="item-link">
            {{ $parent->name }}
            @if($parent->children->count())
                <i class="icon icon-arrow-down"></i>
            @endif
        </a>

        
        @if($parent->children->count())
            <div class="sub-menu submenu-default">
                <ul class="menu-list">
                    @foreach($parent->children as $child)
                        <li>
                            <a href="{{ route('shop', $child->slug) }}" 
                               class="menu-link-text link text_black-2">
                                {{ $child->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </li>
@endforeach --}}

@foreach($parentCategories as $parent)
    <li class="menu-item position-relative">
        {{-- Parent category clickable --}}
        <a href="{{ route('shop', $parent->categorie_slug) }}" class="item-link">
            {{ $parent->categorie_name }}
            @if($parent->children->count())
                <i class="icon icon-arrow-down"></i>
            @endif
        </a>

        {{-- Children dropdown --}}
        @if($parent->children->count())
            <div class="sub-menu submenu-default">
                <ul class="menu-list">
                    @foreach($parent->children as $child)
                        <li>
                            <a href="{{ route('shop', $child->categorie_slug) }}" 
                               class="menu-link-text link text_black-2">
                                {{ $child->categorie_name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </li>
@endforeach

