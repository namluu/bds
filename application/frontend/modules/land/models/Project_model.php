<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Project_model extends MY_Model
{
    protected $_table = 'land_project';

    protected $_order = 'created_at';

    protected $_direction = 'desc';
}