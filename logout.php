<?php
require 'config.inc.php';
session_destroy();
unset($_SESSION);

header('Location: index.php');

