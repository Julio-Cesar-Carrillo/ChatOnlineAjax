<?php
$opciones = [
    'cost' => 12,
];
echo password_hash("asdASD123", PASSWORD_BCRYPT, $opciones) . "\n";

