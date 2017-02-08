<?php

class PluginLssoftFeedback_ActionAdmin extends PluginAdmin_ActionPlugin
{

    /**
     * Объект УРЛа админки, позволяет удобно получать УРЛы на страницы управления плагином
     */
    public $oAdminUrl;
    public $oUserCurrent;

    /**
     * Инициализация
     */
    public function Init()
    {
        $this->oAdminUrl = Engine::GetEntity('PluginAdmin_ModuleUi_EntityAdminUrl');
        $this->oAdminUrl->setPluginCode(Plugin::GetPluginCode($this));
        $this->oUserCurrent = $this->User_GetUserCurrent();
        $this->Viewer_AppendScript(Plugin::GetWebPath(__CLASS__) . 'js/main.js');
    }

    /**
     * Регистрируем евенты
     *
     */
    protected function RegisterEvent()
    {
        /**
         * Для ajax регистрируем внешний обработчик
         */
        $this->RegisterEventExternal('Ajax', 'PluginLssoftFeedback_ActionAdmin_EventAjax');
        /**
         * Список обращений
         */
        $this->AddEventPreg('/^(page(\d{1,5}))?$/i', '/^$/i', 'EventIndex');
        /**
         * Ajax обработка
         */
        $this->AddEventPreg('/^ajax$/i', '/^modal$/i', '/^answer$/i', '/^$/i', 'Ajax::EventModalAnswer');
        $this->AddEventPreg('/^ajax$/i', '/^reply$/i', '/^$/i', 'Ajax::EventReply');
        $this->AddEventPreg('/^ajax$/i', '/^remove$/i', '/^$/i', 'Ajax::EventRemove');
    }

    /**
     * Вывод списка обращений
     */
    protected function EventIndex()
    {
        /**
         * Получаем номер страницы из урла
         */
        $iPage = $this->GetEventMatch(2) ? $this->GetEventMatch(2) : 1;
        /**
         * Получаем статьи
         */
        $aResult = $this->PluginLssoftFeedback_Main_GetFeedbackItemsByFilter(array(
            '#order' => array('id' => 'desc'),
            '#with'  => array('user'),
            '#page'  => array($iPage, Config::Get('plugin.lssoft_feedback.per_page'))
        ));
        /**
         * Формируем постраничность
         */
        $aPaging = $this->Viewer_MakePaging($aResult['count'], $iPage, Config::Get('plugin.lssoft_feedback.per_page'), Config::Get('pagination.pages.count'),
            $this->oAdminUrl->get());
        /**
         * Прогружаем переменные в шаблон
         */
        $this->Viewer_Assign('aPaging', $aPaging);
        $this->Viewer_Assign('items', $aResult['collection']);
        /**
         * Устанавливаем шаблон вывода
         */
        $this->SetTemplateAction('index');
    }
}