<?php

use Orca\Tasks;
use Orca\DB;

header("Content-Type:application/json");

$db=DB::connect();
$task=new Tasks($db);

$data = $task->fetchReplies();

echo json_encode($data);