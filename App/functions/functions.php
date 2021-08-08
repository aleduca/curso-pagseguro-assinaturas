<?php 

function statusAssinatura($status){
    switch ($status) {
        case '1':
            return "<div class='ui success message'>Seu plano esta: ATIVO</div>";
            break;
        case '2':
            return "<div class='ui orange message'>Seu plano esta: SUSPENSO</div>";
            break;
        case '3':
            return "<div class='ui red message'>Seu plano esta: CANCELADO</div>";
            break;
   
    }
}