<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 17.11.18
 * Time: 22:23
 */

class I2C
{
    public $bufer = [];

    public function getValue($gpio = null){

        $this->execCommand("i2cget -y 0 0x68 0x00");
        echo print_r($this->bufer, 1);

    }

    public function setValue($gpio, $value){

        $this->execCommand("i2cget -y 0 0x68 0x00");

    }

    public function execCommand($command){

        $answer = json_decode(exec($command), true);

        array_push($this->bufer, $answer);

        return true;
    }

    public function send(){

//        echo print_r($this->bufer);

        print(json_encode($this->bufer));

    }


}