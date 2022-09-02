@if(session()->has('error'))
<div id="alertError" class="alert alertError alert-danger text-light alert-dismissible fade show" role="alert">
    {{ session()->get('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if(session()->has('success'))
<div id="alertTambah" class="alert alert-tambah alert-success alert-dismissible fade show" role="alert">
    {{ session()->get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@push('alertScript')
<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alertError").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 5000);
    });
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alertTambah").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 5000);
    });

</script>
@endpush

