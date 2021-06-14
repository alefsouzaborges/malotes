<?php


if($nivel = "Administrador"){
   $sqlAdmin = "UPDATE permissoes SET cadUsuarios = :cadUsuarios, cadUnidades =:cadUnidades,cadMotoristas = :cadMotoristas, cadTransportes = :cadTransportes, cadTipos = :cadTipos, relUsuarios =:relUsuarios, relUnidades =:relUnidades,relMotoristas = :relMotoristas,relTransportes =:relTransportes,relTipos =:relTipos, relMalotesRejeitados =:relMalotesRejeitados, relmalotesEmEspera =:relmalotesEmEspera, relMalotesRecebidos =:relMalotesRecebidos, relMalotes = :relMalotes, opLancarMalotes =:opLancarMalotes, opListarMalotes =:opListarMalotes, opAlterarSituacaoMalotes =:opAlterarMalotes, opListarUsuarios =:opListarUsuarios, opListarUnidades =:opListarUnidades, opListarMotoristas =:opListarMotoristas, opListarTransportes =:opListarTransportes, opListarTipos =:opListarTipos, opTrocarSenha =:opTrocarSenha WHERE prUsuario =:id";
      $sqlAdmin = $pdo->prepare($sqlAdmin);
      /////////////////////////////////////////////////ATUALIZANDO AS PERMISSÕES DE CADASTROS//////////////////////////////////////////////
      $sqlAdmin->bindValue(':cadUsuarios', "S");
      $sqlAdmin->bindValue(':cadUnidades', "S");
      $sqlAdmin->bindValue(':cadMotoristas', "S");
      $sqlAdmin->bindValue(':cadTransportes', "S");
      $sqlAdmin->bindValue(':cadTipos', "S");
      ////////////////////////////////////////////////ATUALIZANDO AS PERMISSÕES DE RELATÓRIOS//////////////////////////////////////////////
      $sqlAdmin->bindValue(':relUsuarios', "S");
      $sqlAdmin->bindValue(':relUnidades', "S");
      $sqlAdmin->bindValue(':relMotoristas', "S");
      $sqlAdmin->bindValue(':relTransportes', "S");
      $sqlAdmin->bindValue(':relTipos', "S");
      $sqlAdmin->bindValue(':relMalotesRejeitados', "S");
      $sqlAdmin->bindValue(':relmalotesEmEspera', "S");
      $sqlAdmin->bindValue(':relMalotesRecebidos', "S");
      $sqlAdmin->bindValue(':relMalotes', "S");
      ////////////////////////////////////////////////ATUALIZANDO AS PERMISSÕES DE OPERAÇÕES//////////////////////////////////////////////
      $sqlAdmin->bindValue(':opLancarMalotes', "S");
      $sqlAdmin->bindValue(':opListarMalotes', "S");
      $sqlAdmin->bindValue(':opAlterarMalotes', "S");
      $sqlAdmin->bindValue(':opListarUsuarios', "S");
      $sqlAdmin->bindValue(':opListarUnidades', "S");
      $sqlAdmin->bindValue(':opListarMotoristas', "S");
      $sqlAdmin->bindValue(':opListarTransportes', "S");
      $sqlAdmin->bindValue(':opListarTipos', "S");
      $sqlAdmin->bindValue(':opTrocarSenha', "S");
      $sqlAdmin->bindValue(':id', $usuarioId);
      $sqlAdmin->execute();
}

  íf($nivel == "Administrador"){
     
    }


?>