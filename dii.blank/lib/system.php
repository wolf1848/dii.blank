<?
namespace Dii\Blank;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class System{

    public static function addMenu(&$aGlobalMenu, &$aModuleMenu){
        $aGlobalMenu["global_menu_custom"] = [
            "menu_id" => "custom",
            "page_icon" => "services_title_icon",
            "index_icon" => "services_page_icon",
            "text" => Loc::getMessage('DII_BLANK_TEXT'),
            "title" => Loc::getMessage('DII_BLANK_TITLE'),
            "sort" => 900,
            "items_id" => "global_menu_custom",
            "help_section" => "custom",
            "items" => []
        ];
    }

}