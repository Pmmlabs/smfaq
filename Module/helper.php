<?php
/**
 * @copyright (C) 2014 Pmmlabs. - All rights reserved.
 * @license GNU General Public License, version 3 (http://www.gnu.org/licenses/gpl-3.0.html)
 * @author Pmmlabs <smfaq@pmmlabs.ru>
 * @url https://github.com/Pmmlabs/smfaq
 */
defined('_JEXEC') or die;

class modSmFaqHelper
{
    public static function getQA(&$params)
    {
        // Подключение к БД
        $db		= JFactory::getDbo();
        $query	= $db->getQuery(true);

        // Выборка нужных полей.
        $query->select('a.id, a.question, a.answer, a.created_by');
        $query->from('`#__smfaq` AS a');

        $query->select('u.name AS answer_created_by');
        $query->join('LEFT', '#__users  AS u ON u.id = a.answer_created_by_id');

        // Фильтр по категории
        if($params->get('category_id') > 0) {
            $query->where('catid = ' . $params->get('category_id'));
        }

        $query->where(array('a.published = 1','answer_state = 1')); // Выбираем только опубликованные и отвеченные вопросы
        $query->order($params->get('qa_source') == 1 ? 'RAND()' : 'created DESC'); // случайная запись или новейшая

        $db->setQuery($query, 0, 1); // только однин вопрос

        $item = $db->loadObject();

        if ($error = $db->getErrorMsg()) {
            throw new Exception($error);
        }

        return $item;
    }
}