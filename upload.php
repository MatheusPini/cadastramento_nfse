<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['xmlFile']) || $_FILES['xmlFile']['error'] !== UPLOAD_ERR_OK) {
        die('Nenhum arquivo foi carregado ou ocorreu um erro no upload.');
    }
    $file = $_FILES['xmlFile'];
    $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
    if ($fileType !== 'xml') {
        die('Somente arquivos XML são permitidos.');
    }
    $xmlContent = file_get_contents($file['tmp_name']);
    $xml = simplexml_load_file($file['tmp_name']);
    if ($xml === false) {
        die('Falha ao carregar o arquivo XML.');
    }
    $cnpjEmitente = trim((string) $xml->infNFSe->emit->CNPJ);

    if ($cnpjEmitente !== '09066241000884') {
        die('CNPJ inválido.');
    }

    $numeroNota = (string) $xml->infNFSe->nNFSe;
    $data = (string) $xml->infNFSe->DPS->infDPS->dhEmi;
    $destinatario = (string) $xml->infNFSe->DPS->infDPS->toma->xNome;
    $valorTotal = (float) $xml->infNFSe->valores->vLiq;
    $data = date('Y-m-d', strtotime($data));

    $stmt = $conn->prepare("INSERT INTO notas_fiscais (numero_nota, data_registro, destinatario, valor_total, xml_content) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $numeroNota, $data, $destinatario, $valorTotal, $xmlContent);
    $stmt->execute();
    $stmt->close();

    echo 'Upload bem-sucedido!';
}
?>
