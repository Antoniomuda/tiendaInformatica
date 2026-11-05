<?php

/*
 * Description of PintarEstrellas
 *
 * @author murillodavilaantonio
 */

namespace App;

class PintarEstrellas {

   public static function render(float $media): string {
    if ($media == 0) return 'Sin valorar';
    $html = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($media >= $i) {
            $html .= '<i class="bi bi-star-fill text-warning"></i>';
        } elseif ($media >= $i - 0.5) {
            $html .= '<i class="bi bi-star-half text-warning"></i>';
        } else {
            $html .= '<i class="bi bi-star text-warning"></i>';
        }
    }
    return $html;
}
}
