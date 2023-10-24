<?php

//shell_exec('php artisan make:controller ExemploController');

$file = file_get_contents(__DIR__ . '/../arquivoDeEntrada1.txt');

$x = explode('};', $file);

echo "<br><br>";
var_dump($x);
