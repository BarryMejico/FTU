<?php
require __DIR__ . '/../vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;

// Load Laravel bootstrap to get DB config
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = Illuminate\Support\Facades\DB::table('users')->where('code', '1')->first();
if ($user) {
    echo "User code=1 Profile_Picture: " . ($user->Profile_Picture ?? '(null)') . PHP_EOL;
} else {
    echo "User with code=1 not found" . PHP_EOL;
}

?>