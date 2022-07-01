<?php

function connect(){
    $bd = mysqli_connect('localhost', 'root', '', 'miniprojet');
    return $bd;
}
?>