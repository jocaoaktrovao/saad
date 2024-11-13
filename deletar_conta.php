<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$username = $_SESSION['username'];

// Conectando ao banco de dados
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "pythonlino_real";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Deletando a conta do usuário
$sql = "DELETE FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);

if ($stmt->execute()) {
    echo "Conta deletada com sucesso!";
    session_destroy(); // Finaliza a sessão
    header("Location: index.html"); // Redireciona para a página inicial
} else {
    echo "Erro ao deletar a conta: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
