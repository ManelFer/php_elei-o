<?php include 'conexao.php'; ?>

<h2>Votação</h2>

<form method="POST">
    Matrícula do Aluno: <input type="text" name="matricula"><br>
    <input type="submit" name="verificar" value="Verificar e Votar">
</form>

<?php
if (isset($_POST['verificar'])) {
    $matricula = $_POST['matricula'];

    $verifica = $conn->query("SELECT * FROM alunos WHERE matricula = '$matricula'");
    if ($verifica->num_rows === 0) {
        $conn->query("INSERT INTO alunos (matricula, nome, votou) VALUES ('$matricula', '', 0)");
    }

    $aluno = $conn->query("SELECT * FROM alunos WHERE matricula = '$matricula'")->fetch_assoc();
    if ($aluno['votou']) {
        echo "<p>Você já votou!</p>";
    } else {
        echo "<form method='POST'>
                <input type='hidden' name='matricula' value='$matricula'>
                <label>Escolha uma chapa:</label><br>";

        $chapas = $conn->query("SELECT * FROM chapas");
        while ($chapa = $chapas->fetch_assoc()) {
            echo "<input type='radio' name='chapa_id' value='{$chapa['id']}' required> 
                  {$chapa['nome_chapa']} ({$chapa['codigo']})<br>";
        }

        echo "<br><input type='submit' name='votar' value='Confirmar Voto'>
              </form>";
    }
}

if (isset($_POST['votar'])) {
    $matricula = $_POST['matricula'];
    $chapa_id = $_POST['chapa_id'];

    $stmt = $conn->prepare("INSERT INTO votos (matricula_aluno, chapa_id) VALUES (?, ?)");
    $stmt->bind_param("si", $matricula, $chapa_id);
    $stmt->execute();

    $conn->query("UPDATE alunos SET votou = 1 WHERE matricula = '$matricula'");

    echo "<p>Voto registrado com sucesso!</p>";
}
?>