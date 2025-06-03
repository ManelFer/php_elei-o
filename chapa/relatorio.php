<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Votação</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <h2>Relatório de Votação</h2>

    <?php
    $totalVotosRes = $conn->query("SELECT COUNT(*) as total FROM votos");
    $total = $totalVotosRes->fetch_assoc()['total'];

    $chapas = $conn->query("SELECT chapas.nome_chapa, chapas.codigo, COUNT(votos.id) as votos 
                        FROM chapas 
                        LEFT JOIN votos ON chapas.id = votos.chapa_id 
                        GROUP BY chapas.id");

    echo "<table border='1'>
        <tr>
            <th>Chapa</th>
            <th>Código</th>
            <th>Votos</th>
            <th>Percentual</th>
        </tr>";

    while ($linha = $chapas->fetch_assoc()) {
        $percentual = $total > 0 ? round(($linha['votos'] / $total) * 100, 2) : 0;
        echo "<tr>
            <td>{$linha['nome_chapa']}</td>
            <td>{$linha['codigo']}</td>
            <td>{$linha['votos']}</td>
            <td>$percentual%</td>
          </tr>";
    }

    echo "</table>";
    echo "<p><strong>Total de votos:</strong> $total</p>";
    ?>
</body>

</html>