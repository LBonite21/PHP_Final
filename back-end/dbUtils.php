<?php

function sanitizeInput($input) {
    $sanInput = preg_replace("(;|DELIMITER)", "", $input);
    return $sanInput;
}


?>