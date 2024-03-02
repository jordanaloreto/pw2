<?php
require "config.php";

// Verificar se o usuário está logado
session_start();
if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
    // Se o usuário estiver logado, redirecionar para a página de cadastro
    header("Location: novo-usuario.php");
    exit();
}

// Verificar se o formulário de cadastro foi submetido
if(isset($_POST["acao"]) && $_POST["acao"] === "cadastrar") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $data_nascimento = $_POST["data_nascimento"];

    // Consulta SQL para inserir um novo usuário no banco de dados
    $sql = "INSERT INTO usuario (nome, email, senha, data_nascimento)
            VALUES ('{$nome}', '{$email}', '{$senha}', '{$data_nascimento}')";

    $res = $conn->query($sql);

    if($res) {
        // Se o cadastro for bem-sucedido, redirecionar para a página de cadastro
        $_SESSION["logged_in"] = true;
        header("Location: novo-usuario.php");
        exit();
    } else {
        // Se ocorrer algum erro durante o cadastro, exibir mensagem de erro
        $erro = "Ocorreu um erro ao cadastrar o usuário. Por favor, tente novamente.";
    }
}

// Verificar se o formulário de login foi submetido
if(isset($_POST["email"]) && isset($_POST["senha"])) {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Consulta SQL para verificar se o usuário existe com o email e senha fornecidos
    $sql = "SELECT * FROM usuario WHERE email = '{$email}' AND senha = '{$senha}'";
    $res = $conn->query($sql);

    if($res && $res->num_rows > 0) {
        // Usuário autenticado com sucesso
        // Redirecionar para a página de cadastro ou qualquer outra página apropriada
        $_SESSION["logged_in"] = true;
        header("Location: novo-usuario.php");
        exit(); // Encerrar o script após redirecionar
    } else {
        // Se o usuário não for encontrado, exibir mensagem de erro
        $erro = "Email ou senha incorretos. Por favor, tente novamente.";
    }
}
?>
