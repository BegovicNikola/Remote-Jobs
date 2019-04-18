<?php
    
    function jsname(){
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        $filename = explode('/', $path)[2];
        
        return $filename;
    }