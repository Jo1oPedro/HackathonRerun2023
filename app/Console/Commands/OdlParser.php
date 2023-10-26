<?php

namespace App\Console\Commands;

use helpers\parser\ClassParser;
use Illuminate\Console\Command;

class OdlParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'odl-parser {file_path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ClassParser::createFile("/../../arquivosDeEntrada/{$this->argument('file_path')}");
    }
}
