<?php
session_start();
include_once "../../kernel/seguranca.php";
include_once "../../kernel/dbconect.php";

var_dump($_POST);

if(isset($_POST['btn-gravar-ocorrencia'])){
    echo "existe";
}