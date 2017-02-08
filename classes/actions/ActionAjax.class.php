<?php

class PluginLssoftFeedback_ActionAjax extends PluginLssoftFeedback_Inherit_ActionAjax
{

    protected function RegisterEvent()
    {
        $this->AddEventPreg('/^feedback$/i', '/^submit$/', '/^$/', 'EventFeedbackSubmit');
        parent::RegisterEvent();
    }

    public function EventFeedbackSubmit()
    {
        $oFeedback = Engine::GetEntity('PluginLssoftFeedback_ModuleMain_EntityFeedback');
        $oFeedback->setText(getRequestStr('text'));
        if ($this->oUserCurrent) {
            $oFeedback->setUserId($this->oUserCurrent->getId());
        } else {
            $oFeedback->setUserName(getRequestStr('name'));
            $oFeedback->setUserMail(getRequestStr('mail'));
        }

        if ($oFeedback->_Validate()) {
            if (isset($_SERVER['HTTP_REFERER']) and $this->Validate_Validate('url', $_SERVER['HTTP_REFERER'], array('allowEmpty' => false))) {
                $oFeedback->setText(htmlspecialchars('Сообщение отправлено со страницы: ' . $_SERVER['HTTP_REFERER']) . "\n" . $oFeedback->getText());
            }
            if ($oFeedback->Add()) {
                $this->PluginLssoftFeedback_Main_NotifySend($oFeedback);
                return $this->Message_AddNotice('Сообщение успешно отправлено');
            } else {
                return $this->Message_AddError('Возникла ошибка. Попробуйте позже.');
            }
        } else {
            return $this->Message_AddError($oFeedback->_getValidateError(), $this->Lang_Get('common.error.error'));
        }
    }
}