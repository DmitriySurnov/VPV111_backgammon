<?php

require_once "Classes/DataModel/LayoutDataModel.php";
require_once "Classes/GlobalsUtility.php";

use Classes\DataModel\LayoutDataModel;
use Classes\GlobalsUtility;

$globalsUtility = new GlobalsUtility();
$layoutDataModel = $globalsUtility -> GetLayoutDataModel();

$layoutDataModel -> SetPageName("ВелкоМЕЕЕ.");
$layoutDataModel -> AddBodySegment("<h1>Велкоме то Шашенбеш</h1>");
$layoutDataModel -> AddBodySegment('<a href="game.php"><button>Стартуемо игру мана!!!</button></a>');

require_once "Layout/layout.inc";