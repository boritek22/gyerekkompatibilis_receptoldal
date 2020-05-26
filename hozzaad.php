<?php
include("auth.php");
include("database.php"); 
// $mennyisegek = lekerdezes($db, "SELECT sz_amounts.amount, sz_amounts.mertekegyseg FROM sz_recipes_ingredients JOIN sz_amounts ON sz_recipes_ingredients.amountId=sz_amounts.id");
// $hozzavalok = lekerdezes($db, "SELECT sz_ingredients.name FROM sz_recipes_ingredients JOIN sz_ingredients ON sz_recipes_ingredients.ingredientId=sz_ingredients.id"); 
$mennyisegek = lekerdezes($db, "select distinct amount from sz_ingredients");
$mertekegysegek = lekerdezes($db, "select distinct mertekegyseg from sz_amounts");
$hozzavalok = lekerdezes($db, "select distinct name from sz_ingredients");


  ?>

              <input list="amounts" name="amounts[~]" placeholder="mennyiségek" type="number" min="1" required>
              <datalist id="amounts">
                <?php
                foreach ($mennyisegek as $mennyiseg) {
                  echo '<option value =\'' . $mennyiseg['amount'] . '\'>';
                }
                ?>
              </datalist>

              <input list="mertekek" name="mertekek[~]" placeholder="mértékegységek" required>
              <datalist id="mertekegysegek">
                <?php
                foreach ($mertekegysegek as $mertekegyseg) {
                  echo '<option value =\'' . $mertekegyseg['name'] . '\'><br>';
                }
                ?>
              </datalist>

              <input list="ingredients" name="ingredients[~]" placeholder="hozzávalók" required>
              <datalist id="ingredients">
                <?php
                foreach ($hozzavalok as $hozzavalo) {
                  echo '<option value =\'' . $hozzavalo['name'] . '\'><br>';
                }
                ?>
              </datalist><br>