<?php

use Orca\DB;
use Orca\Tasks;
use Orca\Validation;

$connection = DB::connect();
$vali = Validation::validationReply($_POST);

    if (empty(implode("", $vali))) {
        $task = new Tasks($connection);
        $task->createReply($_POST);
    } else {
        $error = [];
        foreach ($vali as $key => $err) {
            $error[$key] = $err;
        }
        echo json_encode($error);
    }