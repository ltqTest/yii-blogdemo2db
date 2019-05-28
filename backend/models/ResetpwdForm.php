<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Adminuser;

/**
 * Signup form
 */
class ResetpwdForm extends Model
{
    public $password;
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => '请确认两次密码输入一致'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'password' => '密码',
            'password_repeat' => '重输密码',
        ];
    }

    /**
     * Signs user up.
     *
     */
    public function resetPassword($id)
    {
        if (!$this->validate()) {
            return null;
        }

        $adminUser = Adminuser::findOne($id);
        $adminUser->setPassword($this->password);
        $adminUser->removePasswordResetToken();

        return $adminUser->save() ? true : false;
    }
}
