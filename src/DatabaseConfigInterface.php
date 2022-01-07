<?php

namespace Amaur\PhpPdoSingleton;

interface DatabaseConfigInterface {

    public function getConfig(): array;
}