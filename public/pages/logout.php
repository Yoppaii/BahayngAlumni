<?php

require __DIR__ . '/../../admin/inc/essentials.php';

session_start();
session_destroy();
redirect('index.php');
