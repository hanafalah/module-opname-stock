<?php

namespace Gii\ModuleOpnameStock\Providers;

use Illuminate\Support\ServiceProvider;
use Gii\ModuleOpnameStock\Commands;

class CommandServiceProvider extends ServiceProvider
{
    protected $__commands = [
        
    ];

    public function register(){
        $this->commands(config('module-opname-stock.commands',$this->__commands));
    }

    public function provides(){
        return $this->__commands;
    }
}
