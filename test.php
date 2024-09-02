<?php
require_once __DIR__ . '/vendor/autoload.php';

use AmMokhtari\AlertManager\Alert;

//---Test------------------------------------
session_start();

session_unset();
session_destroy();

Alert::addDangerMessage('danger alert');
Alert::addSuccessMessage('successfully');

var_dump(Alert::getDangers());
echo '<br>';
var_dump(Alert::all());
echo '<br>';
var_dump(Alert::pullSuccesses());
echo '<br>';
var_dump(Alert::pullAll());
echo '<br>';
var_dump(Alert::all());

/* output:
    array(1) { [0]=> string(12) "danger alert" }
    array(2) { ["danger"]=> array(1) { [0]=> string(12) "danger alert" } ["success"]=> array(1) { [0]=> string(12) "successfully" } }
    array(1) { [0]=> string(12) "successfully" }
    array(1) { ["danger"]=> array(1) { [0]=> string(12) "danger alert" } }
    array(0) { }
*/

echo '<br><br>';

Alert::addNormalMessage('normally');
Alert::addWarningMessage('1 w');
Alert::addWarningMessage('2 w');

var_dump(Alert::all());
echo '<br>';

Alert::forgetOneWarning(0);
var_dump(Alert::all());
echo '<br>';
Alert::forgetNormals();
var_dump(Alert::all());
echo '<br>';
Alert::forgetAll();
var_dump(Alert::all());
echo '<br>';

/* output:
    array(2) { ["info"]=> array(1) { [0]=> string(8) "normally" } ["warning"]=> array(2) { [0]=> string(3) "1 w" [1]=> string(3) "2 w" } }
    array(2) { ["info"]=> array(1) { [0]=> string(8) "normally" } ["warning"]=> array(1) { [1]=> string(3) "2 w" } }
    array(1) { ["warning"]=> array(1) { [1]=> string(3) "2 w" } }
    array(0) { }
*/

echo '<br><br><br><hr><br><br><br>';
/*----------------------------------------------*/

Alert::addDangerMessage('danger flash', true);
Alert::addSuccessMessage('success flash', true);
Alert::addNormalMessage('normal flash', true);

var_dump(Alert::pullDangerFlashes());
echo '<br>';
var_dump(Alert::pullAllFlashes());
echo '<br>';
var_dump(Alert::pullAllFlashes());
echo '<br>';

/* output:
    array(1) { [0]=> string(12) "danger flash" }
    array(2) { ["success"]=> array(1) { [0]=> string(13) "success flash" } ["info"]=> array(1) { [0]=> string(12) "normal flash" } }
    array(0) { }
*/