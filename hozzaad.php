<?php
include("auth.php");
include("database.php");
$mennyisegek = lekerdezes($db, "select distinct amount from sz_ingredients");
$mertekegysegek = lekerdezes($db, "select distinct mertekegyseg from sz_amounts");
$hozzavalok = lekerdezes($db, "select distinct name from sz_ingredients");


?>

<input list="amounts_" name="amounts[~]" placeholder="mennyiségek" type="number" min="1" required>
<datalist id="amounts_">
  <?php
  foreach ($mennyisegek as $mennyiseg) {
    echo '<option value =\'' . $mennyiseg['amount'] . '\'>';
  }
  ?>
</datalist>

<input list="mertekek_" name="mertekek[~]" placeholder="mértékegységek" required>
<datalist id="mertekek_">
  <?php
  foreach ($mertekegysegek as $mertekegyseg) {
    echo '<option value =\'' . $mertekegyseg['mertekegyseg'] . '\'><br>';
  }
  ?>
</datalist>

<input list="ingredients_" name="ingredients[~]" placeholder="hozzávalók" required>
<datalist id="ingredients_">
  <?php
  foreach ($hozzavalok as $hozzavalo) {
    echo '<option value =\'' . $hozzavalo['name'] . '\'><br>';
  }
  ?>
</datalist><br>