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
    private function __construct() {}

    public static function getInstance(): FileCreator
    {
        if(is_null(self::$fileCreator)) {
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
        if(empty($this->name)) {
            throw new \InvalidArgumentException('Não é possível criar o controller sem um nome');
        }
        if(is_null($this->attributes)) {
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

    private function getShowContent():string
    {
        return "view('{$this->lowerName}s.show');";
    }

    private function getEditContent(): string
    {
        return "view('{$this->lowerName}s.edit', compact('{$this->lowerName}'));";
    }

    private function getUpdateContent(): string
    {
        return '$' . "data = " . '$' . "request->all();\n\t\t" . '$' ."{$this->lowerName}->update(" . '$' . "data);\n\t\treturn redirect()->route('{$this->lowerName}s.index')->with('sucess', true);";
    }

    private function getDestroyContent(): string
    {
        return '$' . "{$this->lowerName}->delete();\n\t\treturn redirect()->route('{$this->lowerName}s.index')->with('sucess', true);";
    }

    private function getControllerAttributes(): string
    {
        $content = "";
        foreach($this->attributes as $attribute) {
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
        if(empty($this->name)) {
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

    public function createModelWithRelations(string $relation, array $classes)
    {
        if(empty($this->name)) {
            throw new \InvalidArgumentException('Não é possível criar o controller sem um nome');
        }

        if (empty($relation))
        {
            return $this->createModel();
        }

        $relationContent = $this->generateRelation($relation, true);

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

    public function createMigration()
    {
        if(empty($this->name)) {
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
        foreach($this->attributes as $attribute) {
            $content .= match ($attribute->type) {
                'string' => '$' . "table->string('{$attribute->value}', 191);\n\t\t",
                "int" => '$' . "table->integer('{$attribute->value}');\n\t\t",
                "float" => '$' . "table->float('{$attribute->value}, 8, 2');\n\t\t",
            };
        }
        return $content;
    }

    private function verifyRelations(string $class, array $classes)
    {

    }

    private function generateRelation(string $class, bool $extends)
    {
        $text = "public function " . strtolower($class) . "()\n\t{\n\t\t" . $this->getRelation($class, $extends) . "\n\t}";
        return $text;
    }

    private function getRelation(string $class, bool $extends)
    {
        if ($extends)
        {
            return 'return $this->hasOne(' . ucfirst($class) . '::class);';
        }

        foreach ($this->attributes as $attribute)
        {

        }
    }
}
