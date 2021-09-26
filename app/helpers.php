<?php

use App\Models\Commentator;

if (!function_exists('getBestCommentators')) {
    function getBestCommentators($com)
    {
        $com = Commentator::all()->sortBy('desc', 'merci');
    }
}
