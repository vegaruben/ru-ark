<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 08/11/17
 * Time: 11:08
 */

namespace Funnlz\Entities;


class DataTablesPaging extends Paging
{
    //datatables
    public $filter;
    public $filter2;
    public $length=0;
    public $start=0;
    public $order=array();

    public function __construct()
    {
        parent::__construct();
        $this->order[0]['column'] = 0;
        $this->order[0]['dir'] = 'asc';

    }
    public function validate()
    {
        parent::validate(); // TODO: Change the autogenerated stub
        //if(empty($this->iDisplayLength)){
        if(empty($this->length)){
            $this->add_error('length','length empty');
        }
        //if($this->iDisplayStart==NULL){
        //var_dump($this);
        $this->pagesize = intval($this->length);
        $this->page = intval($this->start)/$this->pagesize + 1;
        $this->start = intval($this->start);
        $this->end = $this->start + $this->pagesize;
        //sort colid
        $this->sortby = $this->order[0]['column'];
        //order by
        $this->order = $this->order[0]['dir'];
        $c = $this->validCols[$this->sortby];
        $this->sort[$c] = $this->order ;

        return !$this->has_error();
    }

}