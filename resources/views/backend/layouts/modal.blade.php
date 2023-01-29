@stack('styles')
<!-- Modal -->
<div class="modal-content">
    <div class="modal-header ">

        <h4 class="modal-title" id="exampleModalTitle">
            @stack('title')
        </h4>
        <button type="button" class="btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="close"></button>

    </div>
    <div class="modal-body">
        @yield('content')

        <button type="button" class="btn btn-danger me-4 " data-bs-dismiss="modal">Close</button>
    </div>





</div>
<!-- End Modal -->
@stack('scripts')
