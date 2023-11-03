<?php

namespace App\Application\Financial;

class FinancialtransferDTO
{
    public int $id;
    public string $amount;
    public string $payeer;
    public string $payee;
    public string $date;
    public function __construct($id, $amount, $payeer, $payee, $date){
            $this->id = $id;
            $this->amount = $amount;
            $this->payeer = $payeer;
            $this->payee = $payee;
    }
}
