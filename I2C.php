<?php

include_once 'Gate.php';


class I2C extends Gate
{
    private $bus = 0;

    public function iGet($dev, $addr, $key = 'b'){

        $this->execCommand("i2cget -y $this->bus 0x$dev 0x$addr $key;");
        $this->bufer = str_replace("0x", "", $this->bufer);

    }

    public function iSet($dev, $addr, $val){

        $this->execCommand("i2cset -y $this->bus 0x$dev 0x$addr 0x$val; i2cget -y $this->bus 0x$dev 0x$addr");

    }

}