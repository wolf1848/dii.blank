<?
//Здесь подключается автолоад написанных вами классов (классы при подключении \Bitrix\Main\Loader::includeModule('dii.blank');)
//Сущности (Классы связаные с бд ORM) Можно не подключать
\Bitrix\Main\Loader::registerAutoLoadClasses(
    "dii.blank",
    [
        "lib/system.php",
    ]
);