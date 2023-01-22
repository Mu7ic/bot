<?php

namespace App\Admin\Controllers;

use App\Models\Messages;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MessagesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Сообщения';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Messages());

        $grid->column('id', __('Id'));
        $grid->column('type', __('Тип'));
        $grid->column('text', __('Сообщения'));
        $grid->column('created_at', __('Создано'));
        $grid->column('updated_at', __('Обновлено'));

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
        $show = new Show(Messages::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('type', __('Тип'));
        $show->field('text', __('Сообщения'));
        $show->field('created_at', __('Создано'));
        $show->field('updated_at', __('Обновлено'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Messages());

        $form->text('type', __('Тип'));
        $form->ckeditor('text', __('Сообщения'));

        return $form;
    }
}
