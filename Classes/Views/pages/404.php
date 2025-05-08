<?php
    $title = 'Página não encontrada';
    $css = ['erro'];
    $js = [''];
    include("header.php");

   
?>

<div class="box-side">
    <div class="icon"><span><i class="fa-solid fa-stethoscope"></i></span></div>
    <div class="icon"><span><i class="fa-regular fa-hourglass-half"></i></span></div>
    <div class="icon"><span><i class="fa-solid fa-heart-pulse"></i></span></div>
    <div class="icon"><span><i class="fa-regular fa-clock"></i></span></div>
    <div class="icon"><span><i class="fa-solid fa-pills"></i></span></div>  
</div>
<div class="container-404">
    <div class="logo">MedClock</div>
    <h1>404</h1>
    <h2>Página não encontrada</h2>
    <p>Não foi possível encontrar a página solicitada, verifique a URL e tente novamente mais tarde!</p>
    <a href="<?php echo INCLUDE_PATH;?>">Voltar ao site</a>
</div>


<?php
    include("footer.php");
?>