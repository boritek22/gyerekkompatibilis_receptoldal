<?php
include("auth.php");
session_start();
kijelentkeztet();
header("Location: index.php");
