@php
    $error = session('error');
    $warning = session('warning');
    $status = session('status');
    $info = session('info');

    switch(true) {
        case $error:
            $toastTitle = 'Error';
            $toastType = 'error';
            break;
        case $warning:
            $toastTitle = 'Warning';
            $toastType = 'warning';
            break;
        case $status:
            $toastTitle = 'Notice';
            $toastType = 'status';
            break;
        case $info:
            $toastTitle = 'Information';
            $toastType = 'info';
            break;
        default:
            $toastTitle = '';
            $toastType = '';
            break;
    }

     $bgColor = match($toastType) {
        'error' => '-danger text-light',
        'warning' => '-warning text-dark',
        'status' => '-success text-light',
        default => 'bg-info text-light',
    };

      $alertColor = match($toastType) {
        'error' => 'alert alert-danger',
        'warning' => 'alert alert-warning',
        'status' => 'alert alert-success',
        default => 'alert alert-info',
    };

    $bgColor = match($toastType) {
        'error' => 'bg-danger text-light',
        'warning' => 'bg-warning text-dark',
        'status' => 'bg-success text-light',
        default => 'bg-info text-light',
    };

    $borderColor = match($toastType) {
        'error' => 'border-danger',
        'warning' => 'border-warning',
        'status' => 'border-success',
        default => 'border-primary',
    };

    $message = session($toastType);
@endphp

@if ($toastTitle && $toastType && $message)
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast {{ $alertColor }} {{ $borderColor }} border-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header ">
                <strong class="me-auto">{{$toastTitle}}</strong>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body fw-bold ">
                {{ $message }}
            </div>
        </div>
    </div>

    <script>
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function(toastEl) {
            // Customize autohide and other options if needed
            return new bootstrap.Toast(toastEl, { autohide: true }).show();
        });
    </script>
@endif

