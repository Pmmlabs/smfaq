<?php
/**
 * @copyright (C) 2014 Pmmlabs. - All rights reserved.
 * @license GNU General Public License, version 3 (http://www.gnu.org/licenses/gpl-3.0.html)
 * @author Pmmlabs <smfaq@pmmlabs.ru>
 * @url https://github.com/Pmmlabs/smfaq
 */
defined('_JEXEC') or die;

$document = JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'modules/mod_smfaq/tmpl/default.css');

if ($singleQA): ?>
    <a class="question"
       <? if ($params->get('question_link_type') != '2') // если вопрос - это ссылка, добавляем атрибут href
          print ' href="' . ($params->get('question_link_type') == '1' ?
            JRoute::_(SmfaqHelperRoute::getQuestionRoute($params->get('category_id'), $singleQA->id))
            : (JRoute::_(SmfaqHelperRoute::getCategoryRoute($params->get('category_id'))) . '#p' . $singleQA->id)) . '"';

          if ($params->get('symbol_limit') > 0 && mb_strlen($singleQA->question) > $params->get('symbol_limit')) {  // Если вопрос нужно обрезать
              if ($params->get('show_tooltip_question') == 1)
                  print ' title="' . $singleQA->question . '"'; // Показывать подсказку с полным текстом вопроса при наведении
              print '>' . mb_substr($singleQA->question, 0, $params->get('symbol_limit')) . "...";
          } else {                                                                                                  // Если вопрос не нужно обрезать
              print '>' . $singleQA->question;
          }
       ?>
    </a>

    <div class="question_by"><?= $singleQA->created_by ?></div>
    <div class="answerContainer">
        <div class="answer_by">Отвечает <?= $singleQA->answer_created_by ?>:</div>
        <?
        if ($params->get('symbol_limit') > 0 && mb_strlen($singleQA->answer) > $params->get('symbol_limit')) {  // Если ответ нужно обрезать
            print mb_substr($singleQA->answer, 0, $params->get('symbol_limit')) . "...";
        } else {                                                                                                // Если ответ не нужно обрезать
            print $singleQA->answer;
        }
        ?>
    </div>
<?php endif;

$show_all_answers_link = $params->get('show_all_answers_link');
if ($show_all_answers_link && $show_all_answers_link == 1 && $params->get('all_answers_link_text')): ?>
    <p>
        <a href="<?= JRoute::_(SmfaqHelperRoute::getCategoryRoute($params->get('category_id'))) ?>"><?= $params->get('all_answers_link_text') ?></a>
    </p>
<?php endif; ?>
