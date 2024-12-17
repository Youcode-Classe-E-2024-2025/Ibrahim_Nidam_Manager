<?php
    function slug($tablename) {
        $random_number = mt_rand(1000000, 91000000);
        $milliseconds = round(microtime(true) * 1000);
        return $tablename . "-" . $random_number . "-" . $milliseconds;
    }
    
