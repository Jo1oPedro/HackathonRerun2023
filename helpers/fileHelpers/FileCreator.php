<?php

namespace helpers\fileHelpers;

class FileCreator
{
    private string $name = "";
    private ?array $attributes = null;
    private string $lowerName;
    private string $ucFirstName;
    private array $controllerContentTemplate = [
        "{model}",
        "{controllerName}",
        //"{attributes}",
        "{methodParameter}",
        "{indexContent}",
        "{createContent}",
        "{storeContent}",
        "{showContent}",
        "{editContent}",
        "{updateContent}",
        "{destroyContent}"
    ];

    private array $modelContentTemplate = [
        "{modelName}",
        "{content}"
    ];

    private array $migrationContentTemplate = [
        "{migrationName}",
        "{tableContent}"
    ];

    private static ?FileCreator $fileCreator = null;
    private function __construct()
    {
    }

    public static function getInstance(): FileCreator
    {
        if (is_null(self::$fileCreator)) {
            self::$fileCreator = new FileCreator();
        }
        return self::$fileCreator;
    }

    public function setName(string $name): FileCreator
    {
        $this->name = $name;
        $this->lowerName = strtolower($name);
        $this->ucFirstName = ucfirst($name);
        return $this;
    }

    public function setAttributes(array $attributes): FileCreator
    {
        $this->attributes = $attributes;
        return $this;
    }
    public function createController(): FileCreator
    {
        if (empty($this->name)) {
            throw new \InvalidArgumentException('Não é possível criar o controller sem um nome');
        }
        if (is_null($this->attributes)) {
            throw new \InvalidArgumentException('Não é possível criar o controller sem os atributos');
        }

        $controllerContent = file_get_contents(__DIR__ . "/templates/controllerTemplate.txt");
        $controllerContent = str_replace(
            $this->controllerContentTemplate,
            [
                $this->ucFirstName,
                $this->ucFirstName,
                //$this->getAttributes(),
                $this->ucFirstName . " $" . $this->lowerName,
                $this->getIndexContent(),
                $this->getCreateContent(),
                $this->getStoreContent(),
                $this->getShowContent(),
                $this->getEditContent(),
                $this->getUpdateContent(),
                $this->getDestroyContent(),
            ],
            $controllerContent
        );
        file_put_contents(__DIR__ . "/../../app/Http/Controllers/" . $this->ucFirstName . "Controller.php", $controllerContent);
        FileWriter::getInstance()->writeRoute($this->name);
        return $this;
    }

    private function getIndexContent(): string
    {
        return '$' . $this->lowerName . "= " . $this->ucFirstName . "::all();\n\t\treturn view('{$this->lowerName}s.index');";
    }

    private function getCreateContent(): string
    {
        return "view('{$this->lowerName}s.create');";
    }

    private function getStoreContent(): string
    {
        return '$' . "data = " . '$' . "request->all();\n\t\t{$this->ucFirstName}::create(" . '$' . "data);\n\t\treturn redirect()->route('{$this->lowerName}s.index')->with('sucess', true);";
    }

    private function getShowContent(): string
    {
        return "view('{$this->lowerName}s.show');";
    }

    private function getEditContent(): string
    {
        return "view('{$this->lowerName}s.edit', compact('{$this->lowerName}'));";
    }

    private function getUpdateContent(): string
    {
        return '$' . "data = " . '$' . "request->all();\n\t\t" . '$' . "{$this->lowerName}->update(" . '$' . "data);\n\t\treturn redirect()->route('{$this->lowerName}s.index')->with('sucess', true);";
    }

    private function getDestroyContent(): string
    {
        return '$' . "{$this->lowerName}->delete();\n\t\treturn redirect()->route('{$this->lowerName}s.index')->with('sucess', true);";
    }

    private function getControllerAttributes(): string
    {
        $content = "";
        foreach ($this->attributes as $attribute) {
            $content .= match ($attribute->type) {
                'string' => '$' . "table->string('{$attribute->value}', 191);\n\t\t",
                "int" => '$' . "table->integer('{$attribute->value}');\n\t\t",
                "float" => '$' . "table->float('{$attribute->value}, 8, 2');\n\t\t",
            };
        }
        return $content;
    }

    public function createModel()
    {
        if (empty($this->name)) {
            throw new \InvalidArgumentException('Não é possível criar o controller sem um nome');
        }

        $modelContent = file_get_contents(__DIR__ . "/templates/modelTemplate.txt");
        $modelContent = str_replace(
            $this->modelContentTemplate,
            [
                $this->ucFirstName,
            ],
            $modelContent
        );
        file_put_contents(__DIR__ . "/../../app/Models/" . $this->ucFirstName . ".php", $modelContent);
        return $this;
    }

    public function createModelWithRelations(string $relation, array $classes): FileCreator
    {
        if (empty($this->name)) {
            throw new \InvalidArgumentException('Não é possível criar o controller sem um nome');
        }

        if (empty($relation)) {
            $relationContent = $this->generateRelation(false);
        } else {
            $relationContent = $this->generateRelation(true, $relation);
        }


        $modelContent = file_get_contents(__DIR__ . "/templates/modelTemplate.txt");
        $modelContent = str_replace(
            $this->modelContentTemplate,
            [
                $this->ucFirstName,
                $relationContent
            ],
            $modelContent
        );
        file_put_contents(__DIR__ . "/../../app/Models/" . $this->ucFirstName . ".php", $modelContent);
        return $this;
    }

