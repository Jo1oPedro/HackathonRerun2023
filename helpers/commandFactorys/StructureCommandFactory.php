<?php

namespace helpers\commandFactorys;

class StructureCommandFactory
{
    private string $name = "";
    private string $controller_name = "";
    private string $model_name = "";
    private string $migration_name = "";
    private string $command = "php artisan make:";
    private static ?StructureCommandFactory $instance = null;

    private function __construct() {}

    public static function getInstance(): StructureCommandFactory
    {
        if(is_null(self::$instance)) {
            self::$instance = new StructureCommandFactory();
        }
        return self::$instance;
    }

    public function setName($name): StructureCommandFactory {
        if(!empty($this->name)) {
            throw new \InvalidArgumentException('Nome já definido');
        }
        $this->name = $name;
        return $this;
    }
    public function setController(): StructureCommandFactory
    {
        if(!empty($this->controller_name)) {
            throw new \InvalidArgumentException('Nome do controller já definido');
        }

        if(!empty($this->model_name)) {
            throw new \InvalidArgumentException('Não é possível definir o nome do controller depois da model');
        }

        if(!empty($this->migration_name)) {
            throw new \InvalidArgumentException('Não é possível criar o controller após a migration');
        }
        $this->controller_name = $this->name;
        $this->command .= "controller {$this->name}Controller --resource ";
        return $this;
    }

    public function setModel($migration = false): StructureCommandFactory
    {
        if(!empty($this->controller_name)) {
            if($migration) {
                throw new \InvalidArgumentException('Não é possível criar a migration junto da model e do controller');
            }
            $this->command .= "--model=" . ucfirst($this->name);
            $this->model_name = $this->name;
            return $this;
        }

        if(!empty($this->migration_name)) {
            throw new \InvalidArgumentException('Não é possível criar a model após a migration');
        }

        $this->command .= "model " . ucfirst($this->name);
        $this->model_name = $this->name;
        return $this;
    }

    public function setMigration(string $migration_name = ""): StructureCommandFactory
    {
        if(!empty($this->controller_name)) {
            throw new \InvalidArgumentException('Não é possível criar a migration junto do controller');
        }

        $this->migration_name = strtolower(!empty($migration_name) ? $migration_name : $this->name) . "s";

        if(!empty($this->model_name)) {
            $this->command .= " -m";
            return $this;
        }

        $this->command .= "migration create_{$this->migration_name}_table";

        return $this;
    }

    public function executeCommand($interaction = "--no-interaction"): void
    {
        shell_exec($this->command . " " . $interaction);
        $this->name = "";
        $this->controller_name = "";
        $this->model_name = "";
        $this->migration_name = "";
        $this->command = "php artisan make:";
    }
}
