<?
namespace Dii\Blank;
use BBitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class System{

    public static function addMenu(&$aGlobalMenu, &$aModuleMenu){
        Loader::includeModule('dii.blank');
        die(123);
        $aGlobalMenu["global_menu_custom"] = [
            "menu_id" => "custom",
            "page_icon" => "services_title_icon",
            "index_icon" => "services_page_icon",
            "text" => 'text',//Loc::getMessage('DII_BLANK_TEXT'),
            "title" => 'title',//Loc::getMessage('DII_BLANK_TITLE'),
            "sort" => 900,
            "items_id" => "global_menu_custom",
            "help_section" => "custom",
            "items" => []
        ];
    }

}