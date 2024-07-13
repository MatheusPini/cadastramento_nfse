<?php
include 'config.php';

$result = $conn->query("SELECT numero_nota, data_registro, destinatario, valor_total FROM notas_fiscais");

echo '<table>';
echo '<tr><th>Número da Nota Fiscal</th><th>Data</th><th>Dados do Destinatário</th><th>Valor Total</th></tr>';

while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . $row['numero_nota'] . '</td>';
    echo '<td>' . $row['data_registro'] . '</td>';
    echo '<td>' . $row['destinatario'] . '</td>';
    echo '<td>' . $row['valor_total'] . '</td>';
    echo '</tr>';
}

echo '</table>';

$conn->close();
?>
