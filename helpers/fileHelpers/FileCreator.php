<?php

namespace helpers\fileHelpers;

class FileCreator
{
    private string $name = "";
    private ?array $attributes = null;
    private string $lowerName;
    private string $ucFirstName;
    private array $allRelations = [];

    private array $modelFillable = [];
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
    public function createController(array $classes): FileCreator
    {
        if (empty($this->name)) {
            throw new \InvalidArgumentException('Não é possível criar o controller sem um nome');
        }
        if (is_null($this->attributes)) {
            throw new \InvalidArgumentException('Não é possível criar o controller sem os atributos');
        }

        $controllerContent = file_get_contents(__DIR__ . "/templates/controllerTemplate.txt");
        if($classes[$this->name]->extends) {
            $controllerContent = str_replace(
                $this->controllerContentTemplate,
                [
                    $this->ucFirstName,
                    $this->ucFirstName,
                    //$this->getAttributes(),
                    $this->ucFirstName . " $" . $this->lowerName,
                    $this->getIndexContentWithRelation(),
                    $this->getCreateContent(),
                    $this->getStoreContentWithRelation($classes[$this->name]->extends),
                    $this->getShowContentWithRelation(),
                    $this->getEditContentWithRelation(),
                    $this->getUpdateContentWithRelation($classes[$this->name]->extends),
                    $this->getDestroyContentWithRelation($classes[$this->name]->extends),
                ],
                $controllerContent
            );
            file_put_contents(__DIR__ . "/../../app/Http/Controllers/" . $this->ucFirstName . "Controller.php", $controllerContent);
            FileWriter::getInstance()->writeRoute($this->name);
            return $this;
        }

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

    private function getIndexContentWithRelation(): string
    {
        return '$' . $this->lowerName . "= " . $this->ucFirstName . "::with('*')->get();\n\t\treturn view('{$this->lowerName}s.index');";
    }

    private function getCreateContent(): string
    {
        return "view('{$this->lowerName}s.create');";
    }

    private function getStoreContent(): string
    {
        return '$' . "data = " . '$' . "request->all();\n\t\t{$this->ucFirstName}::create(" . '$' . "data);\n\t\treturn redirect()->route('{$this->lowerName}s.index')->with('sucess', true);";
    }

    private function getStoreContentWithRelation(string $relation): string
    {
        $relation = ucfirst($relation);
        $lowerRelation = strtolower($relation);
        return '$' . "data = " . '$' . "request->all();\n\t\t" . '$' . "id =\App\Models\\{$relation}::create(" . '$' . "data)->id;\n\t\t" . '$' . "data = array_merge(" . '$' . "data, ['{$lowerRelation}_id' => " . '$' . "id]);\n\t\t{$this->ucFirstName}::create(" . '$' . "data);\n\t\treturn redirect()->route('{$this->lowerName}s.index')->with('sucess', true);";
    }

    private function getShowContent(): string
    {
        return "view('{$this->lowerName}s.show', compact('{$this->lowerName}'));";
    }

    private function getShowContentWithRelation(): string
    {
        return '$' ."{$this->lowerName}->load('*');\n\t\tview('{$this->lowerName}s.show', compact('{$this->lowerName}'));";
    }

    private function getEditContent(): string
    {
        return "view('{$this->lowerName}s.edit', compact('{$this->lowerName}'));";
    }

    private function getEditContentWithRelation(): string
    {
        return '$' ."{$this->lowerName}->load('*');\n\t\tview('{$this->lowerName}s.edit', compact('{$this->lowerName}'));";
    }

    private function getUpdateContent(): string
    {
        return '$' . "data = " . '$' . "request->all();\n\t\t" . '$' . "{$this->lowerName}->update(" . '$' . "data);\n\t\treturn redirect()->route('{$this->lowerName}s.index')->with('sucess', true);";
    }

    private function getUpdateContentWithRelation(string $relation): string
    {
        $relation = strtolower($relation);
        return '$' . "data = " . '$' . "request->all();\n\t\t" . '$' . "{$this->lowerName}->update(" . '$' . "data);\n\t\t" . '$' . "{$relation}= $" . "{$this->lowerName}->{$relation};\n\t\t" . '$' . "{$relation}->update(" . '$' . "data);\n\t\treturn redirect()->route('{$this->lowerName}s.index')->with('sucess', true);";
    }

    private function getDestroyContent(): string
    {
        return '$' . "{$this->lowerName}->delete();\n\t\treturn redirect()->route('{$this->lowerName}s.index')->with('sucess', true);";
    }

    private function getDestroyContentWithRelation(string $relation): string {
        $relation = strtolower($relation);
        return '$' . "{$this->lowerName}->{$relation}->delete();\n\t\treturn redirect()->route('{$this->lowerName}s.index')->with('sucess', true);";
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

    public function createMigration($content, $nameParam = null)
    {
        $name = $this->name;
        $lowerName = $this->lowerName;
        if($nameParam) {
            $name = $nameParam;
            $lowerName = strtolower($nameParam);
        }

        if(empty($name)) {
            throw new \InvalidArgumentException('Não é possível criar o controller sem um nome');
        }

        $migrationContent = file_get_contents(__DIR__ . "/templates/migrationTemplate.txt");
        $migrationContent = str_replace(
            $this->migrationContentTemplate,
            [
                "{$lowerName}s",
                "$content"
            ],
            $migrationContent
        );
        file_put_contents(__DIR__ . "/../../database/migrations/" . date("Y_m_d_His") .  "_create_{$lowerName}s_table.php", $migrationContent);
        //shell_exec("php artisan migrate:fresh");
        return $this;
    }

    public function getMigrationFields(): string
    {
        $content = "";
        foreach ($this->attributes as $attribute) {
            $content .= match ($attribute->type) {
                'string' => '$' . "table->string('{$attribute->value}', 191);\n\t\t",
                "int" => '$' . "table->integer('{$attribute->value}');\n\t\t",
                "float" => '$' . "table->float('{$attribute->value}', 8, 2);\n\t\t",
                "long" => '$' . "table->float('{$attribute->value}', 8, 2);\n\t\t",
                "short" => '$' . "table->float('{$attribute->value}', 8, 2);\n\t\t",
                default => ""
            };
        }
        return $content;
    }

    private function verifyRelationshipsManyToMany($classes, $classAux, $nameClass) {
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

    public function createMigrationRelationships($classes)
    {
        $content = "";
        $migrationsRelationships = [];
        $manyToManyVerify = [];
        foreach($classes as $class) {
            foreach($class->atributos as $atributo) {
                if(!in_array($atributo->type, ['string', 'int', 'float', 'long'])) {
                    $this->modelFillable[$class->name][] = strtolower($atributo->value) . "_id";
                    $this->allRelations[$class->name][] = strtolower($atributo->type);
                    $tableName = strtolower($atributo->value);
                    $foreigngName = $tableName . "_id";
                    if(strpos($atributo->type, 'list') !== false ) {
                        $manyToMany = $this->verifyRelationshipsManyToMany($classes, $class, ucfirst($atributo->value));
                        if($manyToMany !== false && !in_array($class->name, $manyToManyVerify) && !in_array($manyToMany->name, $manyToManyVerify)) {
                            $tableName1 = strtolower($class->name);
                            $tableName2 = strtolower($manyToMany->name);
                            $tableNameAux = $tableName1 . "_" . $tableName2;
                            $foreigngName1 = strtolower($class->name) . "_id";
                            $foreigngName2 = strtolower($manyToMany->name) . "_id";
                            $content = "";
                            $content .= '$' . "table->unsignedBigInteger('{$foreigngName1}');\n\t\t";
                            $content .= '$' . "table->unsignedBigInteger('{$foreigngName2}');\n\t\t";
                            $content .= '$' . "table->foreign('{$foreigngName1}')->references('id')->on('{$tableName1}s')->onDelete('cascade');\n\t\t";
                            $content .= '$' . "table->foreign('{$foreigngName2}')->references('id')->on('{$tableName2}s')->onDelete('cascade');\n\t\t";
                            $this->createMigration($content, $tableNameAux);
                            $manyToManyVerify[] = $class->name;
                            continue;
                        }
                        $tableNameIndex= $tableName;
                        if (substr($tableNameIndex, -1) === 's') {
                            $tableNameIndex = rtrim($tableNameIndex, 's');
                        }
                        $tableName = strtolower($class->name);
                        $foreigngName = strtolower($tableName . "_id");
                        $content .= '$' . "table->unsignedBigInteger('{$foreigngName}');\n\t\t";
                        $content .= '$' . "table->foreign('{$foreigngName}')->references('id')->on('{$tableName}s')->onDelete('cascade');\n\t\t";
                        if(isset($migrationsRelationships[strtolower($tableNameIndex)])) {
                            $migrationsRelationships[strtolower($tableNameIndex)] = $migrationsRelationships[strtolower($tableNameIndex)] . $content;
                        }else {
                            $migrationsRelationships[strtolower($tableNameIndex)] = $content;
                        }
                        continue;
                    }
                    $content .= '$' . "table->unsignedBigInteger('{$foreigngName}');\n\t\t";
                    $content .= '$' . "table->foreign('{$foreigngName}')->references('id')->on('{$tableName}s')->onDelete('cascade');\n\t\t";
                    if(isset($migrationsRelationships[strtolower($tableName)])) {
                        $migrationsRelationships[strtolower($class->name)] = $migrationsRelationships[strtolower($tableName)] . $content;
                    }else {
                        $migrationsRelationships[strtolower($class->name)] = $content;
                    }
                    continue;
                } else {
                    $this->modelFillable[$class->name][] = $atributo->value;
                }
                $content = "";
            }
            if($class->extends) {
                $this->allRelations[$class->name][] = strtolower($class->extends);
                $this->modelFillable[$class->name][] = strtolower($class->extends . "_id");
                $tableName = strtolower($class->extends) . "s";
                $foreigngName = strtolower($class->extends) . "_id";
                $content .= '$' . "table->unsignedBigInteger('{$foreigngName}');\n\t\t";
                $content .=  '$' . "table->foreign('{$foreigngName}')->references('id')->on('{$tableName}')->onDelete('cascade');\n\t\t";
                $migrationsRelationships[strtolower($class->name)] = $content;
            }
        }

        return $migrationsRelationships;
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

    public function finalizeModelCreation()
    {
        $files =  scandir(__DIR__ . "/../../app/Models");
        $i = 0;

        foreach ($files as $file) {
            if ($i < 2) {
                $i++;
                continue;
            }

            $name = str_replace(".php", "", $file);
            $data = $this->allRelations[$name];
            $data = '"'. implode(',', $data) . '"';

            $fieldFillables = $this->modelFillable[$name];
            $fieldFillables = '"'. implode('","', $fieldFillables) . '"';

            $tableName = strtolower($name) . 's';

            file_put_contents(__DIR__ . "/../../app/Models/" . $file, "\t". 'protected $table = '. "'$tableName'" .  ";\n", FILE_APPEND);
            file_put_contents(__DIR__ . "/../../app/Models/" . $file, "\t". 'public $allRelations = array(' . $data . ');' . "\n", FILE_APPEND);
            file_put_contents(__DIR__ . "/../../app/Models/" . $file, "\t". 'protected $fillable = ['. "$fieldFillables" .  "];\n", FILE_APPEND);
            file_put_contents(__DIR__ . "/../../app/Models/" . $file, "}", FILE_APPEND);
        }
    }
}
