<?php

if(!function_exists('lang')){
    function lang(){
        return request()->header('lang','ar');
    }
}