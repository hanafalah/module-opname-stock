<?php

namespace Gii\ModuleOpnameStock\Enums\OpnameStock;

enum Status: string{
    case DRAFT      = 'DRAFT';
    case REPORTED   = 'REPORTED';
    case CANCELLED  = 'CANCELLED';
}
