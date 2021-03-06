<?php

function kapcsolodas($kapcsolati_szoveg, $felhasznalonev = '', $jelszo = '')
{
  $pdo = new PDO($kapcsolati_szoveg, $felhasznalonev, $jelszo);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $pdo;
}

function lekerdezes($kapcsolat, $sql, $parameterek = [])
{
  $stmt = $kapcsolat->prepare($sql);
  $stmt->execute($parameterek);
  return $stmt->fetchAll();
}

function vegrehajtas($kapcsolat, $sql, $parameterek = [])
{
  return $kapcsolat
    ->prepare($sql)
    ->execute($parameterek);
}

$db = kapcsolodas(
  "mysql:host=localhost;dbname=wf2_kojg0x;charset=utf8",
  "kojg0x",
  "kojg0x"

  // "mysql:host=localhost;dbname=bori_recept;charset=utf8",
  // "bori",
  // "bori"
);
