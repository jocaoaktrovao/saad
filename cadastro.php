<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $numero = $_POST['numero'];
    $data_nascimento = $_POST['data_nascimento'];

    // Lógica para a imagem de perfil
    $profile_pic = '';
    if (isset($_POST['profile_pic'])) {
        $profile_pic = $_POST['profile_pic'];
    }
    
    if (isset($_FILES['custom_image']) && $_FILES['custom_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'src/images/'; // Direcionar para o diretório onde deseja armazenar as imagens
        $tmp_name = $_FILES['custom_image']['tmp_name'];
        $name = basename($_FILES['custom_image']['name']);
        $profile_pic = $upload_dir . $name;

        // Mover o arquivo para o diretório
        move_uploaded_file($tmp_name, $profile_pic);
    }

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

    // Verifica se o nome de usuário já existe
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Nome de usuário ou email já está em uso.";
    } else {
        // Prepara a consulta para inserir o novo usuário
        $sql = "INSERT INTO users (username, password, email, cep, rua, bairro, cidade, estado, numero, data_nascimento, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param("sssssssssss", $username, $hashed_password, $email, $cep, $rua, $bairro, $cidade, $estado, $numero, $data_nascimento, $profile_pic);
        
        if ($stmt->execute()) {
            // Redireciona para a página de login
            header("Location: login.php");
            exit();
        } else {
            $error = "Erro ao registrar usuário: " . $stmt->error;
        }
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
    <link rel="stylesheet" href="src/style/cadastro.css">
    <title>Cadastro - PYTHONLINO</title>
</head>
<body>
    <div class="container">
        <h2>Cadastro</h2>
        <?php if (!empty($error)) : ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="cadastro.php" method="POST" enctype="multipart/form-data">
            <label for="username">Nome de Usuário:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="cep">CEP:</label>
            <input type="text" id="cep" name="cep" required onblur="buscarCEP(this.value)">

            <label for="rua">Rua:</label>
            <input type="text" id="rua" name="rua" required>

            <label for="bairro">Bairro:</label>
            <input type="text" id="bairro" name="bairro" required>

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" required>

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" required>

            <label for="numero">Número da Casa:</label>
            <input type="text" id="numero" name="numero" required>

            <!-- Novo campo de data de nascimento -->
            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required>

            <label>Escolha uma imagem de perfil:</label>
            <div class="icons">
                <label>
                    <input type="radio" name="profile_pic" value="src/images/patolino1.png" required>
                    <img src="src/images/patolino1.png" alt="perfil 1">
                </label>
                <label>
                    <input type="radio" name="profile_pic" value="src/images/patolino2.png" required>
                    <img src="src/images/patolino2.png" alt="perfil 2">
                </label>
                <label>
                    <input type="radio" name="profile_pic" value="src/images/patolino3.png" required>
                    <img src="src/images/patolino3.png" alt="perfil 3">
                </label>
            </div>

            <div class="custom-upload">
                <label for="custom_image" class="upload-btn">
                    Escolha ou faça upload da sua própria imagem
                    <input type="file" id="custom_image" name="custom_image" accept="image/*">
                </label>
            </div>
            
            <div class="btn-box">
                <button type="submit" class="btn">Cadastrar</button>
                <button type="button" class="back-btn" onclick="window.location.href='index.html'">Voltar</button>
            </div>
        </form>
    </div>

    <script>
        function buscarCEP(cep) {
            if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        document.getElementById('rua').value = data.logradouro || '';
                        document.getElementById('bairro').value = data.bairro || '';
                        document.getElementById('cidade').value = data.localidade || '';
                        document.getElementById('estado').value = data.uf || '';
                    } else {
                        alert("CEP não encontrado.");
                    }
                })
                .catch(error => console.error('Erro ao buscar o CEP:', error));
            } else {
                alert("Digite um CEP válido com 8 dígitos.");
            }
        }
    </script>
</body>
</html>
