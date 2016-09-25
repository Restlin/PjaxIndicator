<?php

/**
 * @copyright Copyright (c) 2016 Ilya Shumilov
 * @link https://github.com/restlin/PjaxIndicator
 */

namespace restlin\pjax-indicator

use yii\helpers\Html;
use Yii;

/**
 * Simple class showing the "Loading" message when pjax loads data
 *
 * @author Ilya Shumilov <restlinru@yandex.ru>
 */
class PjaxIndicator extends \yii\widgets\Pjax
{    
    /**
     * Message, that show when pjax loading data.
     * @var string
     */
    public $message = 'Loading! Please, wait...';
    /**
     * CSS style of indicator's container 
     * @var string
     */
    public $cssStyle = 'position:absolute; left:45%; top:45%; width:200px; height:30px; z-index:100; display:none; padding: 2px; color: #fff; text-align:center';
    /**
     * @inheritdoc
     */
    public function run()
    {
        echo Html::tag('div',Yii::t('app', $this->message),[
            'class' => 'navbar-inverse navbar',
            'style' => $this->cssStyle,
            'id' => 'pjax-indicator',
        ]);        
        parent::run();
    }
    /**
     * Registers the needed JavaScript.
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        $js = '$(document)'
        . '.on("pjax:send",function(){$("#pjax-indicator").show();})'
        . '.on("pjax:complete",function(){$("#pjax-indicator").hide();});';
        $view->registerJs($js);
        parent::registerClientScript();
    }
}
