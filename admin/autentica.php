<?php

//autentica.php
session_start();

//estas são as sessoes principais do meu site.
if (!isset($_SESSION['nome']) && !isset($_SESSION['usuario'])) {
    $msg = md5('expirou');
    header('location:login.php?msg=' . $msg);
} 