    public static function finalizeModelCreation()
    {
        $files =  scandir(__DIR__ . "/../../app/Models");
        $i = 0;

        foreach ($files as $file) {
            if ($i < 2) {
                $i++;
                continue;
            }
            file_put_contents(__DIR__ . "/../../app/Models/" . $file, "}", FILE_APPEND);
        }
    }

    public function createMigration()
    {
        if (empty($this->name)) {
            throw new \InvalidArgumentException('Não é possível criar o controller sem um nome');
        }

        $migrationContent = file_get_contents(__DIR__ . "/templates/migrationTemplate.txt");
        $migrationContent = str_replace(
            $this->migrationContentTemplate,
            [
                "{$this->lowerName}s",
                $this->getMigrationFields()
            ],
            $migrationContent
        );
        file_put_contents(__DIR__ . "/../../database/migrations/" . date("Y_m_d_His") .  "_create_{$this->lowerName}s_table.php", $migrationContent);
        //shell_exec("php artisan migrate:fresh");
        return $this;
    }

    private function getMigrationFields(): string
    {
        $content = "";
        foreach ($this->attributes as $attribute) {
            $content .= match ($attribute->type) {
                'string' => '$' . "table->string('{$attribute->value}', 191);\n\t\t",
                "int" => '$' . "table->integer('{$attribute->value}');\n\t\t",
                "float" => '$' . "table->float('{$attribute->value}, 8, 2');\n\t\t",
                default => ""
            };
        }
        return $content;
    }

    private function textRelation(string $class, bool $extends): string
    {
        return "\tpublic function " . strtolower($class) . "()\n\t{\n\t\t" . $this->getRelation($class, $extends) . "\n\t}\n";
    }

    private function generateRelation(bool $extends, string $class = ""): string
    {
        $text = "";
        if ($extends) {
            $content = $this->textRelation($this->name, false);
            file_put_contents(__DIR__ . "/../../app/Models/" . $class . ".php", $content, FILE_APPEND);
            $text = $this->textRelation($class, true);
        }

        foreach ($this->attributes as $attribute) {
            if ($attribute->struct) {
                $text .= $this->textRelation($attribute->type, false);
            }
        }

        return $text;
    }

    private function getRelation(string $class, bool $extends): string
    {
        if ($extends) {
            return 'return $this->belongsTo(' . ucfirst($class) . '::class);';
        }

        return 'return $this->hasOne(' . ucfirst($class) . '::class);';
    }

    private function getMigrationRelationships(): string
    {
        $content = "";
        foreach ($this->attributes as $attribute) {
            if (!in_array($attribute->type, ['string', 'int', 'float'])) {
                $tableName = strtolower($attribute->value);
                $foreigngName = $tableName . "_id";
                $content .= '$' . "table->unsignedBigInteger('{$foreigngName}');\n\t\t";
                $content .= '$' . "table->foreign('{$foreigngName}')->references('id')->on('{$tableName}')->onDelete('cascade');\n\t\t";
            }
        }
        return $content;
    }

    private function verifyRelationshipsManyToMany($classes, $classAux, $nameClass)
    {
        if (substr($nameClass, -1) === 's') {
            $nameClass = rtrim($nameClass, 's');
        }
        foreach ($classes as $class) {
            if ($class->name == $nameClass) {
                foreach ($class->atributos as $atributo) {
                    if (!in_array($atributo->type, ['string', 'int', 'float']) && strpos($atributo->type, 'list') !== false && strpos($atributo->type, $classAux->name) !== false) {
                        return $class;
                    }
                }
            }
        }
        return false;
    }

    public function createMigrationRelationships($classes): string
    {
        $content = "";
        $migrateRelationships = [];
        foreach ($classes as $class) {
            foreach ($class->atributos as $atributo) {
                if (!in_array($atributo->type, ['string', 'int', 'float'])) {
                    $tableName = strtolower($atributo->value);
                    $foreigngName = $tableName . "_id";
                    if (strpos($atributo->type, 'list') !== false) {
                        $manyToMany = $this->verifyRelationshipsManyToMany($classes, $class, ucfirst($atributo->value));
                        if ($manyToMany !== false) {
                            //$this->createTablePivot();
                            $tableName = (string)$class->name . "_" . $manyToMany->name;
                            $foreigngName = $tableName . "_id";
                            $content .= (string)$class->name . "\n\t\t";
                            $content .= "MANYTOMANY" . "\n\t\t";
                            continue;
                        }
                        //$content .= ucfirst($tableName) . "\n\t\t";
                        $tableName = $class->name;
                        $foreigngName = $tableName . "_id";
                        $content .= '$' . "table->unsignedBigInteger('{$foreigngName}');\n\t\t";
                        $content .= '$' . "table->foreign('{$foreigngName}')->references('id')->on('{$tableName}')->onDelete('cascade');\n\t\t";
                        $migrateRelationships[$tableName][] = $content;
                        continue;
                    }
                    //$content .= $class->name . "\n\t\t";
                    $content .= '$' . "table->unsignedBigInteger('{$foreigngName}');\n\t\t";
                    $content .= '$' . "table->foreign('{$foreigngName}')->references('id')->on('{$tableName}')->onDelete('cascade');\n\t\t";
                    $migrateRelationships[$class->name][] = $content;
                    continue;
                }
                $content = "";
            }
        }
        var_dump($migrateRelationships);
        return $content;
    }
}
