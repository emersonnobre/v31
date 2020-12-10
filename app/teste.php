<?php
require_once("config.php");

$alimento=new Alimento();

$sql = new Sql();
$results = $sql->select("
select id from alimentos
");

foreach ($results as $result) {
    foreach ($result as $key => $value) {
        $alimento->loadbyId($value);
    }
}

echo $alimento->getNome();

?>