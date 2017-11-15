<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('form_link_active')) {
    function form_link_active($id, $is_active)
    {
        $CI =& get_instance();
        $uri = $CI->uri->uri_string;

        if ($is_active) {
            return sprintf('Yes | <a href="%s">&#215;</a>', base_url($uri.'/disable/'.$id));
        } else {
            return sprintf('No | <a href="%s">&#10003;</a>', base_url($uri.'/enable/'.$id));
        }
    }
}

if (!function_exists('form_sort_order')) {
    function form_sort_order($id, $sort_order)
    {
        $CI =& get_instance();
        $uri = $CI->uri->uri_string;

        return sprintf('%d | <a href="%s">&#5839;</a> | <a href="%s">&#5838;</a>', 
            $sort_order, 
            base_url($uri.'/sortup/'.$id), 
            base_url($uri.'/sortdown/'.$id)
        );
    }
}