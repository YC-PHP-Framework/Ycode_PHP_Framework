<?php

namespace Yc\framework;


use Yc\App\Services\SubstractionOpService;
use Yc\App\Services\CalculServiceInterface;

abstract class ContainerWriter
{
    protected array $entries;

    public function __construct()
    {
        // Don't Forget to import All The Classes
        $this->entries = [
            CalculServiceInterface::class => SubstractionOpService::class,

        ];
    }
}
