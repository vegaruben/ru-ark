<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 06/11/17
 * Time: 15:31
 */

namespace Funnlz\Mappers;


use Funnlz\Entities\Product;
use Funnlz\Entities\Paging;
use Funnlz\Entities\PagingResult;

class ProductMapper extends AbstractDataMapper
{
    protected $entityTable = 'Product';

    protected function createEntity(array $row)
    {
        $entity = new Product();
        return $entity->bind($row);
    }
    public function findByIdAndOwner($id, $ownerId){
        $rows = $this->findAll(['id'=>$id, 'ownerId'=>$ownerId]);
        if($rows!=NULL)
            return $rows[0];

        return NULL;
    }

    public function save(Product &$entity){
        $data = [
            'SKU'=>$entity->SKU,
            'name'=>$entity->name,
            'picture'=>$entity->picture,
            'description'=>$entity->description,
            'urlToBuy'=>$entity->urlToBuy,
            'ownerId'=>$entity->ownerId,

            'productType'=>$entity->productType,
            'vendor'=>$entity->vendor,
            'salePrice'=>$entity->salePrice,
            'regularPrice'=>$entity->regularPrice,
            'requiresShipping'=>$entity->requiresShipping,
            'weightLbs'=>$entity->weightLbs,
            'HSTariffCode'=>$entity->HSTariffCode,
        ];
        //var_dump($data);exit();
        if($entity->id==NULL){
            $ret = $this->getAdapter()->insert($this->entityTable, $this->setCreatedDate($data))->getLastInsertId();//return id

            if($ret>0){
                $entity->id = $ret;
                return TRUE;
            }
        }else{
            $ret = $this->getAdapter()->update($this->entityTable, $this->setModifiedDate($data), 'id='.intval($entity->id));
            if($ret>0){
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * search product of this user
     * @param $ownerId
     * @param Paging pagination
     * @return NULL or list of products in PagingResult
     */
    public function search($ownerId, Paging $paging){
        $filter = $paging->getFilter();
        $order = $paging->getSort();

        $result = new PagingResult();

        $entities = array();
        //get data
        $sql = '';
        $prm = [];
        //filter rows
        $sqlfilter = sprintf(' from %s where ownerId = :ownerId ', $this->entityTable);
        $prm[':ownerId'] = $ownerId;

        if(!empty($filter)){
            $sqlfilter .= ' and (LOWER(sku) LIKE :filterx0 OR LOWER(name) LIKE :filterx1 OR LOWER(description) LIKE :filterx2)';
            $prm[':filterx0'] = '%'.$filter.'%';
            $prm[':filterx1'] = '%'.$filter.'%';
            $prm[':filterx2'] = '%'.$filter.'%';
        }
        $sql = $sqlfilter;
        if($order && count($order)>0){
            $sql .= " ORDER BY ";
            foreach($order as $k=>$v){
                $sql .= $k.' '.$v;
            }
            //echo $sqlfilter;
        }
        $limit = $paging->getPageSize();
        if(!empty($limit)){
            $sql .= " LIMIT " . $limit;
        }
        $offset =  $paging->getStart();
        if(!empty($offset)){
            $sql .= " OFFSET " . $offset;
        }
        //echo $sql;
        $bind = NULL;
        $ret = $this->adapter->prepare('select * '.$sql)
            ->execute($prm);

        $rows = $this->adapter->fetchAll();

        if ($rows) {
            foreach ($rows as $row) {
                $entities[] = $row;
            }
            $result->setData($entities);

            //total
            $ret = $this->adapter->prepare('select count(*) as c '.$sqlfilter)
                ->execute($prm);
            $row = $this->adapter->fetch();
            if($row){
                $n = $row['c'];
            }
            $result->setTotalRecords($n);
            $result->calculate($paging);

        }

        return $result;

    }

}