<?
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

use Dii\Blank\DefaultTable;

Loc::loadMessages(__FILE__);

// (dii_blank) класс должен формироваться из кода партнера и id модуля
// (в id модуля запрещен символ подчеркивания "_" но в названии класса нельзя использовать точку по этому заменяем точку на подчеркивание)
class dii_blank extends CModule
{
    public function __construct()
    {
        //Свойства определяемые в конструкторе обязательны
        $arModuleVersion = array();

        require_once( __DIR__ . '/version.php');

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_ID = 'dii.blank';//id модуля (должен именоваться так же как и директория в которой лежит)
        $this->MODULE_NAME = Loc::getMessage('DII_BLANK_MODULE_NAME');//Название модуля
        $this->MODULE_DESCRIPTION = Loc::getMessage('DII_BLANK_MODULE_DESCRIPTION');//Описание модуля
        $this->MODULE_GROUP_RIGHTS = 'N';//если задан метод GetModuleRightList, то данное свойство должно содержать Y - https://dev.1c-bitrix.ru/api_help/main/reference/cmodule/getmodulerightlist.php
        $this->PARTNER_NAME = Loc::getMessage('DII_BLANK_MODULE_PARTNER_NAME');//Имя партнера
        $this->PARTNER_URI = 'http://bitrix';//Сайт партнера
    }

    //Обязательный метод для установки модуля
    public function doInstall()
    {
        //В методе удаления модуля все то же самоетолько для удаления

        //Регистрация модуля в системе
        ModuleManager::registerModule($this->MODULE_ID);
        //Вызываем метод для создания таблиц (ниже его сами и описываем)
        $this->installDB();
        //Магии в Битриксе нет по этому вызываем установку файлов
        //Так же и его описываем ниже
        $this->InstallFiles();
        //Регистрируем обработчик события генерации меню (Можно навешиваться на все события)
        //В данном случае используется для создания собственной вкладке глобального меню админки
        $eventManager = \Bitrix\Main\EventManager::getInstance();
        $eventManager->registerEventHandler("main","OnBuildGlobalMenu",$this->MODULE_ID,"\\Dii\\Blank\\System","addMenu");
    }
    //Обязательный метод для удаления модуля
    public function doUninstall()
    {
        $eventManager = \Bitrix\Main\EventManager::getInstance();
        $eventManager->unRegisterEventHandler("main","OnBuildGlobalMenu",$this->MODULE_ID,"\\Dii\\Blank\\System","addMenu");
        $this->uninstallDB();
        $this->UnInstallFiles();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }
    //Создание нужных таблиц сущьность описана в папке lib
    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            DefaultTable::getEntity()->createDbTable();
        }
    }

    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            $connection = Application::getInstance()->getConnection();
            $connection->dropTable(DefaultTable::getTableName());
        }
    }

    //Установка файлов (В данном случае скрипты для админки следите за путями установка происходит из директории /local/)
    public function InstallFiles(){
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/dii.blank/install/admin", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin", true, true);
    }

    public function UnInstallFiles()
    {
        DeleteDirFiles($_SERVER["DOCUMENT_ROOT"] . "/local/modules/dii.blank/install/admin", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin");
    }

}
