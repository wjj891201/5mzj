<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Description of HouseAttach
 *
 * @author xm_pc
 */
class HouseAttach extends ActiveRecord
{

    public static function tableName()
    {
        return "{{%house_attach}}";
    }

}
