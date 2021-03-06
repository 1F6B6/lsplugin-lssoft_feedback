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

/**
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
    die('Hacking attempt!');
}

class PluginLssoftFeedback extends Plugin
{

    /**
     * Массив с записями о наследовании плагином части функционала
     *
     * @var array
     */
    protected $aInherits = array(
        'action' => array(
            'ActionAjax' => '_ActionAjax',
        ),
    );

    public function Init()
    {
        $this->Viewer_AppendScript(Plugin::GetWebPath(__CLASS__) . 'frontend/js/init.js');
    }

    public function Activate()
    {
        return true;
    }

    public function Deactivate()
    {
        return true;
    }
}