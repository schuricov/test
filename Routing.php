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
    private $i2c;

    public function __construct()
    {
        $this->fastGpio = new FastGpio();
        $this->i2c = new I2C();
    }

    public function init()
    {

        $data = key(array_slice($_GET, 0));
//        echo 'case -> ' . print_r($data, 1)."\n";
//        echo 'GET -> '."\n".print_r($_GET, 1)."\n";
//        echo 'POST -> '."\n".print_r($_POST, 1)."\n";

        switch ($data) {

            case 'iget':
                $this->i2c->iGet($_GET['dev'], $_GET['addr']);
                $this->i2c->output();
                break;

            case 'iset':
                $this->i2c->iSet($_GET['dev'], $_GET['addr'], $_GET['val']);
                $this->i2c->output();
                break;

            case 'get':
                $this->fastGpio->getValue($_GET['gpio'], $_GET['get']);
                $this->fastGpio->output();
                break;

            case 'set':
                $this->fastGpio->setValue($_GET['gpio'], $_GET['set']);
                $this->fastGpio->output();
                break;

            case 'getdir':
                $this->fastGpio->getDirecton($_GET['gpio'], $_GET['getdir']);
                $this->fastGpio->output();
                break;

            case 'setdir':
                $this->fastGpio->setDirecton($_GET['gpio'], $_GET['setdir']);
                $this->fastGpio->output();
                break;

            case 'pwm':
                $this->fastGpio->setPwm($_GET['gpio'], $_GET['freq'], $_GET['duty']);
                $this->fastGpio->output();
                break;

            case 'getall':
                $this->fastGpio->getAll();
                $this->fastGpio->output();
                break;

        }

    }

}

// for js ajax
$init = new Routing();
$init->init();