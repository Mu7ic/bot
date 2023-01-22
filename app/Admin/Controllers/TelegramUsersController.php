<?php

namespace App\Admin\Controllers;

use App\Models\TelegramUsers;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TelegramUsersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Пользователи бота';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TelegramUsers());

        $grid->column('id', __('Id'));
        $grid->column('telegram_id', __('Telegram id'));
        $grid->column('surname', __('Фамилия'));
        $grid->column('name', __('Имя'));
        $grid->column('pname', __('Отчество'));
        $grid->column('birthdate', __('Дата рождения'));
        $grid->column('citizenship', __('Гражданство'));
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
        $show = new Show(TelegramUsers::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('telegram_id', __('Telegram id'));
        $show->field('surname', __('Фамилия'));
        $show->field('name', __('Имя'));
        $show->field('pname', __('Отчество'));
        $show->field('birthdate', __('Дата рождения'));
        $show->field('citizenship', __('Гражданство'));
        $show->field('created_at', __('Создано'));
        $show->field('updated_at', __('Обновлено'));

        return $show;
    }
}
