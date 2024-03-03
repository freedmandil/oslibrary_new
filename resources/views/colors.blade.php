@php
if (!function_exists('lightenColor')) {
           function lightenColor($hex, $amount) {
               $hex = hexdec($hex);
            // Parse hex to RGB
            $r = ($hex >> 16) & 0xFF;
            $g = ($hex >> 8) & 0xFF;
            $b = $hex & 0xFF;

            // Increase each RGB component
            $r = min(255, $r + $amount);
            $g = min(255, $g + $amount);
            $b = min(255, $b + $amount);

            // Convert RGB to hex
            return dechex(($r << 16) | ($g << 8) | $b);
            }
    }
 @endphp

@foreach($colors as $color)
    .sys_{{ ($color->color_name) }} {
    background-color: #{{ $color->color_bg_hex }};
    color: #{{ $color->color_txt_hex }};
    }

    .alert_sys_{{ ($color->color_name) }} {
    background-color: #{{ lightenColor($color->color_bg_hex, 78) }};
    border-color: #{{ $color->color_bg_hex }};
    border-width: 3px;
    border-style: solid;
    color: #{{ $color->color_txt_hex }};
    }
@endforeach
