<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Payment;

$payments = Payment::all();
echo "ID | File DB | Exists?\n";
foreach($payments as $p) {
    $path = public_path('uploads/bukti/' . $p->bukti_pembayaran);
    $exists = file_exists($path) ? "YES" : "NO";
    echo $p->id . " | " . $p->bukti_pembayaran . " | " . $exists . "\n";
}
