<?php include 'conexao.php'; ?>
<head>
    <link rel="stylesheet" href="style/style.css">
</head>

<h2>Consulta de Chapas Cadastradas</h2>

<table border="1">
    <tr>
        <th>Código</th>
        <th>Nome da Chapa</th>
        <th>Líder</th>
        <th>Vice-líder</th>
    </tr>

    <?php
    $resultado = $conn->query("SELECT * FROM chapas");
    while ($linha = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>{$linha['codigo']}</td>
                <td>{$linha['nome_chapa']}</td>
                <td>{$linha['nome_lider']} ({$linha['matricula_lider']})</td>
                <td>{$linha['nome_vice']} ({$linha['matricula_vice']})</td>
              </tr>";
    }
    ?>
</table>