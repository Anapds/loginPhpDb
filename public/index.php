<?php

// início da sessão 
session_start();

// carregamento das rotas permitidas 

$rotas_permitidas = require_once __DIR__ . '/../inc/rotas.php';

// definição de rota 

$rota = $_GET['rota'] ?? 'home';

// verifica se o usuario esta logado 

if (!isset($_SESSION['usuario'])) {
    $rota = "login";
}

// se o usuario esta logado e tenta entrar no login..

if (!isset($_SESSION['usuario']) && $rota === 'login') {
    $rota = 'home';
}

if (!in_array($rota, $rotas_permitidas)) {
    $rota = '404';
}

// preparação da pagina

$script = null;
switch ($rota) {
    case '404':
        $script = '404.php';
        break;

    case 'login':
        $script = 'login.php';
        break;
    case 'home':
        $script = 'home.php';
        break;
}

// apresentação da pagina

require_once __DIR__ . "/../inc/header.php";

require_once __DIR__ . "/../scripts/$scripts";

require_once __DIR__ . "/../inc/footer.php";