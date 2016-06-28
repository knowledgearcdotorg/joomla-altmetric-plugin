<?php
/**
 * @package     Content.Plugin
 *
 * @copyright   Copyright (C) 2016 KnowledgeArc Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use \Joomla\Utilities\ArrayHelper;
use \Joomla\Registry\Registry;

/**
 * Embeds an Altmetric icon into Joomla! content.
 */
class PlgContentAltmetric extends JPlugin
{
    protected $autoloadLanguage = true;

    public function __construct(&$subject, $config)
    {
        parent::__construct($subject, $config);

        JLog::addLogger(array());

        $item = null;
    }

    /**
     * Adds the Altmetric badge to content.
     *
     * @param   string   $context  The context of the content being passed to the plugin.
     * @param   object   &$row     The article object. Note $article->text is also available
     * @param   mixed    &$params  The article params
     * @param   integer  $page     The 'page' number
     *
     * @return  mixed    void or true
     */
    public function onContentPrepare($context, &$row, &$params, $page = 0)
    {
        // Expression to search for
        $regex = '/{altmetric\s*(.*?)}/i';

        preg_match_all($regex, $row->text, $matches, PREG_SET_ORDER);

        if ($matches) {
            $matches = array_shift($matches);

            $placeholder = JArrayHelper::getValue($matches, 0);

            $match = JArrayHelper::getValue($matches, 1);

            $id = $match;

            foreach ($params as $key=>$value) {
                $this->params->set($key, $value);
            }

            $pluginParams = $this->params->getIterator();

            if (!$id) {
                $type = ArrayHelper::getValue($pluginParams, "type");

                if ($type == 'uri') {
                    $id = (string)JUri::getInstance();
                }
            }

            $displayData = new Registry;

            foreach ($pluginParams as $key=>$value) {
                if ($key == 'type') {
                    if ($id) {
                        $displayData->set("data-".$value, $id);
                    } else {
                        throw new Exception("No id could be found for Altmetric");
                    }
                } else {
                    if ($value) {
                        $displayData->set("data-".$key, $value);
                    }
                }
            }

            ob_start();

            include JPluginHelper::getLayoutPath('content', 'altmetric');

            $html = ob_get_contents();
            ob_end_clean();

            $row->text = str_replace($placeholder, $html, $row->text);
        }

        return true;
    }
}
