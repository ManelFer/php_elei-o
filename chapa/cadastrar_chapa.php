<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Chapa</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <h2>Cadastrar Nova Chapa</h2>
    <form method="POST">
        Código da Chapa: <input type="text" name="codigo"><br>
        Nome da Chapa: <input type="text" name="nome_chapa"><br>
        Matrícula do Líder: <input type="text" name="mat_lider"><br>
        Nome do Líder: <input type="text" name="nome_lider"><br>
        Matrícula do Vice-líder: <input type="text" name="mat_vice"><br>
        Nome do Vice-líder: <input type="text" name="nome_vice"><br>
        <input type="submit" name="cadastrar" value="Cadastrar">
    </form>

    <?php
    if (isset($_POST['cadastrar'])) {
        $stmt = $conn->prepare("INSERT INTO chapas (codigo, nome_chapa, matricula_lider, nome_lider, matricula_vice, nome_vice) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $_POST['codigo'], $_POST['nome_chapa'], $_POST['mat_lider'], $_POST['nome_lider'], $_POST['mat_vice'], $_POST['nome_vice']);

        if ($stmt->execute()) {
            echo "Chapa cadastrada com sucesso!";
        } else {
            echo "Erro: " . $stmt->error;
        }
    }
    ?>
</body>

</html>