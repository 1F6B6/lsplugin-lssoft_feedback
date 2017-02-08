<?php

class PluginLssoftFeedback_ModuleMain extends ModuleORM
{
    /**
     * Отправляет емайл юзеры с ответом на обращение
     *
     * @param $oFeedback
     */
    public function NotifyReply($oFeedback)
    {
        $this->Notify_Send($oFeedback->getUserMailDisplay(), 'reply.tpl', $this->Lang_Get('plugin.lssoft_feedback.mails.reply.title'), array(
            'oFeedback' => $oFeedback,
        ), 'lssoft_feedback');
    }

    public function NotifySend($oFeedback)
    {
        $aMails = Config::Get('plugin.lssoft_feedback.notify_mail_list');
        if (!$aMails) {
            $aMails = array(Config::Get('general.admin_mail'));
        }
        foreach ($aMails as $sMail) {
            $this->Notify_Send($sMail, 'send.tpl', $this->Lang_Get('plugin.lssoft_feedback.mails.send.title'), array(
                'oFeedback' => $oFeedback,
            ), 'lssoft_feedback');
        }
    }

    public function Send($sText, $iUserId = null, $sUserName = null, $sUserMail = null)
    {
        $oFeedback = Engine::GetEntity('PluginLssoftFeedback_ModuleMain_EntityFeedback');
        $oFeedback->setText($sText);
        if ($iUserId) {
            $oFeedback->setUserId($iUserId);
        } else {
            $oFeedback->setUserName($sUserName);
            $oFeedback->setUserMail($sUserMail);
        }
        if ($oFeedback->_Validate()) {
            if ($oFeedback->Add()) {
                $this->NotifySend($oFeedback);
                return true;
            }
        }
        return false;
    }
}