<?php
session_start();
if (isset($_SESSION['name']) && isset($_SESSION['role'])) {
    unset($_SESSION['name']);
    unset($_SESSION['role']);
   
    header('Location: /');
    exit();
} 
