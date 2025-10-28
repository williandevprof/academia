<?php
  $nome = 'Jose';
  $arquivo = 'Contrato, Nome: <<nome>>';

  $arquivo = str_replace('<<nome>>', $nome, $arquivo);
  

  echo $arquivo;
?>