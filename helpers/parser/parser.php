<?php
namespace helpers\parser\parser;

require __DIR__ . '/../../vendor/autoload.php';

use helpers\fileHelpers\FileCreator;
use helpers\parser\ClassParser;

$r = ClassParser::createFile('/../../arquivosDeEntrada/arquivoDeEntrada2.txt');
var_dump($r);