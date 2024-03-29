<?php

namespace App\Admin\Controllers;

use App\Good;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class GoodController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Каталог товаров';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Good);

        $grid->column('id', __('Id'));
        $grid->column('name', __('Наименование'));
        $grid->column('name_ext', __('Наименование1'));
//        $grid->column('text', __('Описание'));
//        $grid->column('info', __('Применение'));
        $grid->column('image', __('Фото'));
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
        $show = new Show(Good::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('text', __('Text'));
        $show->field('info', __('Info'));
        $show->field('image', __('Image'));
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
        $form = new Form(new Good);
        $form
            ->tab('Основная', function ($form) {
                $form->text('name', __('Наименование'));
                $form->text('name_ext', __('Наименование1'));
                $form->ckeditor('text', __('Описание'));
                $form->ckeditor('info', __('Применение'));
                $form->image('image', __('Фото'));
            })
            ->tab('Мета', function ($form) {
                $form->text('title', 'Заголовок страницы');
                $form->text('description', 'Описание страницы');
                $form->text('keywords', 'Ключевые слова');
                $form->translate('url', 'Адрес страницы (url)');
            });
        return $form;
    }
}
