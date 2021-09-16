<?php

use Orca\DB;
use Orca\Tasks;
use Orca\Validation;

$connection = DB::connect();
$vali = Validation::validation($_POST);

    if (empty(implode("", $vali))) {
        $task = new Tasks($connection);
        $task->create($_POST);
    } else {
        $error = [];
        foreach ($vali as $key => $err) {
            $error[$key] = $err;
        }
        echo json_encode($error);
    }