<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class CKEditor extends Field
{
    public static $js = [
//        '//cdn.ckeditor.com/4.5.10/full/ckeditor.js',
        '/packages/ckeditor/ckeditor.js',
        '/packages/ckeditor/adapters/jquery.js',
    ];

    protected $view = 'admin.ckeditor';

    public function render()
    {
        $this->script = "$('textarea.{$this->getElementClassString()}').ckeditor();";
        $this->script = "CKEDITOR.config.language = 'ru'";
        $this->script = "CKEDITOR.config.options = 'format_tags: p;h1;h2;h3;h4;h5;h6;div;span'";

        return parent::render();
    }
}
