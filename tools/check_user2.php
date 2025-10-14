<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
$user = DB::table('users')->where('code', '1')->first();
if ($user) {
    echo 'Profile_Picture: ' . ($user->Profile_Picture ?? '(null)') . PHP_EOL;
} else {
    echo 'User not found' . PHP_EOL;
}

?>