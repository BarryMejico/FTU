<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$menus = DB::table('menu')->select('id', 'Description', 'icon')->get();

echo "Menu Icons:\n";
echo str_repeat('-', 80) . "\n";
foreach($menus as $menu) {
    echo sprintf("ID: %s | Name: %s | Icon: %s\n", $menu->id, $menu->Description, $menu->icon ?? '(null)');
}
?>
