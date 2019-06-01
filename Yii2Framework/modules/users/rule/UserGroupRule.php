<?php
namespace app\modules\users\rule;
use Yii;
use yii\rbac\Rule;
class UserGroupRule extends Rule {
    public $name = 'userGroup';
    public function execute($user, $item, $params) {
        if (Yii::$app->user->isGuest) {
            return false;
        }
        $group = Yii::$app->user->identity->group_id;
        if ($item->name === 'admin') {
            return $group == 1;
        }
        elseif ($item->name === 'clerk') {
            return $group == 1 || $group == 2;
        }
        elseif ($item->name === 'teacher') {
            return $group == 1 || $group == 3;
        }
        elseif ($item->name === 'student') {
            return $group == 1 || $group == 4;
        }
        return false;
    }
}