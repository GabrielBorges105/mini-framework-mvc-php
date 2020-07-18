<?php
    //serve para debugarmos nossa uri e verificar o method
    function dd($params = [], $die = true)
    {
        echo '<pre>';
        print_r($params);
        echo '</pre>';
        if($die) die();  
    }
?>