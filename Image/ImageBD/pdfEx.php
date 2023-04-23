<?php 
require '/Users/cliente/DS1-Project/DS1-Project/vendor/autoload.php';

 
$conexao = mysqli_connect("localhost", "root", "", "gamerx") or print(mysqli_connect_error());
$Games = $conexao->query("SELECT * FROM `Historico` ORDER BY `DeleteAT` DESC");

$max_jogos_por_pagina = 10;

$conteudo_pdf_array = array();

$jogos_count = 0;

$conteudo_pdf = '';
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
    $conteudo_pdf.='<div class="container px-4 px-lg-5 mt-5">';
    $conteudo_pdf.=' <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" >';
    $conteudo_pdf.='     <div class="col mb-5 border border-warning">';
    $conteudo_pdf.='        <div class="card h-30">';
    $conteudo_pdf.= '         <h1><img src="'.$base64.'" width="150" height="150"/></h1>';
    $conteudo_pdf.='               <div class="card-body p-4">';
    $conteudo_pdf.='                  <div class="text-center">';
    $conteudo_pdf.='                    <h5 class="fw-bolder">'.$Result["Titulo"].'';
    $conteudo_pdf.='                    </h5>';
    $conteudo_pdf.='                      <p>';
    $conteudo_pdf.='                       <span class="console"><i class="fa-brands fa-playstation fa-beat"></i>';
    $conteudo_pdf.='                                      '.$Result["Plataforma"].'';
    $conteudo_pdf.='    <i class="fa-brands fa-playstation fa-beat"></i>';
    $conteudo_pdf.='                        </span>';
    $conteudo_pdf.='                    </p>';
    $conteudo_pdf.='                 </div>';
    $conteudo_pdf.='              </div>';
    $conteudo_pdf.='          </div>';
    $conteudo_pdf.='        </div>';
    $conteudo_pdf.='       </div>';
    $conteudo_pdf.='       <br><br>';
    
    $jogos_count++;
}

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