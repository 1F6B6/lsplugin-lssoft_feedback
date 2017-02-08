<?php
/**
 * Таблица БД
 */
$config['$root$']['db']['table']['lssoft_feedback_main_feedback'] = '___db.table.prefix___lssoft_feedback';
/**
 * Количество обращений на одну страницу
 */
$config['per_page'] = 20;
/**
 * Емайлы на которые отправлять уведомления. Если пустой, то будет отправляться на 'general.admin_mail'
 */
$config['notify_mail_list'] = array();

return $config;