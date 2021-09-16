<?php 

$router->define([
    '/' => 'controllers/home.php',
    '/api' => 'controllers/api.php',
    '/comment' => 'controllers/comment.php',
    '/reply' => 'controllers/reply.php',
    '/repliesapi' => 'controllers/repliesapi.php',
]);