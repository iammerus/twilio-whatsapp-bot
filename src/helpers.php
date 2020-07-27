<?php

if(!function_exists('array_find')) {
    function array_find($xs, $f) {
        foreach ($xs as $x) {
            if (call_user_func($f, $x) === true) {
                return $x;
            }
        }
        return null;
    }
}