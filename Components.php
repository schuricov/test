<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 18.11.18
 * Time: 14:51
 */

require_once 'I2C.php';

class Components
{
    const CLOCK =   '68';   // Device address 0x68
    const SEC =     '00';   // Address of seconds
    const MIN =     '01';   // Address of minutes
    const HOUR =    '02';   // Address of hours

    const LIGHT =   '23';   // Device address 0x23
    const LM =      '20';   // Address of lumen


    private $i2c;

    public function __construct()
    {
        $this->i2c = new I2C();
    }

    public function getTime()
    {
        // устанавливать дату через BASH ???
        $this->i2c->iGet(self::CLOCK, self::HOUR);
        $this->i2c->iGet(self::CLOCK, self::MIN);
        $this->i2c->iGet(self::CLOCK, self::SEC);

        $regs = $this->i2c->bufer;
        $time = [];
        foreach ($regs as $val){
            array_push($time, $val);
        }
        $time = implode(":", $time);
        $this->i2c->bufer = $time;

        $this->i2c->log();
    }

    public function setTime()
    {

    }

    public function getLm()
    {
        $this->i2c->iGet(self::LIGHT, self::LM, 'w');
        $row = $this->i2c->bufer[0];
        $row = hexdec($row);
        $this->i2c->bufer = $row * 0.01;

        $this->i2c->log();
    }

    public function getHumidity()
    {

    }
}

$component = new Components();
$component->getTime();
$component->getLm();