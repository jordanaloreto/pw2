<?php
    switch ($_REQUEST["acao"]) {
        case 'cadastrar':
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            $data_nascimento = $_POST["data_nascimento"];

            $sql = "INSERT INTO usuario (nome, email, senha, data_nascimento)
            VALUES ('{$nome}',
                    '{$email}',
                    '{$senha}',
                    '{$data_nascimento}')";
            $res = $conn->query($sql);
            break;
            
        case 'editar':
            break;
        case 'excluir':
            break;
    }
?>