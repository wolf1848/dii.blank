<?php
//Имя файла должно соответствовать имени класса без Table
namespace Dii\Blank;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\EnumField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class DefaultTable extends DataManager{

    public static function getTableName(){
        //Указываем имя таблицы
        return 'dii_blank_table';
    }

    public static function getMap(){
        //Описываем поля
        // Подробнее https://dev.1c-bitrix.ru/learning/course/?COURSE_ID=43&LESSON_ID=4803&LESSON_PATH=3913.5062.5748.4803
        return [
            new IntegerField('ID', [
                'autocomplete' => true,
                'primary' => true,
                'title' => Loc::getMessage('DII_BLANK_ID'),
            ]),
            new StringField('NAME', [
                'required' => true,
                'title' => Loc::getMessage('DII_BLANK_NAME'),
                'default_value' => function () {
                    return Loc::getMessage('DII_BLANK_NAME_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return [
                        new Validator\Length(null, 255),
                    ];
                }
            ]),
            new EnumField('NAME_LIST', [
                'required' => true,
                'title' => Loc::getMessage('DII_BLANK_NAME_LIST'),
                'values' => ['Вариант1','Вариант2','Вариант3']
            ])
        ];
    }


}
