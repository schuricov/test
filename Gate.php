<?php

class Gate
{
    public $bufer = [];
    public $command;

    public function output(){

//        echo print_r($this->bufer, 1);
        print(json_encode($this->bufer));
        $this->bufer = [];
    }

    public function execCommand($command){

        $this->command = $command;

//        $answer = "{\"cmd\":\"Read\", \"pin\":44, \"val\":\"1\"}";
        $answer = exec($command);

        if ($answer == ''){

            $this->bufer = ['Answer' => 'Probably no device connection'];
            $this->log();
            exit();
        };

        if ($decoded = json_decode($answer, true)){

            array_push($this->bufer, $decoded);
        } else {

            array_push($this->bufer, $answer);
        };


        return true;
    }

    public function log(){

        echo "---------------------LOG---------------------\n";
//        echo 'debug:   ' . print_r(debug_backtrace(), 1) . "\n";
        echo 'command:  ' . $this->command . "\n";
        echo 'result:   ' . print_r($this->bufer, 1) . "\n";
        echo "---------------------------------------------\n";

        $this->bufer = [];
    }

    function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

}