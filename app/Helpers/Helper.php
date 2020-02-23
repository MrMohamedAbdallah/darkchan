<?php

if(!function_exists("activeLink")){
    
    function activeLink(String $link){

        if(request()->is($link)){
            return "active";
        }

    }

}