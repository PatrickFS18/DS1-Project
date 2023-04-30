<?php 
require '/Users/cliente/DS1-Project/DS1-Project/vendor/autoload.php';

 
$conexao = mysqli_connect("localhost", "root", "", "gamerx") or print(mysqli_connect_error());
$Games = $conexao->query("SELECT * FROM `Historico` ORDER BY `DeleteAT` DESC");

$max_jogos_por_pagina = 12;

$conteudo_pdf_array = array();

$jogos_count = 0;

$conteudo_pdf = '<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>PDF jogos excluidos</title>
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"
         id="bootstrap-css">
     
   </head>
   <body>';
if($Games){
while ($Result = $Games->fetch_assoc()) {
    if ($jogos_count == $max_jogos_por_pagina) {
        $conteudo_pdf_array[] = $conteudo_pdf;
        $conteudo_pdf = '';
        $jogos_count = 0;
    }
    $NomeImage = $Result["Image"];
    $NomeImage = basename($NomeImage);
    $path = $NomeImage;
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    $conteudo_pdf.='<div class="card" style="width: 18rem;">';
    $conteudo_pdf.='<img src="'.$base64.'" class="card-img-top" style="width:150px;height:150px">';
    $conteudo_pdf.='<div class="card-body">';
    $conteudo_pdf.='<h5 class="card-title">'.$Result["Titulo"].'</h5>';
    $conteudo_pdf.='<p class="card-text">'.$Result["Plataforma"].'</p>';
    $conteudo_pdf.='</div>';
    $conteudo_pdf.='</div>';
    $conteudo_pdf.='<br><br>';
    
    
    $jogos_count++;
}
$conteudo_pdf .= '</body></html>';

$conteudo_pdf_array[] = $conteudo_pdf;
}
use Dompdf\Dompdf;
use Dompdf\Options;
$options=new Options;
$options-> set('chroot',realpath(''));
$dompdf = new Dompdf($options);

foreach($conteudo_pdf_array as $conteudo) {
    $dompdf->loadHtml($conteudo);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream();
}
mysqli_close($conexao);