<?php

include 'suporte/sessao.php';
session_destroy();
header("Location: index.php");
