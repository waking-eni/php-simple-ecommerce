<?php

/*
Script for logging out
*/

session_start();
session_destroy();
header("Location: ../public/index.php");
