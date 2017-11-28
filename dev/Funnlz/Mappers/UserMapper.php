<?php
namespace Funnlz\Mappers;

use Funnlz\Entities\User;
use Funnlz\Entities\SocialUser;
use Funnlz\Entities\StudentUser;
use Funnlz\Entities\StaffUser;
use Funnlz\Entities\Paging;
use Funnlz\Entities\PagingResult;
use Funnlz\Helpers\TimeHelper;

class UserMapper extends AbstractDataMapper {
    protected $entityTable = 'User';

    public function __construct(DatabaseAdapterInterface $adapter){
        parent::__construct($adapter);
    }


    /**
     * abstract method
     */
    protected function createEntity(array $row){
        $entity =  new User();
        $entity->bind($row);
        $entity->username = $entity->email;
        $entity->displayName = $entity->firstName.' '.$entity->lastName;
        return $entity;
    }
    /**
     * find a User by email
     * @param String $name
     * @return NULL or a User
     */
    public function findByEmail($email){
        $ret = $this->findAll(['email'=>$email]);
        if($ret == NULL){
            return NULL;
        }
        $user = $ret[0];
        //$user->password = stream_get_contents($user->password);
        return $user;
    }

    public function findByIdAndForgotPasswordCode($userId, $code){
        $ret = $this->findAll(['forgottenPasswordCode'=>$code, 'id'=>$userId]);
        if($ret == NULL){
            return NULL;
        }
        $user = $ret[0];
        //$user->password = stream_get_contents($user->password);
        return $user;
    }
    public function findByIdAndActivationCode($userId, $code){
        $ret = $this->findAll(['activationCode'=>$code, 'id'=>$userId]);
        if($ret == NULL){
            return NULL;
        }
        $user = $ret[0];
        //$user->password = stream_get_contents($user->password);
        return $user;
    }
    /**
     * save user to db
     * @param User $user
     * return boolean
     */
    public function save(User &$user){
        $user->lastAccess = TimeHelper::get_current_time();
        $data = [
            'firstName'=>$user->firstName,
            'lastName'=>$user->lastName,
            'email'=>$user->email,
            'roles'=>$user->roles,
            'paypalEmail'=>$user->paypalEmail,
        ];
        if(!empty($user->password)){
            $data['password'] = $user->password;
        }
        if($user->id==NULL){//new user
            $data['isActive'] = $user->isActive;
            $data['createdDate'] = $user->createdDate;
            $data['activationCode'] = $user->activationCode;

            $ret = $this->getAdapter()->insert($this->entityTable, $this->setCreatedDate($data))->getLastInsertId();//return id

            if($ret>0){
                $user->id = $ret;
                return TRUE;
            }
        }else{
            $ret = $this->getAdapter()->update($this->entityTable, $this->setModifiedDate($data), 'id='.intval($user->id));
            if($ret>0){
                return TRUE;
            }
        }
        return FALSE;
    }
    /**
     * update last login of the user
     * @param User $user
     * return boolean
     */
    public function updateLastLogin(User &$user){
        $user->lastAccess = TimeHelper::get_current_time();
        $data = [
            'lastAccess'=>$user->lastAccess,
        ];
        $ret = $this->getAdapter()->update($this->entityTable, $this->setModifiedDate($data), 'id='.intval($user->id));
        if($ret>0){
            return TRUE;
        }
        return FALSE;
    }

    public function updateForgottenPasswordCode(User &$user){
        $data = [
            'forgottenPasswordCode'=>$user->forgottenPasswordCode,
            'forgottenPasswordTime'=>$user->forgottenPasswordTime,
        ];
        $ret = $this->getAdapter()->update($this->entityTable, $this->setModifiedDate($data), 'id='.intval($user->id));
        if($ret>0){
            return TRUE;
        }
        return FALSE;
    }

    public function clearForgottenPasswordCode(User &$user){
        $data = [
            'forgottenPasswordCode'=>'',
            'forgottenPasswordTime'=>NULL,
        ];
        $ret = $this->getAdapter()->update($this->entityTable, $this->setModifiedDate($data), 'id='.intval($user->id));
        if($ret>0){
            return TRUE;
        }
        return FALSE;
    }
    public function activateUser(User &$user){
        $data = [
            'isActive'=>1,
            'activationCode'=>'',
        ];
        $ret = $this->getAdapter()->update($this->entityTable, $this->setModifiedDate($data), 'id='.intval($user->id));
        if($ret>0){
            return TRUE;
        }
        return FALSE;
    }

    /*social user*/
    /**
     * save user to db
     * @param User $user
     * return boolean
     */
    public function addSocialUser(SocialUser &$user){
        $user->lastAccess = TimeHelper::get_current_time();
        $data = [
            'provider'=>$user->provider,
            'socialId'=>$user->socialId,
            'firstName'=>$user->firstName,
            'lastName'=>$user->lastName,
            'displayName'=>$user->displayName,
            'email'=>$user->email,
            'profileURL'=>$user->profileURL,
            'roles'=>$user->roles,
            'lastAccess'=>$user->lastAccess,
            'isActive'=>1,
        ];
        $ret = $this->getAdapter()->insert($this->entityTable, $this->setCreatedDate($data))->getLastInsertId();//return id

        if($ret>0){
            $user->id = $ret;
            return TRUE;
        }
    }
    /**
     * find a User by provider and id
     * @param String $provider
     * @param String $socialId
     * @return NULL or a User
     */
    public function findSocialUser($provider, $socialId){
        $ret = $this->findAll(['provider'=>$provider, 'socialId'=> $socialId]);
        if($ret == NULL){
            return NULL;
        }
        $user = $ret[0];
        return $user;
    }

    /**
     * search product of this user
     * @param $ownerId
     * @param Paging pagination
     * @return NULL or list of products in PagingResult
     */
    public function search( Paging $paging){
        $filter = $paging->getFilter();
        $order = $paging->getSort();

        $result = new PagingResult();

        $entities = array();
        //get data
        $sql = '';
        $prm = [];
        //filter rows
        $sqlfilter = sprintf(' from %s  ', $this->entityTable);

        if(!empty($filter)){
            $sqlfilter .= ' and (LOWER(firstName) LIKE :filterx0 OR LOWER(lastName) LIKE :filterx1 OR LOWER(email) LIKE :filterx2)';
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
                $entities[] = $this->createEntity($row);
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
