<?php

namespace App\Admin\Controllers;

use App\Template;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TemplateController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Template';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Template);

//        $grid->column('id', __('Id'));
        $grid->column('Наименование', __('Name'));
        $grid->column('По умолчанию', __('Default'));
//        $grid->column('styles', __('Styles'));
//        $grid->column('scripts', __('Scripts'));
//        $grid->column('created_at', __('Created at'));
//        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Template::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('default', __('Default'));
        $show->field('styles', __('Styles'));
        $show->field('scripts', __('Scripts'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Template);

        $form->text('name', __('Наименование'));
        $form->switch('default', __('По умолчанию'));
        $form->textarea('styles', __('Стили'));
        $form->textarea('scripts', __('Скрипты'));

        return $form;
    }
}
