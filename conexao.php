<?php

$conexao = oci_connect('user', 'senha', 'host');


if (!$conexao) {
   $m = oci_error();
   echo $m['message'] . PHP_EOL;
   exit;
}
?>
