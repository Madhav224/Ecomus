<div>
    <section class="flat-spacing-11">
    {{-- <div class="container">
        <div class="grid grid-cols-12 gap-6">

            <!-- Sidebar -->
            <div class="col-span-3 bg-gray-50 p-4 rounded shadow">
                <div class="text-center mb-4">
                    <img src="{{ Auth::user()->profile_image_url }}" 
                         alt="avatar" class="w-24 h-24 rounded-full mx-auto">
                    <h4 class="mt-2 font-bold">{{ Auth::user()->name }}</h4>
                    <p class="text-gray-500 text-sm">{{ Auth::user()->email }}</p>
                </div>
                <ul class="space-y-3">
                    <li><a href="#profile" class="block py-2">👤 My Profile</a></li>
                    <li><a href="#address" class="block py-2">📍 My Address</a></li>
                    <li><a href="{{ route('orders.history') }}" class="block py-2">📦 Orders History</a></li>
                    <li>
                        <form method="POST" action="{{ route('frontend.logout') }}">
                            @csrf
                            <button type="submit" class="block py-2 w-full text-left">🚪 Logout</button>
                        </form>
                    </li>
                </ul>
            </div>

            <!-- Profile Section -->
            <div class="col-span-9 bg-white p-6 rounded shadow" id="profile">
                <h3 class="font-bold mb-4">Profile Information</h3>
                @if(session()->has('success'))
                    <div class="text-green-600 mb-3">{{ session('success') }}</div>
                @endif

                <form wire:submit.prevent="updateProfile" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label>Avatar</label>
                        <input type="file" wire:model="avatar" class="block mt-1">
                        @if($avatar)
                            <img src="{{ $avatar->temporaryUrl() }}" class="w-20 h-20 rounded mt-2">
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label>Name *</label>
                            <input type="text" wire:model="name" class="w-full border p-2 rounded">
                        </div>
                        <div>
                            <label>Phone No *</label>
                            <input type="text" wire:model="phone" class="w-full border p-2 rounded">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label>Email *</label>
                            <input type="email" wire:model="email" class="w-full border p-2 rounded">
                        </div>
                        <div>
                            <label>Date of Birth</label>
                            <input type="date" wire:model="dob" class="w-full border p-2 rounded">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label>Gender</label>
                        <select wire:model="gender" class="w-full border p-2 rounded">
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <button type="submit" class="mt-6 bg-black text-white px-6 py-2 rounded">
                        Update Profile
                    </button>
                </form>
            </div>

            <!-- Address Section -->
            <div class="col-span-9 bg-white p-6 rounded shadow mt-6" id="address">
                <h3 class="font-bold mb-4">My Addresses</h3>

                <!-- Existing Addresses -->
                <ul class="space-y-3 mb-6">
                    @foreach($addresses as $address)
                        <li class="border p-3 flex justify-between">
                            <span>{{ $address->address }}</span>
                            <button wire:click="deleteAddress({{ $address->id }})" 
                                    class="text-red-600">Remove</button>
                        </li>
                    @endforeach
                </ul>

                <!-- Add New Address -->
                <form wire:submit.prevent="saveAddress">
                    <div class="mb-3">
                        <label>Flat/House/Building *</label>
                        <input type="text" wire:model="address_line_1" class="w-full border p-2 rounded">
                    </div>
                    <div class="mb-3">
                        <label>Area/Street/Sector</label>
                        <input type="text" wire:model="address_line_2" class="w-full border p-2 rounded">
                    </div>
                    <div class="mb-3">
                        <label>Landmark</label>
                        <input type="text" wire:model="landmark" class="w-full border p-2 rounded">
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <input type="text" wire:model="city" placeholder="City" class="border p-2 rounded">
                        <input type="number" wire:model="state_id" placeholder="State ID" class="border p-2 rounded">
                        <input type="number" wire:model="country_id" placeholder="Country ID" class="border p-2 rounded">
                    </div>
                    <div class="mt-3">
                        <label>Pincode</label>
                        <input type="text" wire:model="pincode" class="w-full border p-2 rounded">
                    </div>
                    <button type="submit" class="mt-4 bg-black text-white px-6 py-2 rounded">
                        Save Address
                    </button>
                </form>
            </div>
        </div>
    </div> --}}

    <div class="container my-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            <div class="card p-3 text-center">
                <img src="{{ Auth::user()->profile_image_url }}" 
                     class="rounded-circle mx-auto mb-3" width="120" height="120" alt="Profile">
                <h5 class="fw-bold">{{ Auth::user()->name }}</h5>
                <p class="text-muted small">{{ Auth::user()->email }}</p>
            </div>

            <ul class="list-group mt-3">
                <li class="list-group-item {{ $tab === 'profile' ? 'active' : '' }}" 
                    wire:click="$set('tab','profile')">
                    <i class="bi bi-person"></i> My Profile
                </li>
                <li class="list-group-item {{ $tab === 'orders' ? 'active' : '' }}" 
                    wire:click="$set('tab','orders')">
                    <i class="bi bi-bag"></i> Orders History
                </li>
                <li class="list-group-item {{ $tab === 'address' ? 'active' : '' }}" 
                    wire:click="$set('tab','address')">
                    <i class="bi bi-geo-alt"></i> My Address
                </li>
                <li class="list-group-item">
                    <form method="POST" action="{{ route('frontend.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link text-danger p-0 m-0">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Content -->
        <div class="col-md-9">
            @if($tab === 'profile')
                @include('livewire.account.partials.profile')
            @elseif($tab === 'orders')
                @include('livewire.account.partials.orders')
            @elseif($tab === 'address')
                @include('livewire.account.partials.address')
            @endif
        </div>
    </div>
</div>

</section>

</div>
