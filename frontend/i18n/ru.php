<?php

return array(
    'config'          => array(
        'per_page'         => array(
            'name'        => 'Количество обращений на одну страницу',
            'description' => '',
        ),
        'notify_mail_list' => array(
            'name'        => 'Список емайлов для получения уведомлений',
            'description' => '',
        ),
    ),
    'config_sections' => array(
        'main' => 'Основные настройки',
    ),
    'toolbar'         => array(
        'title' => 'Обратная связь'
    ),
    'modal'           => array(
        'title' => 'Обратная связь'
    ),
    'field'           => array(
        'name'       => array(
            'label'       => 'Ваше имя',
            'error_empty' => 'Необходимо указать имя',
        ),
        'mail'       => array(
            'label'       => 'Электронная почта',
            'error_empty' => 'Необходимо указать электронную почту',
        ),
        'text'       => array(
            'label' => 'Текст обращения'
        ),
        'reply_text' => array(
            'error_empty' => 'Необходимо написать текст ответа'
        ),
        'referer'    => array(
            'from' => 'Сообщение отправлено со страницы:'
        ),
    ),
    'submit'          => array(
        'send'  => 'Сообщение успешно отправлено',
        'reply' => 'Ответ отправлен',
    ),
    'mails'           => array(
        'send'  => array(
            'title' => 'Новое обращение в поддержку',
        ),
        'reply' => array(
            'title' => 'Ответ на ваше обращение',
        ),
    ),
    'admin'           => array(
        'notification' => array(
            'title'  => 'Обращения',
            'no_new' => 'Нет новых',
            'count'  => '%%count%% новое; %%count%% новых; %%count%% новых',
        ),
    ),
);