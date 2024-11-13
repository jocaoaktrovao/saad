<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$servername = "localhost";
$db_username = "root"; // seu nome de usuário do MySQL
$password = ""; // sua senha do MySQL
$dbname = "pythonlino_real";

// Conexão com o banco de dados
$conn = new mysqli($servername, $db_username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtém o nome de usuário da sessão
$username = $_SESSION['username'];

// Obtém os dados do formulário
$new_username = $_POST['username'];
$email = $_POST['email'];
$cep = $_POST['cep'];
$password = $_POST['password'];

// Se uma nova senha for fornecida, atualize a senha
if (!empty($password)) {
    // Aqui você deve hash a senha antes de armazená-la
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET username = ?, email = ?, cep = ?, password = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $new_username, $email, $cep, $hashed_password, $username);
} else {
    // Se nenhuma nova senha for fornecida, atualize apenas o resto
    $sql = "UPDATE users SET username = ?, email = ?, cep = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $new_username, $email, $cep, $username);
}

if ($stmt->execute()) {
    // Atualiza a sessão com o novo nome de usuário
    $_SESSION['username'] = $new_username;

    // Redireciona de volta para a página de perfil com uma mensagem de sucesso
    header("Location: modulo1.php?msg=success");
    exit();
} else {
    echo "Erro ao alterar as informações: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
