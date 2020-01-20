<?php

class Autoload {
    public function loadClass($className) {
        include str_replace('\\','/',"../{$className}.php");
    }
}