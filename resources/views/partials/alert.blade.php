@php
    $level = $level ?? 'status';

    switch($level) {
        case 'error':
        case 'danger':
            $bootstrapName = 'danger';
            $bootstrapText = 'light';
            $bootstrapTitle = 'There was an Error';
            break;
        case 'warning':
            $bootstrapName = 'warning';
            $bootstrapText = 'dark';
            $bootstrapTitle = 'Warning Notice';
            break;
        case 'success':
        case 'status':
            $bootstrapName = 'success';
            $bootstrapText = 'light';
            $bootstrapTitle = 'Action was successful';
            break;
        case 'info':
            $bootstrapName = 'info';
            $bootstrapText = 'dark';
            $bootstrapTitle = 'For Your Information';
            break;
        case 'primary':
        default:
            $bootstrapName = 'primary';
            $bootstrapText = 'light';
            $bootstrapTitle = 'Notice';
            break;
    }
@endphp

@if(isset($message))
    <div class="alert alert-{{ $bootstrapName }}" role="alert">
        <strong>{{ $bootstrapTitle }}</strong>: {{ $message }}
    </div>
@endif

@if(session($level) && !isset($message))
    <div class="alert alert-{{ $bootstrapName }}">
        {{ session($type) }}
    </div>
@endif
