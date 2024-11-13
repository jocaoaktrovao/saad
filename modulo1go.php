<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">   
    <link href="https://fonts.googleapis.com/css2?family=New+Amsterdam&family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/style/headergo.css">
    <link rel="stylesheet" href="src/style/golang.css">
    <link rel="stylesheet" href="src/style/footer.css">
    <title>GOLANGAUM</title>
    <style>
        p {
        font-size: 24px; /* Aumenta o tamanho da fonte */
        color: #6f1d1b; /* Mantém a cor amarela */
        text-align: center; /* Centraliza o texto */
        font-family: "Press Start 2P", cursive; /* Aplica a mesma fonte da logo para manter consistência */
        margin-top: 20px; /* Adiciona espaço acima */
        }
        /* Cabeçalho */
        .header {
            position: relative;
            background-color: #000;
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        .navbar a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
        }

        .profile {
            display: flex;
            align-items: center;
            margin-left: auto; /* Garante que a área de perfil fique alinhada à direita */
        }

        .profile img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .profile span {
            color: #fff;
            font-weight: bold;
        }

        /* Rodapé */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        footer a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .code-box {
            width: 80%;
            height: 200px;
            margin: 20px auto;
            display: block;
            font-family: 'Courier New', Courier, monospace;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #000;
            color: white;
        }

        .output {
            width: 80%;
            margin: 10px auto;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            border-radius: 5px;
        }

        .btn-executar {
            display: block;
            margin: 20px auto; 
            padding: 15px 30px; 
            background-color: #ffff;  
            color: #6f1d1b;
            font-size: 16px; 
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-executar:hover {
            transition: 0.4s;
            background-color: #333;
        }

        main {
            flex: 1;
        }
    </style>
</head>
<body>
<header class="header">
        <a href="#" class="logo">GOLANGAUM</a>
        <nav class="navbar">
            <a href="index.html">HOME</a>
            <a href="modulo1go.php">MÓDULO 1</a>
            <a href="modulo2go.html">MÓDULO 2</a>
            <a href="modulo3go.html">MÓDULO 3</a>
            <a href="videosgo.html">VÍDEOS</a>
            <a href="modulo1.php">PYTHON</a>
        </nav>
    </header>

    <main>
        <?php
        session_start();
        
        // Verifique se o usuário está logado
        if (!isset($_SESSION['username'])) {
            header("Location: index.html"); // Redirecione se não estiver logado
            exit();
        }

        $username = $_SESSION['username'];

        $servername = "localhost";
        $db_username = "root";
        $password = "";
        $dbname = "pythonlino_real";

        // Cria a conexão
        $conn = new mysqli($servername, $db_username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Obtém a imagem de perfil e outras informações
        $sql = "SELECT profile_pic FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $profile_pic = $data['profile_pic'];
        } else {
            $profile_pic = 'src/images/default.png'; // Caminho da imagem padrão
        }

        $stmt->close();
        $conn->close();
        ?>
          <script>
        function executarCodigo(textareaId, outputId) {
           
            const codigo = document.getElementById(textareaId).value;

            
            let saida = "A execução do código foi simulada. Aqui está a saída esperada:";
            saida += "\nA soma de 5 e 7 é: 12";
            
            document.getElementById(outputId).textContent = saida;
        }
    </script>
        <div class="computador">
    <img src="<?php echo htmlspecialchars($profile_pic); ?>" height="500px" width="500px" alt="Imagem de Perfil">
</div>
        <p><br>Bem-vindo, <a href="perfil.php"><?php echo htmlspecialchars($username); ?></a></p>
        <h1><br>INTRODUÇÃO</h1>
        
    </main>
    <div class="textooo">
        A GOLANGAUM É UM SITE CUJO OBJETIVO PRINCIPAL É ENSINAR A PROGRAMAR NA LINGUAGEM GOLANG! ESTE CURSO É DIVIDIDO EM 3 MÓDULOS. NO MÓDULO 1, VOCÊ APRENDERÁ COMO INSTALAR O SOFTWARE DO GOLANG, A SUA CONFIGURAÇÃO, SUAS VANTAGENS, DESVANTAGENS E APLICAÇÕES. NO MÓDULO 2, VOCÊ VAI APRENDER ALGUNS PROGRAMAS BÁSICOS E NO MÓDULO 3, IREMOS ENSINAR ALGUNS ALGORITMOS DE BUSCA E ORDENAÇÃO.
    </div>

    <h1>CONCEITOS BÁSICOS</h1>
    <h2>1. Estrutura de um Programa em Golang</h2>
    <div class="textooo">
        Golang é uma linguagem de programação eficiente e moderna, ideal para desenvolvimento de software de alto desempenho. Em Go, o programa começa com a função principal chamada `main`, que é definida no pacote principal `main`. Todos os pacotes importados são declarados no início do arquivo, utilizando a instrução `import`.
    </div>

    <h1>Exemplo de Código</h1>
    <textarea id="codigoGolang1" class="code-box">
        // Programa para somar dois números em Golang
        package main

        import "fmt"

        func soma(a int, b int) int {
            return a + b
        }

        func main() {
            numero1 := 5
            numero2 := 7

            resultado := soma(numero1, numero2)
            fmt.Printf("A soma de %d e %d é: %d\n", numero1, numero2, resultado)
        }
    </textarea>
    <br>
    <button class="btn-executar" onclick="executarCodigo('codigoGolang1', 'saidaCodigo1')">Executar Código</button>
    <div class="output" id="saidaCodigo1">Saída do código aparecerá aqui...</div>

    <h2><br>2. Variáveis e Tipos de Dados</h2>
    <div class="textooo">
        Em Golang, as variáveis devem ser declaradas com seus tipos. Os tipos comuns incluem `string`, `int`, `float64`, `bool`, entre outros. Aqui está um exemplo:
        <br><br>var nome string = "Ana"  // String
        <br>var idade int = 30          // Inteiro
        <br>var altura float64 = 1.65   // Float
        <br>var isEstudante bool = true // Booleano
    </div>

    <h2><br>3. Operadores</h2>
    <div class="textooo">
        Golang oferece operadores aritméticos (`+`, `-`, `*`, `/`, `%`), de comparação (`==`, `!=`, `>`, `<`, `>=`, `<=`), e operadores lógicos (`&&`, `||`, `!`).
    </div>

    <h2><br>4. Estruturas de Controle</h2>
    <div class="textooo">
        Golang utiliza estruturas de controle para tomada de decisão e laços de repetição. A estrutura `if` avalia uma condição e executa um bloco de código:
        <br><br>idade := 18
        <br>if idade >= 18 {
        <br>    fmt.Println("Maior de idade")
        <br>} else {
        <br>    fmt.Println("Menor de idade")
        <br>}
        <br>Para laços de repetição, usamos `for`:
        <br><br>for i := 0; i < 5; i++ {
        <br>    fmt.Println(i)
        <br>}
    </div>
    <div class="botao-proximo">
        <a href="vantagemgo.html" class="proximo">PROXIMO</a>
    </div>
    <footer>
        <h4>&copy; 2024 Golangaum. Todos os direitos reservados.</h4>
    </footer>
</body>
</html>