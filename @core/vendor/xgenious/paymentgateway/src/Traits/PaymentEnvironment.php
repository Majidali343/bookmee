<?php

namespace Xgenious\Paymentgateway\Traits;

trait PaymentEnvironment
{
    protected $env;

    /* set environment : true or false */
    public function setEnv($env){
        $this->env = $env;
        return $this;
    }
    /* get environment: true or false */
    private function getEnv(){
        return $this->env;
    }
}
