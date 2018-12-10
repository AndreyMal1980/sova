<?php

/*
 * Component AdminLeftMenuWidget
 */

function activeMenu($url, $module = 0, $level = 0) {
    $cUrl = Yii::app()->request->url;
    if ($module == 1) {
        //echo $cUrl; die;
        $cUrlArr = explode('?', $cUrl);
        $cUrl = $cUrlArr[0];
        $urlArr = explode('/', $url);

        $cUrlArr = explode('/', $cUrl);
        $urlArr = explode('/', $url);
        if (isset($cUrlArr[2]) && isset($urlArr[2]) && $cUrlArr[1] == $urlArr[1] && $cUrlArr[2] == $urlArr[2]) {
            if ($level == 3) {
                if (isset($cUrlArr[3]) && isset($urlArr[3]) && $cUrlArr[3] == $urlArr[3]) {
                    return true;
                } else {
                    return false;
                }
            }
            if ($level == 4) {
                if (isset($cUrlArr[4]) && isset($urlArr[4]) && $cUrlArr[4] == $urlArr[4]) {
                    return true;
                } else {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    } else {
        if ($cUrl == $url) {
            return true;
        } else {
            return false;
        }
    }
}

$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'list',
    'items' => array(
        array('label' => 'Программы'),
        array('label' => 'Список программ', 'icon' => 'icon-th-list', 'url' => '/index.php/admin/programms/', 'active' => activeMenu('/index.php/admin/programms/'),
        ),
        array('label' => 'Добавить', 'icon' => 'plus', 'url' => '/index.php/admin/programms/add', 'active' => activeMenu('/index.php/admin/programms/add')),
        array('label' => 'Настройки', 'icon' => 'icon-cog',
            'items' => array(
                array('label' => 'Настройки', 'icon' => 'cog', 'url' => '/index.php/admin/calendar/settings', 'active' => activeMenu('/index.php/admin/calendar/settings')),
            ),
            'active' => activeMenu('/index.php/admin/calendar/settings', 1, 3) . activeMenu('/index.php/admin/calendar/type', 1, 3) . activeMenu('/admin/calendar/banners', 1, 3)
        ),
        array('label' => 'Соглашение'),
        array('label' => 'Текст соглашения', 'icon' => 'icon-th-list', 'url' => '/index.php/admin/sog/', 'active' => activeMenu('/index.php/admin/sog/'),
        ),
        array('label' => 'Пользователи'),
        array('label' => 'Добавить', 'icon' => 'plus',
            'items' => array(
                array('label' => 'Нового пользователя', 'icon' => 'plus', 'url' => '/index.php/admin/users/addUser/', 'active' => activeMenu('/index.php/admin/users/addUser/')),
                array('label' => 'Cтатус пользователя', 'icon' => 'plus', 'url' => '/index.php/admin/statusUser/add/', 'active' => activeMenu('/index.php/admin/statusUser/add/')),
            ),
        ),
        array('label' => 'Список пользователей', 'icon' => 'icon-th-list',
            'items' => array(
                array('label' => 'В виде таблицы', 'icon' => 'icon-th-list', 'url' => '/index.php/admin/users/listUserTable', 'active' => activeMenu('/index.php/admin/users/listUserTable')),
                array('label' => 'В Виде дерева', 'icon' => 'cog', 'url' => '/index.php/admin/users/', 'active' => activeMenu('/index.php/admin/users/')),
            ),
        ),
        array('label' => 'Линии'),
        array('label' => 'Добавить', 'icon' => 'plus', 'url' => '/index.php/admin/lines/add', 'active' => activeMenu('/index.php/admin/lines/add')),
        array('label' => 'Список линий', 'icon' => 'icon-th-list', 'url' => '/index.php/admin/lines/', 'active' => activeMenu('/index.php/admin/lines')),
        array('label' => 'Статусы'),
        array('label' => 'Список статусов', 'icon' => 'icon-th-list', 'url' => '/index.php/admin/statusUser/', 'active' => activeMenu('/index.php/admin/statusUser')),
        array('label' => 'Настройки', 'icon' => 'icon-cog', 'url' => '/index.php/admin/statusSettings/', 'active' => activeMenu('/index.php/admin/statusSettings/')),
        array('label' => 'Маркетинг-план'),
        array('label' => 'Добавить маркетинг план', 'icon' => 'plus', 'url' => '/index.php/admin/marketing/addMarketing/', 'active' => activeMenu('/index.php/admin/marketing/addMarketing/')),
    )
));
?>