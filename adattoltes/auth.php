<?php
function beleptet($felhasznalo) {
  $_SESSION["felhasznalo"] = $felhasznalo;
}

function azonositott_e() {
  return isset($_SESSION["felhasznalo"]);
}

function kijelentkeztet() {
  unset($_SESSION["felhasznalo"]);
}
