<?php

/**
 * Хуки
 */
class PluginLssoftFeedback_HookMain extends Hook
{
    /**
     * Регистрация необходимых хуков
     */
    public function RegisterHook()
    {
        /**
         * Хук на отображение админки
         */
        $this->AddHook('init_action_admin', 'InitAdminMenu');
        /**
         * Начало обработки экшена, выполняется всегда только 1 раз
         */
        $this->AddHook('start_action', 'StartAction');
        $this->AddHook('template_dashboard_notifications_items', 'TemplateDashboardNotificationsItems');
    }

    /**
     * Добавляем в главное меню админки
     */
    public function InitAdminMenu()
    {
        /**
         * Без ответа
         */
        $iCount = $this->PluginLssoftFeedback_Main_GetCountFromFeedbackByFilter(array(
            '#where' => array('date_reply IS NULL' => array())
        ));

        /**
         * Получаем объект главного меню
         */
        $oMenu = $this->PluginAdmin_Ui_GetMenuMain();
        /**
         * Добавляем новый раздел
         */
        $oMenu->AddSection(
            Engine::GetEntity('PluginAdmin_Ui_MenuSection')->SetCaption('Обратная связь')->SetName('lssoft_feedback')->SetUrl('plugin/lssoft_feedback')->SetIcon('bullhorn')->SetBubbleCount($iCount)
                ->AddItem(Engine::GetEntity('PluginAdmin_Ui_MenuItem')->SetCaption('Список обращений')->SetUrl(''))
                ->AddItem(Engine::GetEntity('PluginAdmin_Ui_MenuItem')->SetCaption('Настройки')->SetUrl('/admin/settings/plugin/lssoft_feedback'))
        );
    }

    /**
     * Добавляем к загрузке компоненты плагина
     */
    public function StartAction()
    {
        $this->Component_Add('lssoft_feedback:p-feedback');
        /**
         * Подключаем кнопку в тулбар
         */
        $this->Viewer_AddBlock('toolbar', 'component@lssoft_feedback:p-feedback.toolbar-feedback');
    }

    /**
     * Вывод уведомления на главной админки
     */
    public function TemplateDashboardNotificationsItems($aParams)
    {
        /**
         * Без ответа
         */
        $iCount = $this->PluginLssoftFeedback_Main_GetCountFromFeedbackByFilter(array(
            '#where' => array('date_reply IS NULL' => array())
        ));
        $aItems = $aParams['items'];
        $aItems[] = [
            'name'    => 'reports',
            'icon'    => 'bullhorn',
            'url'     => Router::GetPath('admin/plugin/lssoft_feedback'),
            'title'   => $this->Lang_Get('plugin.lssoft_feedback.admin.notification.title'),
            'text'    => $this->Lang_Pluralize(
                $iCount,
                $this->Lang_Get('plugin.lssoft_feedback.admin.notification.count', array('count' => $iCount))
            ),
            'text_no' => $this->Lang_Get('plugin.lssoft_feedback.admin.notification.no_new'),
            'count'   => $iCount
        ];
        return $aItems;
    }
}