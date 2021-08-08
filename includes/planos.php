<div class="ui three columns stackable grid">

  <?php 
    $planos = new App\Models\Planos;
    $planoNo = 1;
    foreach($planos->fetchAll() as $plano):
   ?>
      <div class="column">
          <div class="ui segments plan">
              <div class="ui top attached segment violet inverted plan-title">
                  <span class="plan-ribbon yellow"><?php echo $plano->plano_assinatura; ?></span>
                  <span class="ui header">Plano <?php echo $planoNo; ?></span>
              </div>
              <div class="ui  attached segment feature">
                <span class="regular-price"></span>
                <span class="amount">R$ <?php echo number_format($plano->valor,2,',','.'); ?></span>
              </div>
              <div class="ui  attached secondary segment feature">
                <i class="icon red remove"></i>  
                Plano com acesso VIP
              </div>
              <div class="ui  attached segment feature">
                <i class="icon red remove"></i>
                Acesso a todas as aulas
              </div>            
              <div class="ui bottom attached violet button btn-plan">
              <input type="radio" value="<?php echo $plano->code_assinatura; ?>" name="plano" id="plano"> 
                  Selecionar Plano
              </div>
          </div>
      </div>
<?php 
$planoNo++;
endforeach; 
?>
</div>