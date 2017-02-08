<?php

/**
 * Часть экшена админки по управлению ajax запросами
 */
class PluginLssoftFeedback_ActionAdmin_EventAjax extends Event
{

    public function Init()
    {
        /**
         * Устанавливаем формат ответа
         */
        //$this->Viewer_SetResponseAjax('json');
    }

    /**
     * Модальное ответа на обращение
     */
    public function EventModalAnswer()
    {
        $this->Viewer_SetResponseAjax();

        if ($oItem = $this->PluginLssoftFeedback_Main_GetFeedbackById((int)getRequestStr('id'))) {
            $this->Viewer_Assign('oItem', $oItem);
            $this->Viewer_AssignAjax('sText', $this->Viewer_Fetch(Plugin::GetTemplatePath($this) . 'modals/modal.admin.reply.tpl'));
        } else {
            return $this->Message_AddErrorSingle('Не удалось найти обращение');
        }
    }

    /**
     * Ответ на обращение
     */
    public function EventReply()
    {
        $this->Viewer_SetResponseAjax();

        if (!($oItem = $this->PluginLssoftFeedback_Main_GetFeedbackById((int)getRequestStr('id')))) {
            return $this->Message_AddErrorSingle('Не удалось найти обращение');
        }

        $sText = trim(getRequestStr('text'));
        if (!$sText) {
            return $this->Message_AddErrorSingle('Необходимо написать текст сообщения');
        }

        $oItem->setTextReply($sText);
        $oItem->setDateReply(date('Y-m-d H:i:s'));
        $oItem->Update();
        /**
         * Отправляем на почту
         */
        $this->PluginLssoftFeedback_Main_NotifyReply($oItem);
    }

    /**
     * Удаление обращения
     */
    public function EventRemove()
    {
        $this->Viewer_SetResponseAjax();

        if (!($oItem = $this->PluginLssoftFeedback_Main_GetFeedbackById((int)getRequestStr('id')))) {
            return $this->Message_AddErrorSingle('Не удалось найти обращение');
        }

        $oItem->Delete();
    }
}
