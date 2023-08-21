<?php
namespace Yc\App\Service;


class SayService {

    public function say(string $name){
        return "Hi {$name}" . " From ". __CLASS__;
    }
}