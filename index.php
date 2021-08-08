<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pagamento Recorrente Transparente</title>
    <link rel="stylesheet" href="public/assets/css/semantic.min.css">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
    <link rel="stylesheet" href="public/assets/css/styles.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<body>

<div class="container" style="width:800px;margin:0 auto;">

<section style="background-color: #efefef;padding:5px;">

  <?php if(!App\Classes\Logado::logado()):  ?>
  <form action="/pages/login.php" method="post" class="ui form">
    <div class="fields">
      <div class="field">
        <input type="text" name="email">
      </div>

      <div class="field">
        <input type="password" name="password">
      </div>

    <button type="submit" class="ui green button">Logar</button>

    </div>
  </form>
<?php else: ?>
  <div style="width: 400px;float: left;">
    <h2>  
      <i class="fa da-user-circle-o" aria-hidden="true"></i>
      Bem Vindo <?php echo (App\Classes\User::user())->name; ?>
    </h2>
  </div>

  <div style="width: 250px;float: right;margin-top:20px">
    <a href="/pages/logout.php" class="ui red button">Logout</a>
    <a href="/pages/cliente.php" class="ui green button">Ver assinatura</a>
  </div>

  <div style="clear:both"></div>
<?php endif; ?>
</section>

  <h2>Assinaturas com pagseguro</h2>

  <hr>
  <br>

    <div id="message"></div>
 
    <div>
       <form class="ui form" id="form-fechar-pedido">
          <div class="fields">
                <div class="field">
                  <label>Número do cartão</label>
                  <input type="text" id="numero" placeholder="número" value="4111111111111111">
                </div>
                <div class="field">
                  <label>Nome no cartão</label>
                  <input type="text" id="nome" placeholder="nome" value="Alexandre Cardoso">
                </div>
                <div class="field">
                  <label>CVV</label>
                  <input type="text" id="cvv" placeholder="dígitos" value="123">
                </div>
            </div>

            <div class="fields">
                <div class="field">
                  <label>Validade Mês</label>
                  <input type="text" id="validade-mes" placeholder="mês validade" value="12">
                </div>
                <div class="field">
                  <label>Validade Ano</label>
                  <input type="text" id="validade-ano" placeholder="ano validade" value="2030">
                </div>
                <div class="field">
                  <label>Cartão</label>
                  <select id="bandeira">
                      <option value="">Escolha um cartão</option>
                  </select>
                </div>
          </div>

          <div class="ui divider"></div>
          <button class="ui green button" id="btn-assinar" tabindex="0">Assinar</button>
          <button class="ui orange button" id="btn-criar-plano" tabindex="0">Criar Plano</button>
       </form>
      
      <div class="ui divider"></div>
      <h2>Planos</h2>

      <div class="ui container">
        <?php require 'includes/planos.php' ?>
      </div>
      
        <div class="ui divider"></div>
          <h3>Cartões Aceitos</h3>
        <div>
            <div class="ui grid container bancos" style="margin-top:10px;font-size:11px;text-align:center;">
            </div>
        </div>
    </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js">
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js'></script>
<script src="public/assets/js/app.js"></script>
<script src="public/assets/js/errors.js"></script>
<script src="public/assets/js/listar-bandeiras.js"></script>
<script src="public/assets/js/obter-bandeira.js"></script>
<script src="public/assets/js/criar_plano.js"></script>
<script src="public/assets/js/assinar_plano.js"></script>

</body>
</html>