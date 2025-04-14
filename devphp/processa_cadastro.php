<?php
// /processa_cadastro.php

require_once 'classes/Usuario.php';
require_once 'classes/Autenticador.php';
require_once 'classes/Sessao.php';

Sessao::iniciar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];

    if (empty($nome) || empty($email) || empty($senha)) {
        die("Todos os campos são obrigatórios.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("E-mail inválido.");
    }

    $autenticador = new Autenticador();
    $novoUsuario = new Usuario($nome, $email, $senha);
    $autenticador->registrar($novoUsuario);

    header("Location: login.php?cadastro_sucesso=1");
    exit();
} else {
    header("Location: cadastro.php");
    exit();
}

?>