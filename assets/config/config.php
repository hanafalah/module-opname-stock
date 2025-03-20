<?php

use App\Models\User;
use Gii\ModuleOpnameStock\{
    Models as ModuleOpname,
    Commands as ModuleOpnameCommand
};
use Zahzah\ModuleWarehouse\Models\Building\Room;

return [
    'commands' => [
        ModuleOpnameCommand\InstallMakeCommand::class
    ],
    'database' => [
        'models' => [
            'OpnameStock' => ModuleOpname\OpnameStock::class,
        ]
    ],
    'author'    => \App\Models\User::class,
    'warehouse' => Room::class
];
