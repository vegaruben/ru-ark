<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 02/11/17
 * Time: 9:01
 */
namespace Funnlz\Entities;

class BaseEntity
{
    protected $errors = array();
    public function __construct(){

    }
    public function bind($properties){
        if(!is_array($properties))
            $properties = get_object_vars($properties);

        foreach($properties as $key => $value){
            $this->{$key} = $value;
        }
        return $this;
    }
    /*
    public function bindRequest(Request $request){

        $properties = get_object_vars($this);

        foreach($properties as $key => $value){
            if($key!='errors'){
                $this->{$key} = $request->request->get($key);
            }
        }
        return $this;
    }*/
    public function has_error(){
        if (count($this->errors)>0)
            return TRUE;
        return FALSE;
    }
    public function error_messages(){
        //return implode('<br />',array_values($this->errors));
        //return var_export($this->errors);
        $text = '';
        $keys = array_keys($this->errors);
        foreach ($keys as $key) {
            //$text .= $key.': '.$this->errors[$key].'<br />';
            $text .= $this->errors[$key].'<br />';
        }
        return $text;
    }
    public function error_keys(){
        return array_keys($this->errors);
    }
    public function add_error($key,$msg){
        if(array_key_exists($key,$this->errors))
            $this->errors[$key] .= $msg .'<br />';
        else
            $this->errors[$key] = $msg;
    }
    protected function required($props){
        foreach($props as $key){
            if(!isset($this->{$key})){
                $str = preg_replace('/([a-z])([A-Z])/', '$1 $2', ucfirst($key));
                $str = str_replace('_',' ',$str);
                $this->add_error($key,$str.' is empty');
            }
        }
    }
    protected function requiredNotEmpty($props){
        foreach($props as $key){
            if(!isset($this->{$key}) || (isset($this->{$key}) && empty($this->{$key}))){
                $str = preg_replace('/([a-z])([A-Z])/', '$1 $2', ucfirst($key));
                $str = str_replace('_',' ',$str);
                $this->add_error($key,$str.' is empty');
            }
        }
    }
}