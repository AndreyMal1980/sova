<?php

class AdminModule extends CWebModule
{

    public function init()
    {
        Yii::app()->theme = 'admin';
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
        ));
    }
/*
    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            //ахтунг, ахтунг. переделать!!!
            if (Yii::app()->controller->id == 'uploadify' || Yii::app()->controller->id == 'photo') {
                return true;
            }
            if ((Yii::app()->user->isGuest || (Yii::app()->user->role != 'admin' && Yii::app()->user->role != 'root')) && Yii::app()->controller->id != 'default') {
                Yii::app()->request->redirect('/admin/');
            }
            if (!Yii::app()->params->adminModule && Yii::app()->request->url !='/admin/default/accessDenied' ) {
                Yii::app()->request->redirect('/admin/default/accessDenied');
            }
            return true;
        }
       
        //else
        //    return false;
            return true;
    }
*/
}
