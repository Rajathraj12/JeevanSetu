<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$h = \App\Models\Hospital::where('name', 'like', '%Max%')->first();
if($h) {
    \App\Models\User::updateOrCreate(
        ['email' => 'maxhealthcare@gmail.com'],
        [
            'name' => 'Max Admin',
            'password' => \Hash::make('maxhealthcare'),
            'role' => 'admin',
            'hospital_id' => $h->id
        ]
    );
    echo "Admin created successfully!\n";
} else {
    echo "Hospital not found!\n";
}
