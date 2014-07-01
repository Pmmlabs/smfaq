<?php
/**
 * @copyright (C) 2014 Pmmlabs. - All rights reserved.
 * @license GNU General Public License, version 3 (http://www.gnu.org/licenses/gpl-3.0.html)
 * @author Pmmlabs <smfaq@pmmlabs.ru>
 * @url https://github.com/Pmmlabs/smfaq
 */
defined('_JEXEC') or die;

require_once __DIR__ . '/helper.php';
require_once JPATH_ROOT . '/components/com_smfaq/helpers/route.php';

// Получение одного вопроса-ответа для вывода в модуле
$singleQA = modSmFaqHelper::getQA($params);

//подключаем html-шаблон для вывода содержания модуля (шаблон default).
require JModuleHelper::getLayoutPath('mod_smfaq', $params->get('layout', 'default'));



