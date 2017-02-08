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
        $this->AddHook('init_admin_menu', 'InitAdminMenu');
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
}