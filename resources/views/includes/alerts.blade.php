@if (session()->has('success'))
    <div class="row">  
        <div class="col">
            <div class="alert alert-success alert-dismissible fade show col-lg-12 text-center" role="alert">    
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif