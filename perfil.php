<?php
session_start();
if (isset($_GET['msg']) && $_GET['msg'] === 'success') {
    echo "<p>Informações alteradas com sucesso!</p>";
}

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$username = $_SESSION['username'];

$servername = "localhost";
$db_username = "root"; // seu nome de usuário do MySQL
$password = ""; // sua senha do MySQL
$dbname = "pythonlino_real";

// Conexão com o banco de dados
$conn = new mysqli($servername, $db_username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtém as informações do usuário
$sql = "SELECT username, email, cep FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    echo "Usuário não encontrado!";
    exit();
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuário</title>
    <link rel="stylesheet" href="src/style/perfil.css">
    <link rel="stylesheet" href="src/style/header.css">
</head>
<body>
<style>
    .header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .navbar a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
        }
</style>
<header class="header">
    <a href="#" class="logo">PYTHONLINO</a>
    <nav class="navbar">
        <a href="index.html">HOME</a>
        <a href="modulo1.php">MÓDULO 1</a>
        <a href="modulo2.html">MÓDULO 2</a>
        <a href="modulo3.html">MÓDULO 3</a>
        <a href="videos.html">VÍDEOS</a>
        <a href="golang.php">GO LANG</a>
    </nav>
</header>

<div class="profile-container">
    <h2>Editar Perfil</h2>
    <form action="atualiza_perfil.php" method="POST">
        <div class="input-box">
            <label for="username">Nome de Usuário:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user_data['username']); ?>" required>
        </div>
        <div class="input-box">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
        </div>
        <div class="input-box">
            <label for="cep">CEP:</label>
            <input type="text" name="cep" id="cep" value="<?php echo htmlspecialchars($user_data['cep']); ?>" required>
        </div>
        <div class="input-box">
            <label for="password">Senha:</label>
            <input type="password" name="password" id="password" placeholder="Digite uma nova senha">
        </div>
        <div class="button-container">
            <button type="submit" class="btn">Salvar Alterações</button>
            <button type="submit" formaction="deletar_conta.php" class="btn btn-danger">Deletar Conta</button>
        </div>
    </form>
</div>

</body>
</html>
