<?php

namespace KeapGeek\Keap\Mock\Services;

class Setting
{
    public function status()
    {
        return true;
    }

    public function config()
    {
        return [
            'affiliate' => [],
            'appointment' => [],
            'application' => [],
            'contact' => [],
            'ecommerce' => [],
            'email' => [],
            'forms' => [],
            'fulfillment' => [],
            'invoice' => [],
            'note' => [],
            'opportunity' => [],
            'task' => [],
            'template' => [],
        ];
    }
}
