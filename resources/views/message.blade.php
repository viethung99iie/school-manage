<style>
    .alert {
        color: white;
    }
</style>
{{-- secondary --}}
@if (session('secondary'))
    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
        {{session('secondary')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{{-- 2 --}}
@if (session('primary'))
       <div class="alert alert-primary alert-dismissible fade show" role="alert">
        {{session('primary')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{{-- 3 --}}
@if (session('dismissible'))
     <div class="alert alert-info alert-dismissible fade show" role="alert">
         {{session('dismissible')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{{-- 4 --}}
@if (session('success'))
       <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{{-- 5 --}}
@if (session('danger'))
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
       {{session('danger')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{{-- 6 --}}
@if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
         {{session('warning')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
