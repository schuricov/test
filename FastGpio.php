<?php
class FastGpio
{

//    const LOGFILE          = 'IO.LOG';
//    const FASTGPIO         = 'fast-gpio';
//    const EXP_LED          = 'expled %s>/dev/null';
//    const EXP_RELAY_INIT   = 'relay-exp -s %s -i';
//    const EXP_RELAY_SET    = 'relay-exp -s %s %s %u';


//    const ALLOWGPIO = [0,44,45,46]; // Omega omion2+
    const ALLGPIO = ['GND',11,3,2,17,16,15,46,45,9,8,7,6,1,0,'RST','GND','VIN','D+','D-','13','12','38','VOUT','TX-','TX+','RX-','RX+','18','19','4','5']; // Omega omion2+
    const ALLOWGPIO = [0,1,2,3,4,5,6,7,8,9,11,12,13,15,16,17,18,19,38,44,45,46]; // Omega omion2+ (44pin - led)
    public $bufer = [];


    public function getValue($gpio){

        $this->execCommand("fast-gpio -u read {$gpio}");

    }

    public function setValue($gpio, $value){

        $this->execCommand("fast-gpio -u set {$gpio} {$value}");

    }

    public function getDirecton($gpio){

        $this->execCommand("fast-gpio -u get-direction {$gpio}");

    }

    public function setDirecton($gpio, $dir){

        switch ($dir) {

            case 1: $dir = 'input';     break;
            case 0: $dir = 'output';    break;
        }

        $this->execCommand("fast-gpio -u set-{$dir} {$gpio}");

    }

    public function setPwm($gpio, $freq, $duty){

        // что бы программа не уходила в бесконечное ожидание направляем вывод > /dev/null &
        // при ключе -u не нужно
        $this->execCommand("fast-gpio -u pwm {$gpio} {$freq} {$duty}");

    }

    public function getAll(){

        foreach (self::ALLOWGPIO as $gpio){

            $this->getValue($gpio);
            $this->getDirecton($gpio);
        }

    }

    public function send(){

//        echo print_r($this->bufer);

        print(json_encode($this->bufer));

    }

    public function execCommand($command){

//        $answer = "{\"cmd\":\"Read\", \"pin\":44, \"val\":\"1\"}";
//        $answer = exec($command);
        $answer = json_decode(exec($command), true);

        array_push($this->bufer, $answer);

        return true;
    }

    public function log(){

        $function = debug_backtrace();
        $function = $function[2]['function'];

        echo "---------------------LOG---------------------\n";
        echo 'function: '.$function."\n";
        echo 'command:  '.$this->command."\n";
        echo 'answer:   '.$this->answer."\n";
        echo 'result:   '.print_r($this->result, 1)."\n";
        echo "---------------------------------------------\n";


    }

}