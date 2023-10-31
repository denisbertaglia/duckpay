<?php

namespace App\Application\Financial;

class FinancialtransferDTO
{
    public int $id;
    public string $amount;
    public int $payeer;
    public int $payee;
}
