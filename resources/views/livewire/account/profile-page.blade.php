<div>


@include('livewire.account.head')
    
    <div class="container my-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            @include('livewire.account.sidebar')
        </div>

        <!-- Profile Content -->
        <div class="col-md-9">
            <div class="card p-4">
                <h5 class="fw-bold mb-3">My Profile</h5>

                <form wire:submit.prevent="updateProfile">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" wire:model="name" class="form-control">
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
 
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" wire:model="email" class="form-control" readonly style="background-color: #e9ecef;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" wire:model="phone_no" class="form-control">
                        @error('phone_no') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="row">
                      
                    </div>

                   

                    <button type="submit" class="btn btn-primary" >Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>


</div>
