<?php

namespace Dii\Blank;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\EnumField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class DefaultTable extends DataManager
{
    public static function getTableName()
    {
        return 'dii_blank_table';
    }

    public static function getMap()
    {
        return array(
            new IntegerField('ID', array(
                'autocomplete' => true,
                'primary' => true,
                'title' => Loc::getMessage('DII_BLANK_ID'),
            )),
            new StringField('NAME', array(
                'required' => true,
                'title' => Loc::getMessage('DII_BLANK_NAME'),
                'default_value' => function () {
                    return Loc::getMessage('DII_BLANK_NAME_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                }
            )),
            new EnumField('NAME_LIST', array(
                'required' => true,
                'title' => Loc::getMessage('DII_BLANK_NAME_LIST'),
                'values' => ['Вариант1','Вариант2','Вариант3']
            ))
        );
    }


}
