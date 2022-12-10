<?php

namespace api\components;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use common\models\Vehicle;
use common\models\Taxonomy;
use common\models\Company;
use common\models\UserDevice;
use common\models\DynamicForm;
use common\models\CompanyCashSale;
use common\models\CompanyVehicleNew;
use common\models\Reel;
use common\models\Compare;
use common\modules\Jwplayer\components\Jwplayer;
use api\modules\v3\models\NewsResource;

class BaseModel extends Model
{
    CONST DATA = 'data';
    const COMPONENT_NAME = 'componentName';
    const USER_DATA = 'userData';
    const PAGES_COUNT = 'pages_count';

    const LIST_EMPLOYEES = 'employees_list';
}