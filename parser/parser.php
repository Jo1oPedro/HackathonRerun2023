<?php

require __DIR__ . "/../commandFactorys/StructureCommandFactory.php";

use commandFactorys\StructureCommandFactory;

$classes = ['Pessoa', 'Turma', 'Escola'];
$factory = new StructureCommandFactory();

foreach($classes as $class) {
    $factory->setName($class)->setController()->setModel()->executeCommand();
}

/*$pessoa = new stdClass();
$pessoa->name = "Pessoa";
//$pessoa->type = "class"
//$pessoa->extenmds = false || Tenta ver se é possível separar as que extendem das que não extendem
$pessoaAtributos = new stdClass();
$pessoaAtributos1->struct = false;
$pessoaAtributos1->type = "string";
$pessoaAtributos1->value = "nome";

$pessoaAtributos1->struct = false;
$pessoaAtributos1->type = "string";
$pessoaAtributos1->value = "nome";

$pessoaAtributos1->struct = false;
$pessoaAtributos1->type = "string";
$pessoaAtributos1->value = "nome";

$pessoa->atributos = [$pessoaAtributos]

foreach($metamodelos as $classesMetamodelo) {
    foreach($classesMetamodelo as $classMetamodelo) {

    }
}*/
