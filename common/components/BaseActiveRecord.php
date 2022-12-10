<?php

namespace common\components;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class BaseActiveRecord
 * @package common\components
 */
class BaseActiveRecord extends ActiveRecord
{
    protected $roles = [];

    /**
     * @param $attribute
     * @param $params
     * @param $validator
     * @return bool
     */
    public function validatePhone($attribute, $params, $validator)
    {
        $phone_number = $this->$attribute;
        $length = strlen($phone_number);

        $phone_number_digits = str_split($phone_number);
        foreach ($phone_number_digits as $char) {
            if (!is_numeric($char)) {
                $error = Yii::t('app', 'Phone number must contain only numbers');
                $this->addError($attribute, $error);
                return false;
            }
        }

        if ($length < 10 || $length > 14) {
            $error = Yii::t('app', 'Phone number must be 10 or 14 digits');
            $this->addError($attribute, $error);
        }

        return true;
    }


    public function getRoles()
    {
        if ($this->id) {
            $this->roles = array_keys(Yii::$app->authManager->getRolesByUser($this->id));
        }

        return $this->roles;
    }

}
