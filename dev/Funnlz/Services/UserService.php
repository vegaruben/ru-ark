<?php
namespace Funnlz\Services;

use Funnlz\Entities\SocialUser;
use Funnlz\Entities\UpdatePasswordForm;
use Pimple\Container;

use Funnlz\Mappers\UserMapper;
use Funnlz\Mappers\ProductMapper;
use Funnlz\Mappers\SocialUserMapper;
use Funnlz\Helpers\TimeHelper;
use Funnlz\Entities\User;
use Funnlz\Entities\Email;
use Funnlz\Entities\Paging;
use Funnlz\Entities\PagingResult;
use Funnlz\Entities\ResetPasswordForm;


class UserService{
    private $app;
    private $mapper = NULL;

    public function __construct(Container $app)
    {
        $this->app = $app;
        $this->getMapper();
    }
    protected function getMapper(){
        if($this->mapper==NULL){
            $this->mapper = new UserMapper($this->app['pdo_adapter']);
        }
        return $this->mapper;
    }

    /**
     * register a user
     * @param User $user
     * return boolean or new user
     */
    public function registerUser(User $user){
        if($user==NULL){
            throw new ServiceException('user is null');
        }
        if(!$user->validate()){
            throw new ServiceException($user->error_messages());
        }

        //check whether user email already taken
        $prev = $this->mapper->findByEmail($user->email);
        if($prev!=NULL){
            throw new ServiceException('This e-mail address has been linked to a funnlz login through '.$prev->provider.'.');
        }

        $user->isActive = FALSE;
        $user->activationCode = bin2hex(openssl_random_pseudo_bytes(16));

        //hash password
        $passhash = password_hash($user->password,PASSWORD_DEFAULT);
        $user->password = $passhash;
        //set created date
        $user->createdDate = TimeHelper::get_current_time();
        //save to db

        $ret = $this->mapper->save($user);
        if($ret){
            //send activation email
            $this->sendUserActivationEmail($user);
            return $user;
        }
        return FALSE;

    }
    /**
     * local user login using username(email) and password
     * @param String $username
     * @param String $password
     * return boolean false or User
     */
    public function login($username, $password){
        TransactionHelper::enableTransaction($this->app);
        $user = $this->mapper->findByEmail($username);
        if($user==NULL){
            return FALSE;
        }
        //check whether this user was logged in using social media
        if(!empty($user->socialId)){
            throw new ServiceException('Please login using your '.$user->provider.' account.');
        }

        if(!$user->isActive){
            throw new ServiceException('User is inactive. Please check your email to activate it.');
        }

        if (password_verify($password, $user->password)) {
            $this->mapper->updateLastLogin($user);
            TransactionHelper::commitTransaction($this->app);
            return $user;
        } else {
            return FALSE;
        }
    }

    public function findById($userId){
        return $this->mapper->findById($userId);
    }
    public function findByEmail($email){
        return $this->mapper->findByEmail($email);
    }
    /**
     * update user
     * @param User $user
     * return updated user on success, boolean false on error
     */
    public function updateUser(User $user){
        //check whether user email already taken
        $prev = $this->mapper->findByEmail($user->email);
        if($prev!=NULL && $prev->id != $user->id){
            throw new ServiceException('email already taken');
        }
        if(!empty($user->password)){
            //hash password
            $passhash = password_hash($user->password,PASSWORD_DEFAULT);
            $user->password = $passhash;
        }

        //save to db
        $ret = $this->mapper->save($user);
        if($ret){
            return $user;
        }
        return FALSE;
    }
    /**
     * try to reset user password,: set forgotten_password_code, forgotten_password_time then send email to user
    */
    public function tryToResetPassword($username){
        $user = $this->mapper->findByEmail($username);
        if($user==NULL){
            throw new ServiceException('email not found');
        }
        //generate random forgotten password code
        $user->forgottenPasswordCode = bin2hex(openssl_random_pseudo_bytes(16));
        $user->forgottenPasswordTime = TimeHelper::get_current_time();
        if($this->mapper->updateForgottenPasswordCode($user)){
            //send email
            return $this->sendResetPasswordEmail($user);
        }
        return FALSE;
    }

    public function findByIdAndForgotPasswordCode($userId, $code){
        $user = $this->mapper->findByIdAndForgotPasswordCode($userId, $code);
        return $user;
    }

    public function resetPassword(ResetPasswordForm $form){
        $user = $this->findByIdAndForgotPasswordCode($form->userId, $form->forgotPasswordCode);
        if($user==NULL){
            throw new ServiceException('user not found');
        }
        //TODO: validate forgot password time

        $user->password = $form->newPassword;
        TransactionHelper::enableTransaction($this->app);
        $ret = $this->updateUser($user);
        $this->mapper->clearForgottenPasswordCode($user);
        return TransactionHelper::commitTransaction($this->app);
    }

