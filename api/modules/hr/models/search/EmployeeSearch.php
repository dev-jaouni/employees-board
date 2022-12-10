<?php

namespace api\modules\hr\models\search;

use yii\data\ActiveDataProvider;
use api\modules\hr\resources\User;
use api\modules\hr\resources\Employee;
use common\models\base\RbacAuthAssignment;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class EmployeeSearch extends Employee
{
    /**
     * Creates data provider instance with search query applied
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Employee::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->innerJoin(RbacAuthAssignment::tableName(), RbacAuthAssignment::tableName() . '.item_name' . " = '" . User::ROLE_EMPLOYEE . "' AND " . RbacAuthAssignment::tableName() . '.user_id' . ' = ' . User::tableName() . '.id');

        return $dataProvider;
    }
}
