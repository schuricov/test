<?php
//echo "File: " .  __FILE__ . "\n";
//echo "Get: \n";
//echo print_r($_GET) . "\n";
require_once 'FastGpio.php';
require_once 'I2C.php';

class Routing
//class Routing extends FastGpio
{
    private $fastGpio;
    private $I2c;

    public function __construct()
    {
        $this->fastGpio = new FastGpio();
        $this->I2c = new I2C();
    }

    public function init()
    {

        $data = key(array_slice($_GET, 0));
//        echo 'case -> ' . print_r($data, 1)."\n";
//        echo 'GET -> '."\n".print_r($_GET, 1)."\n";
//        echo 'POST -> '."\n".print_r($_POST, 1)."\n";

        switch ($data) {

            case 'i2cget':
                $this->fastGpio->getValue($_GET['i2cget']);
                $this->fastGpio->send();
                break;

            case 'get':
                $this->fastGpio->getValue($_GET['gpio'], $_GET['get']);
                $this->fastGpio->send();
                break;

            case 'set':
                $this->fastGpio->setValue($_GET['gpio'], $_GET['set']);
                $this->fastGpio->send();
                break;

            case 'getdir':
                $this->fastGpio->getDirecton($_GET['gpio'], $_GET['getdir']);
                $this->fastGpio->send();
                break;

            case 'setdir':
                $this->fastGpio->setDirecton($_GET['gpio'], $_GET['setdir']);
                $this->fastGpio->send();
                break;

            case 'pwm':
                $this->fastGpio->setPwm($_GET['gpio'], $_GET['freq'], $_GET['duty']);
                $this->fastGpio->send();
                break;

            case 'getall':
                $this->fastGpio->getAll();
                $this->fastGpio->send();
                break;

        }

    }

}

// for js ajax
$init = new Routing();
$init->init();