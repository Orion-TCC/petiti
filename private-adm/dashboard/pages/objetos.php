<?php
foreach (glob("../../../../api/classes/*") as $filename) {
require_once $filename;
}
$usuario = new Usuario();
$pet = new Pet();
$categorias = new categoria();
