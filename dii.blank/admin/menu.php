<?
//Добавить вкладку типа (контент , настройки, магазин) здесь нельзя
//Но вклиниться в них можно но в данном случае используется кастомная вкладка
//https://dev.1c-bitrix.ru/learning/course/?COURSE_ID=43&LESSON_ID=5187&LESSON_PATH=3913.4609.5187
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
//Массив пунктов меню
$aMenu[] = [
    "parent_menu" => "global_menu_custom",//Родительская вкладка
    "text" => Loc::getMessage('DII_BLANK_TEXT_MENU'),
    "icon" => "util_menu_icon",
    "page_icon" => "util_page_icon",
    'items' => [
        [
            'text' => Loc::getMessage('DII_BLANK_SUBMENU_TEXT'),
            'url' => 'blank_index.php?param1=paramval&lang=' . LANGUAGE_ID,
            'more_url' => array('blank_index.php?param1=paramval&lang=' . LANGUAGE_ID),
            'title' => Loc::getMessage('DII_BLANK_SUBMENU_TITLE'),
        ]
    ]
];

return $aMenu;
