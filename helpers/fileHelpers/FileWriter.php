<?php

namespace helpers\fileHelpers;

class FileWriter
{
    private static ?FileWriter $fileWriter = null;
    private function __construct() {}

    public static function getInstance(): FileWriter
    {
        if(is_null(self::$fileWriter)) {
            self::$fileWriter = new FileWriter();
        }
        return self::$fileWriter;
    }

    public function writeRoute(string $name): void
    {
        $name = strtolower($name);
        $content = PHP_EOL;
        $methods = [
            "Route::get('/$name', [App\Http\Controllers\RoleController::class, 'index']);",
            "Route::post('/$name', [App\Http\Controllers\RoleController::class, 'store']);",
            "Route::put('/$name/{$name}', [App\Http\Controllers\RoleController::class, 'update']);",
            "Route::delete('/$name', [App\Http\Controllers\RoleController::class, 'destroy']);"
        ];
        foreach($methods as $method) {
            $content .= trim($method) . PHP_EOL;
        }
        file_put_contents(__DIR__ . '/../../routes/web.php', $content, FILE_APPEND);
    }
}
