<?php
// /lib/utils.php

function fixDb($val){
    return '"'.addslashes($val).'"';
}