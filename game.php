<?php

require_once "Classes/DataModel/LayoutDataModel.php";
require_once "Classes/GlobalsUtility.php";

use Classes\GlobalsUtility;

$globalsUtility = new GlobalsUtility();
$layoutDataModel = $globalsUtility -> GetLayoutDataModel();

$layoutDataModel -> SetPageName("Бой насяльника.");
$layoutDataModel -> IncludeCss("Board");
$layoutDataModel -> IncludeCss("ChipContainer");
$layoutDataModel -> IncludeJsLink("https://code.jquery.com/jquery-3.7.1.js");
$layoutDataModel -> IncludeJsText(<<<JS_CODE

    $(".Board > div:nth-child(2) > div > div > div:nth-child(1) .ChipContainer")
        .html(`<div class="ChipPlace_1"></div>
            <div class="ChipPlace_2"></div>
            <div class="ChipPlace_3"></div>
            <div class="ChipPlace_4"></div>
            <div class="ChipPlace_5"></div>
            <div class="ChipPlace_6"></div>`);
    $(".Board > div:nth-child(2) > div > div > div:nth-last-child(1) .ChipContainer")
        .html(`<div class="ChipPlace_6"></div>
            <div class="ChipPlace_5"></div>
            <div class="ChipPlace_4"></div>
            <div class="ChipPlace_3"></div>
            <div class="ChipPlace_2"></div>
            <div class="ChipPlace_1"></div>`);

JS_CODE);

$layoutDataModel -> IncludeJsText(<<<JS
    
     import chipsPlacer from "/JS/ChipsPlacer.js"

     chipsPlacer.PlaceFirstChip();

    JS);

$topLeftChipContainers = ChipContainerGenerator(6, 11, true);
$topRightChipContainers = ChipContainerGenerator(0, 5, true);
$bottomLeftChipContainers = ChipContainerGenerator(12, 17, false);
$bottomRightChipContainers = ChipContainerGenerator(18, 23, false);

$layoutDataModel -> AddBodySegment(<<<BODY
    <div class="Board">
        <div></div>
        <div>
            <div></div>
            <div>
                <div> <!-- Left field part -->
                    <div><!-- Top left field part -->
                        $topLeftChipContainers
                    </div>
                    <div id="Dice_left_container"></div><!-- Dice left field part -->
                    <div><!-- Bottom left field part -->
                        $bottomLeftChipContainers
                    </div>
                </div>
                <div></div> <!-- Middle field part -->
                <div> <!-- Right field part -->
                    <div><!-- Top right field part -->
                        $topRightChipContainers
                    </div>
                    <div  id="Dice_right_container"></div><!-- Dice right field part -->
                    <div><!-- Bottom right field part -->
                        $bottomRightChipContainers
                    </div>
                </div>
            </div>
            <div></div>
        </div>
        <div></div>
    </div>
BODY);

require_once "Layout/layout.inc";

function ChipContainerGenerator(int $firstIndex, int $lastIndex, bool $isReverseId): string
{
    $result = "";

    for ($counter = 0; $counter <= $lastIndex - $firstIndex; $counter++){
        $currentId = $isReverseId ? $lastIndex - $counter : $firstIndex + $counter;
        $chipContainer = <<<CHIP_CONTAINER
            <div id="Chip_container_$currentId" class="ChipContainer"></div>
        CHIP_CONTAINER;

        $result .= $chipContainer;
    }

    return $result;
}

