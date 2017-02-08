<?php

class PluginLssoftFeedback_ModuleMain_EntityFeedback extends EntityORM
{
    protected $aRelations = array(
        'user' => array(self::RELATION_TYPE_BELONGS_TO, 'ModuleUser_EntityUser', 'user_id'),
    );

    public function __construct($aParam = false)
    {
        $this->aValidateRules = array(
            array('user_name', 'string', 'allowEmpty' => true, 'min' => 1, 'max' => 200, 'label' => $this->Lang_Get('plugin.lssoft_feedback.field.name.label')),
            array('user_mail', 'email', 'allowEmpty' => true, 'label' => $this->Lang_Get('plugin.lssoft_feedback.field.mail.label')),
            array('text', 'string', 'allowEmpty' => false, 'min' => 1, 'max' => 2000, 'label' => $this->Lang_Get('plugin.lssoft_feedback.field.text.label')),
            array('user_name', 'name_check'),
            array('user_mail', 'mail_check'),
            array('text,user_name,user_mail', 'filter_escape'),
        );
        parent::__construct($aParam);
    }

    /**
     * Выполняется перед сохранением
     *
     * @return bool
     */
    protected function beforeSave()
    {
        if ($this->_isNew()) {
            if (!$this->getDateCreate()) {
                $this->setDateCreate(date("Y-m-d H:i:s"));
            }
            if (!$this->getIpCreate()) {
                $this->setIpCreate(func_getIp());
            }
        }
        return true;
    }

    /**
     * Проверка имени
     *
     * @param string $sValue Валидируемое значение
     * @param array $aParams Параметры
     * @return bool
     */
    public function ValidateNameCheck($sValue, $aParams)
    {
        if (!$this->_hasValidateErrors()) {
            if (!$this->getUserId() and !$sValue) {
                return $this->Lang_Get('plugin.lssoft_feedback.field.name.error_empty');
            }
            if (!$sValue) {
                $this->setUserName(null);
            }
        }
        return true;
    }

    /**
     * Проверка почты
     *
     * @param string $sValue Валидируемое значение
     * @param array $aParams Параметры
     * @return bool
     */
    public function ValidateMailCheck($sValue, $aParams)
    {
        if (!$this->_hasValidateErrors()) {
            if (!$this->getUserId() and !$sValue) {
                return $this->Lang_Get('plugin.lssoft_feedback.field.mail.error_empty');
            }
            if (!$sValue) {
                $this->setUserMail(null);
            }
        }
        return true;
    }

    /**
     * Возвращает емайл пользователя с учетом его типа
     *
     * @return string
     */
    public function getUserMailDisplay()
    {
        if ($oUser = $this->getUser()) {
            return htmlspecialchars($oUser->getMail());
        } else {
            return htmlspecialchars($this->getUserMail());
        }
    }

    /**
     * Возвращает имя пользователя с учетом его типа
     *
     * @return string
     */
    public function getUserNameDisplay()
    {
        if ($oUser = $this->getUser()) {
            return htmlspecialchars($oUser->getDisplayName());
        } else {
            return htmlspecialchars($this->getUserName());
        }
    }
}