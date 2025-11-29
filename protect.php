<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    echo('<!DOCTYPE html><html lang="en"> ');
    echo('<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"> ');
    echo('<title> 403 Não autorizado</title><link rel="stylesheet" href="app/css/error_page.css"></head> ');
    echo('<body><div class="error-container"><h1> 403</h1>');
    die("<p>Você não pode acessar esta página porque não está logado.</p><p><a href=\"index.php\">Início</a></p>");
}
