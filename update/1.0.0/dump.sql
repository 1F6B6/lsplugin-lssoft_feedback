--
-- Структура таблицы `prefix_lssoft_feedback`
--

CREATE TABLE IF NOT EXISTS `prefix_lssoft_feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_mail` varchar(100) DEFAULT NULL,
  `text` text NOT NULL,
  `date_create` datetime NOT NULL,
  `date_reply` datetime DEFAULT NULL,
  `text_reply` text,
  `ip_create` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `prefix_feedback`
--
ALTER TABLE `prefix_lssoft_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `user_mail` (`user_mail`),
  ADD KEY `date_create` (`date_create`),
  ADD KEY `ip_create` (`ip_create`),
  ADD KEY `date_reply` (`date_reply`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `prefix_feedback`
--
ALTER TABLE `prefix_lssoft_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;