<?php


function controller_autocargar($className){
    include "controllers/".$className.".php";
}


spl_autoload_register("controller_autocargar");