<?php
namespace notification\components;

use Yii;

class MailRenderer extends Renderer
{

    protected static $templateFolder = '@notification-mail';

    public static function render($template) {
        echo $template;
    }

}