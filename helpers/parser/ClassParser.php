<?php
namespace helpers\parser;

use helpers\fileHelpers\FileCreator;

class ClassParser
{

    private static $classes;
    private static $structs;
    private static $classesWithExtends;
    private function __construct() {
        $this->classes = [];
        $this->structs = [];
        $this->classesWithExtends = [];
    }

    public static function parseAttributes($attributes)
    {
        $atributosObj = [];
        foreach ($attributes as $attr) {
            $words = explode(" ", $attr);
            $atributo = new \stdClass();

            if (count($words) === 4) {
                $atributo->struct = true;
                $atributo->type = $words[2];
                $atributo->value = $words[3];
            } else if (count($words) === 2) {
                $atributo->struct = false;
                $atributo->type = $words[0];
                $atributo->value = $words[1];
            } else {
                $atributo->struct = false;
                $atributo->type = $words[1];
                $atributo->value = $words[2];
            }

            $atributosObj[] = $atributo;
        }
        return $atributosObj;
    }
    public static function parseFile($file)
    {
        $lines = file(__DIR__ . $file, FILE_IGNORE_NEW_LINES);

        $insideClassOrStruct = false;
        $extendsAux = false;
        $attributes = [];
        $objectName = '';
        $objectType = '';

        foreach ($lines as $line) {
            $words = str_word_count($line, 1);
            foreach ($words as $key => $word) {
                if ($word === "extends") {
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
                    $object->atributos = self::parseAttributes($attributes);
                    if (isset($object->type)) {
                        if ($object->type === 'struct') {
                            self::$structs[$object->name] = $object;
                        } else if ($object->type === 'class') {
                            if($object->extends) {
                                self::$classesWithExtends[$object->name] = $object;
                            }
                            self::$classes[$object->name] = $object;
                        }
                    }
                    $attributes = [];
                    $extendsAux = false;
                    $insideClassOrStruct = false;
                } else if (strpos($line, '{') === false) {
                    $attributeLine = trim($line, " \t;");
                    if (!empty($attributeLine)) {
                        $attributes[] = $attributeLine;
                    }
                }
            }
        }
    }
    public static function createFile($file) {
        self::parseFile($file);
        //$allClasses = array_merge(self::$classes, self::$classesWithExtends, self::$structs);

        foreach(self::$structs as $struct) {
            $content = FileCreator::getInstance()
                ->setName($struct->name)
                ->setAttributes($struct->atributos)
                ->getMigrationFields();

            FileCreator::getInstance()
                ->setName($struct->name)
                ->setAttributes($struct->atributos)
                ->createMigration($content);
        }

        $migrationAttr = [];
        foreach (self::$classes as $class) {
            $content = FileCreator::getInstance()
                ->setName($class->name)
                ->setAttributes($class->atributos)
                ->getMigrationFields();
            $migrationAttr[strtolower($class->name)] = $content;
        }

        $migrationRelationships = FileCreator::getInstance()
        ->createMigrationRelationships(self::$classes);
        foreach(self::$classes as $class) {
            $content = $migrationAttr[strtolower($class->name)];
            if(isset($migrationRelationships[strtolower($class->name)])) {
                $content .=  $migrationRelationships[strtolower($class->name)];
            }
            FileCreator::getInstance()
                ->setName($class->name)
                ->setAttributes($class->atributos)
                ->createMigration($content)
                ->createController()
                ->createModelWithRelations($class->extends ?? "", self::$classes);
        }

        FileCreator::finalizeModelCreation();
    }
}
