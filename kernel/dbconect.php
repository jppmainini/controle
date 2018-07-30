<?php
$host = "localhost";         //servidor onde o banco de dados esta hospedado
$user = "root";         //usuario do banco de dados
$password = "893951";     //senha do banco de dados
$database = "controle";     //nome da base de dados

$dbConect = mysqli_connect($host, $user, $password) or die("Erro ao conectar no Banco de Dados: ");
mysqli_select_db($dbConect, $database);