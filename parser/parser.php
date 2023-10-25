<?php

namespace parser\parser;

require __DIR__ . '/../vendor/autoload.php';

//use helpers\commandFactorys\StructureCommandFactory;
use helpers\fileHelpers\FileCreator;
use helpers\fileHelpers\FileWriter;

$lines = file(__DIR__ . '/../arquivosDeEntrada/arquivoDeEntrada2.txt', FILE_IGNORE_NEW_LINES);

$classes = [];
$classesWithExtends = [];
$structs = [];
$insideClassOrStruct = false;
$extendsAux = false;

foreach ($lines as $line) {
    $words = str_word_count($line, 1);
    foreach ($words as $key => $word) {
        if($word === "extends") {
            $extendsAux = $words[$key + 1];
            break;
        }
    }
    if (preg_match('/^(struct|class|Class) (\w+)/', $line, $matches)) {
        $type = $matches[1];
        $name = $matches[2];
        $objectName = $name;
        if ($type === 'struct') {
            $objectType = 'struct';
            $insideClassOrStruct = true;
        } elseif ($type === 'class' || $type === 'Class') {
            $objectType = 'class';
            $insideClassOrStruct = true;
        }
    } elseif ($insideClassOrStruct) {
        if (strpos($line, '}') !== false) {
            $object = new \stdClass();
            $object->name = $objectName;
            $object->type = $objectType;
            $object->extends = $extendsAux;
            $atributosObj = [];
            foreach($attributes as $attr) {
                $words = str_word_count($attr, 1);
                $atributo = new \stdClass();
                if(count($words) === 4) {
                    $atributo->struct = true;
                    $atributo->type = $words[2];
                    $atributo->value = $words[3];
                }else if(count($words) === 2) {
                    $atributo->struct = false;
                    $atributo->type = $words[0];
                    $atributo->value = $words[1];
                }else {
                    $atributo->struct = false;
                    $atributo->type = $words[1];
                    $atributo->value = $words[2];
                }
                $atributosObj[] = $atributo;
            }
            $object->atributos = $atributosObj;
            if(isset($object->type)) {
                if($object->type === 'struct') {
                    $structs[$object->name] = $object;
                }else if($object->type === 'class') {
                    if($object->extends) {
                        $classesWithExtends[$object->name] = $object;
                    } else {
                        $classes[$object->name] = $object;
                    }
                }
            }
            $attributes = array();
            $extendsAux = false;
            $insideClassOrStruct = false;
        } else if(strpos($line, '{') === false){
            $attributeLine = trim($line, " \t;");
            if (!empty($attributeLine)) {
                $attributes[] = $attributeLine;
            }
        }
    }
}

foreach($classes as $class) {
    FileCreator::getInstance()
        ->setName($class->name)
        ->setAttributes($class->atributos)
        ->createController()
        ->createModel()
        ->createMigration();
}
