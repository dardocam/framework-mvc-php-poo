<?php

namespace app\core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'];
        $path = ($path == Application::getROOTDIR())
            ? '/' :
            str_replace(Application::getROOTDIR(), "", '/' . $path);
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }

        return substr($path, 0, $position);
    }
    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
