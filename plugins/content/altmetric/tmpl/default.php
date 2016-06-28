<?php
/**
 * @package     Content.Plugin
 *
 * @copyright   Copyright (C) 2016 KnowledgeArc Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

JFactory::getDocument()->addScript('https://d1bxh8uas1mnw7.cloudfront.net/assets/embed.js');
?>

<div class='altmetric-embed'<?php
    foreach($displayData->getIterator() as $key=>$value) :
        echo " ".$key."=\"".$value."\"";
    endforeach; ?>></div>
