<?php
    if (!function_exists('getRandomOrderSeed')) {
        /**
         * Get or set a random seed for ordering queries
         *
         * @param string $key The session key to use for the seed
         * @return int The seed value
         */
        function getRandomOrderSeed($key = 'table_order')
        {
            if (!session()->has($key)) {
                session()->put($key, rand(0, 999999));
            }
            return session($key);
        }
    }
