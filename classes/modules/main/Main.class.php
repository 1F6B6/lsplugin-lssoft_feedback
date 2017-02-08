<?php

/**
 * LiveStreet CMS
 * Copyright © 2013 OOO "ЛС-СОФТ"
 *
 * ------------------------------------------------------
 *
 * Official site: www.livestreetcms.com
 * Contact e-mail: office@livestreetcms.com
 *
 * GNU General Public License, version 2:
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * ------------------------------------------------------
 *
 * @link http://www.livestreetcms.com
 * @copyright 2013 OOO "ЛС-СОФТ"
 * @author Maxim Mzhelskiy <rus.engine@gmail.com>
 *
 */
class PluginLssoftFeedback_ModuleMain extends ModuleORM
{
    /**
     * Отправляет емайл юзеры с ответом на обращение
     *
     * @param $oFeedback
     */
    public function NotifyReply($oFeedback)
    {
        $this->Notify_Send($oFeedback->getUserMailDisplay(), 'reply.tpl', 'Ответ на ваше обращение', array(
            'oFeedback' => $oFeedback,
        ), 'feedback');
    }

    public function NotifySend($oFeedback)
    {
        $sMail = Config::Get('plugin.feedback.notify_mail') ?: Config::Get('general.admin_mail');
        $this->Notify_Send($sMail, 'send.tpl', 'Новое обращение в поддержку', array(
            'oFeedback' => $oFeedback,
        ), 'feedback');
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