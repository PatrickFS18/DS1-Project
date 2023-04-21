<?php 
require './vendor/autoload.php';
$ID= $_POST["IDUSER"];
if($ID !=="admin"){
    #GERAR PDF PRO USUARIO DE SEUS JOGOS
$ngames= $_POST["ngames"];
 if($ngames>0){
$conexao = mysqli_connect("localhost", "root", "", "gamerx") or print(mysqli_connect_error());
$Games = $conexao->query("SELECT * FROM `registergame` WHERE `UsuarioID`='$ID'");

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
    
    $conteudo_pdf.='<div class="container px-4 px-lg-5 mt-5">';
    $conteudo_pdf.=' <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" >';
    $conteudo_pdf.='     <div class="col mb-5 border border-warning">';
    $conteudo_pdf.='        <div class="card h-30">';
    $conteudo_pdf.='              <img class="card-img-top" src="'.$Result["Image"].'" alt="..." />';
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
}else{
    header("Location:/PHP/index.php?msg=nogm");
}
}else{
    #Gerar PDF DE TODOS USUARIOS PRO ADM
    $conexao = mysqli_connect("localhost", "root", "", "gamerx") or print(mysqli_connect_error());
$Games = $conexao->query("SELECT * FROM `registergame`");

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
    $id = $conexao->query("SELECT `UsuarioID` FROM `registergame` WHERE `Plataforma`='$Result[Plataforma]' AND `Titulo`= '$Result[Titulo]' ");
    $id = $id->fetch_row();
    $id = implode($id);
    if ($id) {
      $Dono = $conexao->query("SELECT `Usuario` FROM `login` WHERE `ID` = '$id' ");
      $Dono = $Dono->fetch_row();
      $Dono = isset($Dono[0]) ? $Dono[0] : 'Não encontrado';
    }
    else {
      $Dono = 'Não encontrado';
    }
    $conteudo_pdf .= '<h1>Dono: '.$Dono.'</h1>';
    $conteudo_pdf.='<div class="container px-4 px-lg-5 mt-5">';
    $conteudo_pdf.=' <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" >';
    $conteudo_pdf.='     <div class="col mb-5 border border-warning">';
    $conteudo_pdf.='        <div class="card h-30">';
    $conteudo_pdf.='              <img class="card-img-top" src="'.$Result["Image"].'" alt="..." />';
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
}
use Dompdf\Dompdf;

$dompdf = new Dompdf();

foreach($conteudo_pdf_array as $conteudo) {
    $dompdf->loadHtml($conteudo);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream();
}
mysqli_close($conexao);