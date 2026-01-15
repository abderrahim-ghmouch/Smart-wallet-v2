<?php

class expense extends transfer
{

    public function __construct($amount=0,$description="",$date="",$category=0)
    {
        parent::__construct($amount,$description,$date,$category);
    }



}