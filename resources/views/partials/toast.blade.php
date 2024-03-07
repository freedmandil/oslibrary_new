        @if (session('error') || session('warning') || session('status') || session('info'))
        @php
            $toastTitle = session('error') ? 'Error' :
                             (session('warning') ? 'Warning' :
                             (session('status') ? 'Notice' : 'Information'));
                $toastType = session('error') ? 'error' :
                             (session('warning') ? 'warning' :
                             (session('status') ? 'status' : 'info'));
                $bgColor = $toastType === 'error' ? '-danger text-light' :
                           ($toastType === 'warning' ? '-warning text-dark' :
                           ($toastType === 'status' ? '-success text-light' :
                           'bg-info text-light'));
                $borderColor = $toastType === 'error' ? 'border-danger' :
                               ($toastType === 'warning' ? 'border-warning' :
                               ($toastType === 'status' ? 'border-success' :
                               'border-primary'));
                $message = session($toastType);
        @endphp

        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast bg{{ $bgColor }} {{ $borderColor }} border-2" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg{{ $bgColor }} {{ $borderColor }}">
                    <strong class="me-auto">{{$toastTitle}}</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body fw-bold bg{{ $bgColor }}">
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
