<?php
namespace App\Classes;

use JsonSerializable;

class Statistics implements JsonSerializable{

    private $date;
    private $count;

    public function __construct($date,$count)
    {
        $this->date = $date;
        $this->count = $count;
    }

    public function jsonSerialize () {
        return array(
            'date'=>$this->date,
            'count'=>$this->count
        );
    }


    public function getDate(){
        return $this->date;
    }

    public function getCount(){
        return $this->count;
    }

}