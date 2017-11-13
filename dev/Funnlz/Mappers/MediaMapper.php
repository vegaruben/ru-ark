<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 08/11/17
 * Time: 14:03
 */

namespace Funnlz\Mappers;

use Funnlz\Entities\Media;
use Funnlz\Entities\BaseEntity;

class MediaMapper extends AbstractDataMapper {
    protected $entityTable = 'Media';

    public function __construct(DatabaseAdapterInterface $adapter){
        parent::__construct($adapter);
    }

    /**
     * abstract method
     */
    protected function createEntity(array $row){
        $entity =  new Media();
        $entity->bind($row);
        return $entity;
    }
    public function findById($mediaID){
        $res = $this->findAll(['mediaID'=>$mediaID]);
        if($res!=NULL){
            return $res[0];
        }
        return NULL;
    }
    /**
     * add media to db
     * @param Media $media
     * return boolean
     */
    public function save(Media &$media){
        $adapter = $this->getAdapter();
        $id = $this->guidv4();
        $data = [
            'mediaID'=>$id,
            'name'=>$media->name,
            'localfile'=>$media->localfile,
            'ownerID'=>$media->ownerID,
            'type'=>$media->type
        ];

        $ret = $adapter->insert($this->entityTable, $data)->countAffectedRows();
        if($ret>0){
            $media->mediaID = $id;
            return TRUE;
        }

        return FALSE;
    }
    public function deleteById($mediaID){
        $adapter = $this->getAdapter();
        $ret = $adapter->delete2($this->entityTable, ['mediaID'=>$mediaID]);
        if($ret>0){
            return TRUE;
        }
        return FALSE;
    }
}
