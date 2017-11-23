<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists('form_dropdown_currency'))
{
    function form_dropdown_currency($name = '', $selected = array(), $extra = ''){
        $options = array('USD' => 'USD ($)', 'EUR' => 'EUR (€)', 'GBP' => 'GBP (£)', 'AUD' => 'AUD (A$)');
        return form_dropdown($name, $options, $selected, $extra);
    }
}
