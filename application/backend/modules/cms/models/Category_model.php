<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends MY_Model
{
    protected $_table = 'cms_category';

    protected $_order = 'sort_order';
}