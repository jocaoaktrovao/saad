<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">   
    <link href="https://fonts.googleapis.com/css2?family=New+Amsterdam&family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/style/header.css">
    <link rel="stylesheet" href="src/style/modulo1.css">
    <link rel="stylesheet" href="src/style/footer.css">
    <title>PYTHONLINO</title>
    <style>
        p {
        font-size: 24px; /* Aumenta o tamanho da fonte */
        color: #F0A830; /* Mantém a cor amarela */
        text-align: center; /* Centraliza o texto */
        font-family: "Press Start 2P", cursive; /* Aplica a mesma fonte da logo para manter consistência */
        margin-top: 20px; /* Adiciona espaço acima */
        }
        /* Cabeçalho */
        .header {
            position: relative;
            background-color: #dee2e6;
            color: black;
            padding: 20px;
            text-align: center;
        }

        .navbar a {
            color: black;
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
            background-color: #dee2e6;
            color: black;
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
            background-color: #f9f9f9;
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
            color: #F0A830;
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
        <a href="#" class="logo">PYTHONLINO</a>
        <nav class="navbar">
            <a href="index.html">HOME</a>
            <a href="modulo1.php">MÓDULO 1</a>
            <a href="modulo2.html">MÓDULO 2</a>
            <a href="modulo3.html">MÓDULO 3</a>
            <a href="videos.html">VÍDEOS</a>
            <a href="modulo1go.php">GO LANG</a>
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
        A PYTHONLINO É UM SITE CUJO OBJETIVO PRINCIPAL É ENSINAR A PROGRAMAR NA LINGUAGEM PYTHON! ESTE CURSO É DIVIDIDO EM 3 MÓDULOS. NO MÓDULO 1, VOCE APRENDERÁ A COMO INSTALAR O SOFTWARE DO PYTHON E A SUA CONFIGURAÇÃO, AS SUAS VANTAGENS, AS DESVANTAGENS, APLICAÇÕES, CONCEITOS BÁSICOS DA LINGUAGEM (ESTRUTURA DO PROGRAMA, VARIÁVEIS E SEUS TIPOS, OPERADORES, ESTRUTURAS DE CONTROLES (CONDIÇÕES, LAÇOS ETC)). NO MÓDULO 2, VOCÊ VAI APRENDER ALGUNS PROGRAMAS BÁSICOS, FATORIAL, PRIMO, VETORES, MATRIZES E ARQUIVOS (CRIAR, LER, APAGAR ETC). E POR FIM, NO MÓDULO 3, IREMOS ENSINAR ALGUNS ALGORITMOS DE BUSCA E ORDENAÇÃO. APROVEITE AO MÁXIMO A EXPERIÊNCIA E BONS ESTUDOS!!
    </div>
    <h1>CONCEITOS BÁSICOS</h1>
    <h2>1. Estrutura de um Programa Python</h2>
    <div class="textooo">
        Python é uma linguagem de programação de alto nível e de fácil leitura, projetada para ser simples e eficiente. Aqui estão alguns conceitos básicos que são fundamentais para entender e começar a programar em Python:
        Em Python, a estrutura de um programa é definida principalmente por funções, classes e blocos de código, que são delimitados por indentação (espaços ou tabulações). Diferente de outras linguagens que usam chaves '{}' para delimitar blocos de código, Python usa a indentação, o que torna o código mais legível.
        <h1>Exemplo de Código</h1>
        <textarea id="codigoPython1" class="code-box">
            # Função para somar dois números
            def soma(a, b):
                return a + b
            
            # Exemplo de uso
            numero1 = 5
            numero2 = 7
            
            resultado = soma(numero1, numero2)
            print(f"A soma de {numero1} e {numero2} é: {resultado}")
        </textarea>
        <br>
        <button class="btn-executar" onclick="executarCodigo('codigoPython1', 'saidaCodigo1')">Executar Código</button>
        <div class="output" id="saidaCodigo1">Saída do código aparecerá aqui...</div>
    </div>
    <h2><br>2. VARIÁVEIS E TIPOS DE DADOS</h2>
    <div class="textooo">
        Python utiliza uma tipagem dinâmica, ou seja, o tipo de uma variável é determinado automaticamente durante a execução do programa. Isso significa que você não precisa declarar o tipo de uma variável ao criá-la.
        <br><br>nome = "Ana"      # String (str): Sequências de caracteres, como "Olá" ou 'Python'.
        <br>idade = 30        # Inteiro (int): Números inteiros, como 10 ou -3.
        <br>altura = 1.65     # Float (float): Números com ponto decimal, como 3.14 ou -0.5.
        <br>is_estudante = True  # Booleano (bool): Verdadeiro (True) ou Falso (False).
    </div>
    <h2><br>3. OPERADORES</h2>
    <div class="textooo">
        Python oferece vários operadores que são utilizados para realizar operações em variáveis e valores:
        <br><br>Aritméticos: + (adição), - (subtração), * (multiplicação), / (divisão), % (módulo, resto da divisão), ** (exponenciação), // (divisão inteira)
        <br>Comparação == (igual a), != (diferente de), > (maior que), &lt; (menor que), >= (maior ou igual a), &lt;= (menor ou igual a)
        <br>Lógicos: and (e), or (ou), not (não)
    </div>
    <h2><br>4. ESTRUTURAS DE CONTROLE</h2>
    <div class="textooo">
        Python possui estruturas de controle que permitem a execução condicional e repetitiva de blocos de código.
        <br><br>Condições (if, elif, else): As estruturas condicionais permitem executar blocos de código dependendo de uma condição, Exemplo:
        <br>idade = 18
        <br>if idade >= 18:
        <br>print("Maior de idade")
        <br>else:
        <br>print("Menor de idade")
        <br>Laços de Repetição (for, while):
        Python suporta laços de repetição para executar um bloco de código várias vezes.
        <br>For: Itera sobre uma sequência (como uma lista, tupla, string). <br>Exemplo:<br>
        <br>for i in range(5):<br>print(i)
        <br>While: Continua a executar um bloco de código enquanto uma condição for verdadeira. <br>Exemplo:<br>
        <br>contador = 0<br>while contador &lt; 5:<br>print(contador)<br>contador += 1
    </div>
    <div class="botao-proximo">
        <a href="vantagens.html" class="proximo">PROXIMO</a>
    </div>
    <footer>
        <h4>&copy; 2024 Pythonlino. Todos os direitos reservados.</h4>
    </footer>
</body>
</html>