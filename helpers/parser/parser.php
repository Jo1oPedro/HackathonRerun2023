<?php
namespace helpers\parser\parser;

require __DIR__ . '/../../vendor/autoload.php';

use helpers\fileHelpers\FileCreator;
use helpers\parser\ClassParser;

ClassParser::createFile('/../../arquivosDeEntrada/arquivoDeEntrada1.txt');
shell_exec("php artisan migrate:fresh");
