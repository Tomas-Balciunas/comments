<?php 

namespace Orca;

class Request {
    public static function uri() {
        return str_replace("/orca","",trim($_SERVER['REQUEST_URI']));
    }
}