<?php
function cleanInputs($var)
{
    $data = trim($var);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);

    return $data;
}

