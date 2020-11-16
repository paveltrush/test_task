<?php
if (!function_exists('code')) {
    function code(int $length = 10)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
    }
}
