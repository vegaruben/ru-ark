<?php
namespace Funnlz\Mappers;

use Funnlz\Entities\User;
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
            //'isAllowed'=>'TRUE',//TODO: validate email using activation email
        ];
        if(!empty($user->password)){
            $data['password'] = $user->password;
        }
        if($user->id==NULL){
            $data['createdDate'] = $user->createdDate;
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


}
