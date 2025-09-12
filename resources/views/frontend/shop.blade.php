@extends('frontend.layouts.app')

@section('title', 'Shop')

@section('content')
<style>
.size-pill {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    border-radius: 50%; /* makes it round */
    border: 2px solid #ccc;
    color: #1b1c1d;
    cursor: pointer;
    font-weight: 500;
    font-size: 14px;
    transition: all 0.2s;
    text-align: center;
      text-transform: uppercase; 
      margin-bottom: 30px;
}

.size-pill:hover {
   border: 2px solid #db1215;
    /* color: white; */
}

.size-pill.active {
    background-color: #db1215;
    color: white;
}

.color-batch {
    display: inline-block;
    
}

.color-pill-label {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 4px 8px;
    border-radius: 20px;
    border: 1px solid #ccc;
    cursor: pointer;
    transition: all 0.2s;
    user-select: none;
}

.color-pill-label:hover {
    border-color: #000000;
}

.color-pill-label.active {
    border-color: #000000;
    background-color: #e7f1ff;
}

.color-circle {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 1px solid #bdbdbd;
}

.color-name {
    font-size: 0.9rem;
    font-weight: 500;
}
</style>

<livewire:product-list :categorieslug="$categorieslug" />
      <!-- page-title -->
        <div class="tf-page-title">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <div class="heading text-center">New Arrival</div>
                        <p class="text-center text-2 text_black-2 mt_5">Shop through our latest selection of Fashion</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->

           @livewire('product-list')
     
    
 
  
@endsection