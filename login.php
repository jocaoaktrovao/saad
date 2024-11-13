<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Conexão com o banco de dados
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "pythonlino_real";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Prepara a consulta para verificar o usuário
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifica a senha
        if (password_verify($password, $user['password'])) {
            // Senha correta, inicia a sessão
            $_SESSION['username'] = $username;
            header("Location: modulo1.php"); // Redireciona para a página inicial
            exit();
        } else {
            $error = "Nome de usuário ou senha inválidos.";
        }
    } else {
        $error = "Nome de usuário ou senha inválidos.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/style/login.css">
    <title>Login - PYTHONLINO</title>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (!empty($error)) : ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <label for="username">Nome de Usuário:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Entrar</button>
        </form>
        <button onclick="window.location.href='index.html'" class="back-btn">Voltar</button>
    </div>
</body>
</html>
