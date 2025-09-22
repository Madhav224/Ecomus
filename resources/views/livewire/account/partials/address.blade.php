 <div class="card p-4">
    <h5 class="fw-bold mb-3">My Addresses</h5>

    @if(Auth::user()->Address->isEmpty())
        <p class="text-muted">No address saved yet.</p>
    @endif

    @foreach(Auth::user()->Address as $address)
        <div class="border rounded p-3 mb-3">
            <p class="mb-1"><strong>{{ $address->address_type ?? 'Address' }}</strong></p>
            <p class="mb-1">{{ $address->address }}</p>
            <p class="mb-1">Phone: {{ $address->phone_no ?? '-' }}</p>
            <p class="mb-0">Pincode: {{ $address->pincode }}</p>
        </div>
    @endforeach

    <hr>

    <h6 class="fw-bold mb-3">Add New Address</h6>
    <form wire:submit.prevent="addAddress">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Country</label>
                <input type="text" wire:model="country_name" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">State</label>
                <input type="text" wire:model="state_name" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">City</label>
                <input type="text" wire:model="city" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Pincode</label>
                <input type="text" wire:model="pincode" class="form-control">
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
        </div>
        <button type="submit" class="btn btn-primary">Save Address</button>
    </form>
</div> 
{{-- 

<div class="card p-4">
    <h5 class="fw-bold mb-3">My Addresses</h5>

    @if($addresses->isEmpty())
        <p class="text-muted">No address saved yet.</p>
    @endif

    @foreach($addresses as $address)
        <div class="border rounded p-3 mb-3">
            <p class="mb-1"><strong>{{ $address->name }}</strong></p>
            <p class="mb-1">{{ $address->address }}</p>
            <p class="mb-1">Phone: {{ $address->phone_no ?? '-' }}</p>
            <p class="mb-0">Pincode: {{ $address->pincode }}</p>
        </div>
    @endforeach

    <hr>

    <h6 class="fw-bold mb-3">Add New Address</h6>
    <form wire:submit.prevent="saveAddress">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" wire:model="addr_name" class="form-control">
                @error('addr_name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Phone</label>
                <input type="text" wire:model="addr_phone_no" class="form-control">
                @error('addr_phone_no') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Country</label>
                <select wire:model="country_id" class="form-select">
                    <option value="">-- Select Country --</option>
                    @foreach($countries as $country)
                        <option value="India">India</option>
                    @endforeach
                </select>
                @error('country_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">State</label>
                <select wire:model="state_id" class="form-select">
                    <option value="">-- Select State --</option>
                    @foreach($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
                @error('state_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">City</label>
                <input type="text" wire:model="city" class="form-control">
                @error('city') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Pincode</label>
                <input type="text" wire:model="addr_pincode" class="form-control">
                @error('addr_pincode') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">Address Line 1</label>
                <input type="text" wire:model="address_line_1" class="form-control">
                @error('address_line_1') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">Address Line 2</label>
                <input type="text" wire:model="address_line_2" class="form-control">
                @error('address_line_2') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">Landmark</label>
                <input type="text" wire:model="landmark" class="form-control">
                @error('landmark') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save Address</button>
    </form>
</div> --}}

