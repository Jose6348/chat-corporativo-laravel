<?php
$serverName = "tcp:127.0.0.1,1433";
$connectionOptions = [
    "Database" => "chat_milani",
    "Uid" => "sa",
    "PWD" => "123456",
    "Encrypt" => 0, // importante
    "TrustServerCertificate" => 1,
    "LoginTimeout" => 5
];

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn) {
    echo "✅ Conexão bem-sucedida com o SQL Server!\n";
} else {
    echo "❌ Falha na conexão:\n";
    print_r(sqlsrv_errors());
}