    private function sendResetPasswordEmail(User $user){
        $htmlmsg = sprintf('<p>To reset your password please go to this link <a href="http://dev.funnlz.io/user/reset/%d/%s">http://dev.funnlz.io/user/reset/%d/%s</a></p>', $user->id, $user->forgottenPasswordCode, $user->id, $user->forgottenPasswordCode);
        $plainmsg = sprintf('To reset your password please go to this link <a href="http://dev.funnlz.io/user/reset/%d/%s">http://dev.funnlz.io/user/reset/%d/%s</a>', $user->id, $user->forgottenPasswordCode, $user->id, $user->forgottenPasswordCode);

        $svc = $this->app['mailerService'];

        $email = new Email();
        $email->fromName = 'Funnlz';
        $email->fromEmail = 'vm@akavesh.com';
        $email->subject = 'Reset Password';
        $email->htmlMessage = $htmlmsg;
        $email->plainTextMessage = $plainmsg;
        $email->toEmail = $user->email;
        $email->toName = $user->firstName.' '.$user->lastName;

        return $svc->sendEmail($email);
    }

    /**
     * social login
     * @param string provider: google, facebook, twitter
     * @param Hybrid_User_Profile $profile
     * return SocialUser or null
    */
    public function socialLogin($provider, $profile){
        //$socialMapper = new SocialUserMapper($this->app['pdo_adapter']);
        //create new user
        $user = new SocialUser();
        $user->provider = $provider;
        $user->socialId = $profile->identifier;
        $user->email = $profile->email;
        $user->firstName = $profile->firstName;
        $user->lastName = $profile->lastName;
        $user->displayName = $profile->displayName;
        if(empty($user->displayName)){
            if(!empty($user->firstName) || !empty($user->lastName)){
                $user->displayName = $user->firstName.' '.$user->lastName;;
            }else{
                if(!empty($user->email)){
                    $user->displayName = $user->email;
                }
            }
        }
        $user->profileURL = $profile->profileURL;

        $prev = $this->mapper->findSocialUser($provider, $profile->identifier);
        if($prev==NULL){
            if( $this->mapper->addSocialUser($user)) {
                $user->username = $user->id;
                $user->firstLogin = TRUE;
                return $user;
            }
        }else{
            $user->firstLogin = FALSE;
            $user->id = $prev->id;
            $user->roles = $prev->roles;
            $user->username = $user->id;
            if($this->mapper->updateLastLogin($user)){
                return $user;
            }
        }
        return NULL;
    }

    public function findSocialUserById($id){
        //$socialMapper = new SocialUserMapper($this->app['pdo_adapter']);
        //return $socialMapper->findById($id);
        return $this->mapper->findSocialUserById($id);
    }
    public function findByIdAndActivationCode($userId, $code){
        $user = $this->mapper->findByIdAndActivationCode($userId, $code);
        return $user;
    }
    private function sendUserActivationEmail(User $user){
        $htmlmsg = sprintf('<p>To activate your account please go to this link <a href="http://dev.funnlz.io/user/activate/%d/%s">http://dev.funnlz.io/user/activate/%d/%s</a></p>', $user->id, $user->activationCode, $user->id, $user->activationCode);
        $plainmsg = sprintf('To activate your account please go to this link <a href="http://dev.funnlz.io/user/activate/%d/%s">http://dev.funnlz.io/user/activate/%d/%s</a>', $user->id, $user->activationCode, $user->id, $user->activationCode);

        $svc = $this->app['mailerService'];

        $email = new Email();
        $email->fromName = 'Funnlz';
        $email->fromEmail = 'vm@akavesh.com';
        $email->subject = 'Activate Your Account';
        $email->htmlMessage = $htmlmsg;
        $email->plainTextMessage = $plainmsg;
        $email->toEmail = $user->email;
        $email->toName = $user->firstName.' '.$user->lastName;

        return $svc->sendEmail($email);
    }

    public function activateUser(User $user){
        //save to db
        $ret = $this->mapper->activateUser($user);
        if($ret){
            return $user;
        }
        return FALSE;
    }

    public function updatePassword(UpdatePasswordForm $form){
        $user = $this->mapper->findById($form->userId);
        if($user==NULL){
            throw new ServiceException('user not found');
        }
        if (password_verify($form->password, $user->password)) {
            $user->password = $form->newPassword;
            $ret = $this->updateUser($user);
            return $ret;
        }else{
            throw new ServiceException('Invalid password');
        }
        return FALSE;
    }

    /**
     * search users
     * @param Paging pagination
     * @return NULL or list of products in PagingResult
     */
    public function search(Paging $paging){
        return $this->mapper->search($paging);
    }

    public function delete($id){
        $user = $this->mapper->findById($id);
        if($user==NULL){
            throw new ServiceException('user not found');
        }

        TransactionHelper::enableTransaction($this->app);
        //delete products first
        $productMapper = new ProductMapper($this->app['pdo_adapter']);
        $productMapper->deleteByUser($id);
        //delete the user
        $this->mapper->delete($id);
        return TransactionHelper::commitTransaction($this->app);
    }
}