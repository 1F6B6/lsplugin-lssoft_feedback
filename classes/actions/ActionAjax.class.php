<?php

class PluginLssoftFeedback_ActionAjax extends PluginLssoftFeedback_Inherit_ActionAjax
{

    protected function RegisterEvent()
    {
        $this->AddEventPreg('/^lssoft$/i', '/^feedback$/i', '/^submit$/', '/^$/', 'EventLssoftFeedbackSubmit');
        $this->AddEventPreg('/^lssoft$/i', '/^feedback$/i', '/^modal$/', '/^$/', 'EventLssoftFeedbackModal');
        parent::RegisterEvent();
    }

    public function EventLssoftFeedbackSubmit()
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
                $oFeedback->setText(htmlspecialchars($this->Lang_Get('plugin.lssoft_feedback.field.referer.from') . ' ' . $_SERVER['HTTP_REFERER']) . "\n" . $oFeedback->getText());
            }
            if ($oFeedback->Add()) {
                $this->PluginLssoftFeedback_Main_NotifySend($oFeedback);
                return $this->Message_AddNotice($this->Lang_Get('plugin.lssoft_feedback.submit.send'));
            } else {
                return $this->Message_AddError($this->Lang_Get('common.error.error'));
            }
        } else {
            return $this->Message_AddError($oFeedback->_getValidateError(), $this->Lang_Get('common.error.error'));
        }
    }

    public function EventLssoftFeedbackModal()
    {
        $this->Viewer_Assign('oUserCurrent', $this->oUserCurrent);
        $this->Viewer_AssignAjax('sText', $this->Viewer_Fetch('component@lssoft_feedback:p-feedback.modal-feedback'));
    }
}