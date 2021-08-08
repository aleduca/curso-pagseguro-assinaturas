<?php 
require '../config.php';
use App\Classes\Logado;
use App\Classes\User;
use App\Models\Assinantes;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dados da assinatura do cliente</title>
       <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.css">  
        <link rel="stylesheet" href="../public/assets/css/styles.css">
       <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<body>
    <div id="container" style="width:800px;margin:0 auto;">
        
        <a href="/" class="ui green button">Voltar para a página inicial</a>    
        
        <h2>Área do Cliente</h2>

        <div id="message"></div>
        
        <?php if(!Logado::logado()): ?>
            <p>Área restrita para usuários logados</p>
            <a href="/" class="ui red button">Voltar para a página incial</a>
        <?php else: ?>
            <?php  $assinanteCadastrado = (new Assinantes)->assinantes(User::user()->id); ?>

            <?php if(!$assinanteCadastrado): ?>    
                <h3 class="ui ornage button">Você ainda não tem nenhuma assinatura</h3>
                <a href="/" class="ui red button">Voltar para a página incial</a>
            <?php else: ?>
                <div style="font-size:24px;margin:10px 0 10px 0;">
                    <?php echo statusAssinatura($assinanteCadastrado->status); ?>
                </div>

                <p style="font-weight: bold;font-size: 24px;">
                    <?php 
                        $vencimento = new DateTime($assinanteCadastrado->vencimento);
                        $agora = new DateTime('now');
                        $dias = date_diff($agora,$vencimento);
                     ?>
                     Você assinou o plano <?php echo $assinanteCadastrado->plano_assinatura; ?> que vai até 
                     <?php echo date('d/m/Y H:i:s', strtotime($assinanteCadastrado->vencimento)); ?> restando 
                     <?php echo $dias->format('%a dias');  ?>
                </p>

                <?php if($assinanteCadastrado->status == 1): ?>
                    <button class="ui red button" id="btn-cancelar" data-id="<?php echo $assinanteCadastrado->code; ?>">Cancelar Assinatura</button>

                    <button class="ui orange button" id="btn-suspender" data-id="<?php echo $assinanteCadastrado->code; ?>">Suspender Assinatura</button>
            <?php endif; ?>

            <?php if($assinanteCadastrado->status == 2): ?>
                   <button class="ui green button" id="btn-reativar" data-id="<?php echo $assinanteCadastrado->code; ?>">Reativar Assinatura</button>
            <?php endif;?>
            
        <?php endif; ?>
    <?php endif; ?>
    </div>    

   <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
   <script src="../public/assets/js/errors.js"></script>
   <script src="../public/assets/js/cancelar_assinatura.js"></script>
   <script src="../public/assets/js/suspender_ativar.js"></script>
</body>
</html>