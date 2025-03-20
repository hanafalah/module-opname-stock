<?php

use App\Models\User;
use Hanafalah\ModuleOpnameStock\{
    Models as ModuleOpname,
    Commands as ModuleOpnameCommand
};
use Hanafalah\ModuleWarehouse\Models\Building\Room;

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
