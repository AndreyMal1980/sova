<?php
/**
 * AdminLeftMenuWidget Вывод меню с лева в CMS
 * 
 * @package CMS
 * @category BackEnd
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class AdminLeftMenuWidget extends CWidget
{
    /**
     * Вывод меню с лева в CMS
     * 
     * @return render adminLeftMenuWidget
     */
    public function init()
    {        
    
        $this->render('adminLeftMenuWidget');
    }
}
?>