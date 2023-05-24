<?php

include('../controller/conexao/conexao.php');

if (isset($_POST['email']) || isset($_POST['senha'])) {
  if (empty($_POST['email'])) {
    echo "Preencha seu email";
  } else if (empty($_POST['senha'])) {
    echo "Preencha sua senha";
  } else {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
    $stmt->execute([$email, $senha]);

    $quantidade = $stmt->rowCount();

    if ($quantidade == 1) {

      $usuario = $stmt->fetch();

      if (!isset($_SESSION)) {
        session_start();
      }

      $_SESSION['id'] = $usuario['id'];
      $_SESSION['nome'] = $usuario['nome'];

      header("Location: painel.php");
    } else {
      echo "Falha ao logar: email ou senha incorretos";
    }
  }
}
$conn = null; // Fecha a conexão
