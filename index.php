<?php 

/**
 * @author Diego Brocanelli <diegod2@msn.com>   
 */

// Realizamos a importação da biblioteca para gerar QR Code.
require_once('phpqrcode/qrlib.php'); 

// Credenciais de acesso ao banco de dados.
$servidor = "localhost";
$usuario  = "SEU_USUARIO";
$senha    = "SUA_SENHA";
$dbname   = "simulado";

// Realizamos a conexão com o banco de dados.
$conn = new PDO(
    'mysql:host='.$servidor.';dbname='.$dbname, $usuario, $senha);

// Construimos nossa query de consulta.
$queryString = 'SELECT * FROM cadastro';

// execucamos a pesquisa, retornando todos os registros da tabela cadastro.
$data = $conn->query($queryString);

// Realizamos um laço de repetição para percorrer cada registro retornado do DB.
foreach ($data as $value) {
    // Csonfiguramos um nome único para o QR Code.
    $qrCodeName = "imagem_qrcode_{$value['matricula']}.png";

    /**
     * Realizamos a criação da imagem PNG, sendo passado as seguintes informaões:
     * 1º - A string que desejamos inserir no QR Code.
     * 2º - O nome da imagem que criamos no passo anterior.
     */
    QRcode::png($value['matricula'], $qrCodeName);
    
    // Para finalizar realizamos a ezibição da imagem no navegador.
    echo "<img src='{$qrCodeName}'>";
}