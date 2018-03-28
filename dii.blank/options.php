<?//Страница редактирования настроек модуля
//Если страница не будет существовать модуль не будет показан в настройках модулей
//Если страница будет пустой то в настройках модуль отобразиться однако настроек не будет
//Изминение настроек надо самому верстать и описывать МАГИИ НЕТ =)

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;

defined('ADMIN_MODULE_NAME') || define('ADMIN_MODULE_NAME', 'dii.blank');

if (!$USER->isAdmin()) {
    $APPLICATION->authForm('Nope');
}

$app = Application::getInstance();
$context = $app->getContext();
$request = $context->getRequest();

Loc::loadMessages($context->getServer()->getDocumentRoot()."/bitrix/modules/main/options.php");
Loc::loadMessages(__FILE__);

//Группировка настроек по вкладкам должна быть минимум 1
$tabControl = new CAdminTabControl("tabControl", array(
    array(
        "DIV" => "edit1",
        "TAB" => Loc::getMessage("DII_BLANK_TAB_1"),
        "TITLE" => Loc::getMessage("DII_BLANK_TAB_TITLE_1"),
    ),
    array(
        "DIV" => "edit12",
        "TAB" => Loc::getMessage("DII_BLANK_TAB_2"),
        "TITLE" => Loc::getMessage("DII_BLANK_TAB_TITLE_2"),
    ),
));

//Обработка сохранения настроек модуля
if ((!empty($save) || !empty($restore)) && $request->isPost() && check_bitrix_sessid()) {
    if (!empty($restore)) {
        Option::delete(ADMIN_MODULE_NAME);
        CAdminMessage::showMessage(array(
            "MESSAGE" => Loc::getMessage("DII_BLANK_DEFAULT_SETTING"),
            "TYPE" => "OK",
        ));
    } elseif (!empty($request->getPost('param1'))  && $request->getPost('param1') != Option::get(ADMIN_MODULE_NAME, "param1")){
        Option::set(
            ADMIN_MODULE_NAME,
            "param1",
            $request->getPost('param1')
        );
        CAdminMessage::showMessage(array(
            "MESSAGE" => sprintf(Loc::getMessage("DII_BLANK_PARAM_SAVE"), Loc::getMessage("DII_BLANK_PARAM_1")),
            "TYPE" => "OK"
        ));
    }elseif (!empty($request->getPost('param2'))  && $request->getPost('param2') != Option::get(ADMIN_MODULE_NAME, "param2")){
        Option::set(
            ADMIN_MODULE_NAME,
            "param2",
            $request->getPost('param2')
        );
        CAdminMessage::showMessage(array(
            "MESSAGE" => sprintf(Loc::getMessage("DII_BLANK_PARAM_SAVE"), Loc::getMessage("DII_BLANK_PARAM_2")),
            "TYPE" => "OK",
        ));
    }
}
//Определение общей области вывода
$tabControl->begin();
?>

<form method="post" action="<?=sprintf('%s?mid=%s&lang=%s', $request->getRequestedPage(), urlencode($mid), LANGUAGE_ID)?>">
    <?php
    echo bitrix_sessid_post();

    //Определение вывода согласно порядку вкладок в объекте $tabControl
    //вкладка 1
    $tabControl->beginNextTab();
    ?>
    <tr>
        <td width="40%">
            <label for="max_image_size"><?=Loc::getMessage("DII_BLANK_PARAM_1") ?>:</label>
        <td width="60%">
            <input type="text"
                   size="50"
                   maxlength="5"
                   name="param1"
                   value="<?=Option::get(ADMIN_MODULE_NAME, "param1", 1000);?>"
            />
        </td>
    </tr>
    <?
    $tabControl->EndTab();

    //вкладка 2
    $tabControl->BeginNextTab();

    ?>
    <tr>
        <td width="40%">
            <label for="max_image_size"><?=Loc::getMessage("DII_BLANK_PARAM_2") ?>:</label>
        <td width="60%">
            <input type="text"
                   size="50"
                   maxlength="5"
                   name="param2"
                   value="<?=Option::get(ADMIN_MODULE_NAME, "param2", 'тест');?>"
            />
        </td>
    </tr>
    <?$tabControl->EndTab();

//Понятное дело подключение кнопок
    $tabControl->buttons();
    ?>
    <input type="submit"
           name="save"
           value="<?=Loc::getMessage("MAIN_SAVE") ?>"
           title="<?=Loc::getMessage("MAIN_OPT_SAVE_TITLE") ?>"
           class="adm-btn-save"
    />
    <input type="submit"
           name="restore"
           title="<?=Loc::getMessage("MAIN_HINT_RESTORE_DEFAULTS") ?>"
           onclick="return confirm('<?= AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING")) ?>')"
           value="<?=Loc::getMessage("MAIN_RESTORE_DEFAULTS") ?>"
    />
    <?php
    $tabControl->end();
    ?>
</form>