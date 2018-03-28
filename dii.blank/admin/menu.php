<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$aMenu[] = [
    "parent_menu" => "global_menu_custom",
    "text" => Loc::getMessage('DII_BLANK_TEXT_MENU'),
    "icon" => "util_menu_icon",
    "page_icon" => "util_page_icon",
    'items' => array(
            array(
                'text' => Loc::getMessage('DII_BLANK_SUBMENU_TEXT'),
                'url' => 'blank_index.php?param1=paramval&lang=' . LANGUAGE_ID,
                'more_url' => array('blank_index.php?param1=paramval&lang=' . LANGUAGE_ID),
                'title' => Loc::getMessage('DII_BLANK_SUBMENU_TITLE'),
            ),
        )
];

return $aMenu;
