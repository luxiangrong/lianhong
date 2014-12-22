<?php

/**
 * Created by PhpStorm.
 * User: LuXiangrong
 * Date: 2014/12/22
 * Time: 18:44
 */
class ProductModel extends CommonModel
{
    public $_link = array(
        'ProductAttribute' => array(
            'mapping_type' => HAS_MANY,
            'class_name' => 'ProductAttribute',
            'foreign_key' => 'productId',
            'mapping_name' => 'attributes'
        )
    );
}