<?php

use App\Models\Groups;

function isUpperCase($value, $messenge, $fail){
    if($value != mb_strtoupper($value, 'UTF-8')){
        $fail($messenge);
    }
}

function getAllGroups(){
    $groups = new Groups;

    return $groups->getAll();
}