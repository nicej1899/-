<?php
require_once('../config/database.php');

unset($_SESSION['user']);
header('Location: ../login.php');
