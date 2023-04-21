<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class sp_editor extends CModule
{
    public $MODULE_ID = 'sp.editor';
    public $MODULE_GROUP_RIGHTS = 'N';
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $PARTNER_NAME;
    public $PARTNER_URI;

    public function __construct()
    {
        $this->MODULE_NAME = 'Sp: «Кнопки в визуальном редакторе»';
        $this->MODULE_DESCRIPTION = 'Кнопки в визуальном редакторе';
        $this->MODULE_VERSION = '1.0';
        $this->PARTNER_NAME = '';
        $this->PARTNER_URI = '';
    }

    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);

        return true;
    }

    public function DoUninstall()
    {
        ModuleManager::unRegisterModule($this->MODULE_ID);

        return true;
    }
}
