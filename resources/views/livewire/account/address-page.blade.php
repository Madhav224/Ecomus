<div>
    @include('livewire.account.head')
    <div class="container my-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            @include('livewire.account.sidebar')
        </div>

        <!-- Address Content -->
        <div class="col-md-9">
            <div class="card p-4">
                <h5 class="fw-bold mb-3">My Addresses</h5>

                @if($addresses->isEmpty())
                    <p class="text-muted">No addresses saved yet.</p>
                @else
                    @foreach($addresses as $address)
                        <div class="border rounded p-3 mb-3">
                            <p class="mb-1"><strong>{{ $address->name }}</strong></p>
                            <p class="mb-1">{{ $address->address }}</p>
                            <p class="mb-1">Phone: {{ $address->phone_no }}</p>
                            <p class="mb-0">Pincode: {{ $address->pincode }}</p>
                            {{-- <button wire:click="editAddress({{ $address->id }})" class="btn btn-sm btn-outline-warning">
                                Edit
                            </button> --}}
                            <button wire:click="deleteAddress({{ $address->id }})" class="btn btn-sm btn-outline-danger" >
                                Delete
                            </button>
                        </div>
                    @endforeach
                @endif

                <hr>

                <h6 class="fw-bold mb-3">Add New Address</h6>
                <form wire:submit.prevent="saveAddress">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" wire:model="name" class="form-control">
                            @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" wire:model="phone_no" class="form-control">
                            @error('phone_no') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pincode</label>
                            <input type="text" wire:model="pincode" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">City</label>
                            <input type="text" wire:model="city" class="form-control">
                            @error('city') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Address Line 1</label>
                            <input type="text" wire:model="address_line_1" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Address Line 2</label>
                            <input type="text" wire:model="address_line_2" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Landmark</label>
                            <input type="text" wire:model="landmark" class="form-control">
                        </div>
                        {{-- <div class="col-md-6 mb-3">
                            <label class="form-label">State ID</label>
                            <input type="number" wire:model="state_id" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Country ID</label>
                            <input type="number" wire:model="country_id" class="form-control">
                        </div> --}}
                    </div>
                    <button type="submit" class="btn btn-primary">Save Address</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
