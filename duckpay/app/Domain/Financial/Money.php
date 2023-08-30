<?php

namespace App\Domain\Financial;

class Money
{
    private string $amount;
    private int $scale;
    public function __construct(string $valor, int $scale = 2)
    {
        $this->scale = $scale;
        $this->setAmount($valor);
    }
    private function  setAmount(string $data): void {
        if(preg_match('/(\d)\,(\d{3})\.(\d{2})/',$data)){
            $data = str_replace(',','',$data);
        }
        if(preg_match('/(\d)\,(\d{1,2})/',$data)){
            $data = str_replace(['.',','],['','.'],$data);
        }
        $data = filter_var($data,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
        $this->amount = number_format($data, $this->scale,'.','');
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->amount;
    }
    public function add(string $money): self
    {
        $add = new Money($money);
        $this->setAmount(bcadd($this->amount, $add->value(), $this->scale));
        return $this;
    }
    public function sub(string $money): self
    {
        $add = new Money($money);
        $this->setAmount(bcsub($this->amount, $add->value(), $this->scale));
        return $this;
    }
}
