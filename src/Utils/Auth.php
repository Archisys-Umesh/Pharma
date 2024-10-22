<?php

namespace App\Utils;

use Aura\Session\SessionFactory;
use Aura\Session\Segment;
use entities\Users;
use entities\UserSessions;
use entities\UserSessionsQuery;
use Exception;

class Auth {

    private $isLogin;
    private $user;
    protected $perms;
    private $company_id = 0;
    /* @var $session SessionFactory */
    protected $session;
    protected $error;
    protected $RedisEnable = false;
    protected $redisClient = false;

    public function __construct() {

        $session_factory = new SessionFactory;
        $sesObj = $session_factory->newInstance($_COOKIE);
        //$sesObj->setCookieParams(array('lifetime' => '1209600'));        
        $this->session = $sesObj->getSegment(_SESSIONKEY);
        
        $this->RedisEnable = $_ENV['RedisEnabled'] == "true" ? true : false;

        if($this->RedisEnable) {
        
            try {
                $this->redisClient = new \Predis\Client($_ENV['REDIS_URL']."?ssl[verify_peer_name]=0&ssl[verify_peer]=0");
                $this->redisClient->isConnected();
            }
            catch(Exception $e)
            {
                $this->RedisEnable = false;
            }
            
        }

        $this->perms = array('any');
        $sesToken = $this->session->get("sesToken","");
        $user = [];
        
        // API Auth
        if (strlen($sesToken) != 50) {      
            
            if(isset($_GET["apptoken"])) { $_SERVER['HTTP_APPTOKEN'] = $_GET["apptoken"]; }            
            if (isset($_SERVER['HTTP_APPTOKEN'])) { $sesToken = $_SERVER['HTTP_APPTOKEN']; }
        }
        
        if($this->RedisEnable && $this->redisClient->exists($sesToken)) {

            $user = unserialize($this->redisClient->get($sesToken));
        }
        else {
            $usersession = UserSessionsQuery::create()->filterBySessionToken($sesToken)->findOne();                    
            if($usersession != null && $usersession->getUserId() > 0 )
            {
                $user = \entities\UsersQuery::create()
                            ->joinWithRoles()
                            ->findPk($usersession->getUserId());
                if($this->RedisEnable) {
                    $this->redisClient->set($sesToken,serialize($user));
                }
            }    
        }
        
        if ($user != null) {        
            $this->perms[] = "loggedin";
            $this->_init($user);
        } else {
            $this->isLogin = false;
        }
    }
    
    public function AuthoriseWithPhone($user, $rest = false): bool {
        
        /* @var $user Users */
        $user = \entities\UsersQuery::create()->joinWithRoles()->findOneBy("phone", $user->getPhone());

        $log = new \entities\UserLoginLog();

        $log->setUserName($user->getPhone());
        $log->setIp($_SERVER['REMOTE_ADDR']);
        $log->setBrowser($_SERVER['HTTP_USER_AGENT']);
        $log->setTimestamp(time());
        if ($user) {

            if ($user->getStatus() == 0) { 
                $this->error = "User inactive";
                $log->setStatus("User inactive");
                $log->save();

                return false;
            } else if ($user->getPhone()) { 
                $log->setStatus("Logged In");
                $log->save();

                $genToken = new \App\Utils\TokenGenerator();
                $token = $genToken->generateToken(50);
               
                $user->setLastLogin(strtotime("now"));

                if (!$rest) {
                    $user->setSessionToken($token);

                    $user->save();

                    $this->session->set("sesToken", $token);
                    $this->session->set("user", $user->getPrimaryKey());
                } else {
                    $user->setAppToken($token);
                    $user->save();
                }
                
                $sessionStore = new UserSessions();
                $sessionStore->setUserId($user->getPrimaryKey());
                $sessionStore->setSessionToken($token);
                $sessionStore->setIpAddress($_SERVER['REMOTE_ADDR']);
                $sessionStore->setDevice($_SERVER['HTTP_USER_AGENT']);
                $sessionStore->save();

                $this->_init($user);
                return true;
            } else {
                $log->setStatus("Mobile number is incorrect!");
                $log->save();
                $this->error = NULL;
                return false;
            }
        } else {
            $log->setStatus("User not found");
            $log->save();
            $this->error = "User not found";
            return false;
        }
    }

    public function Authorise($username, $pwd, $rest = false): bool {
        /* @var $user Users */
        $user = \entities\UsersQuery::create()
                ->joinWithRoles()
                ->findOneBy("username", $username);

        $log = new \entities\UserLoginLog();

        $log->setUserName($username);
        $log->setIp($_SERVER['REMOTE_ADDR']);
        $log->setBrowser($_SERVER['HTTP_USER_AGENT']);
        $log->setTimestamp(time());
        if ($user) {

            if ($user->getStatus() == 0) { // check user active
                $this->error = "User inactive";
                $log->setStatus("User inactive");
                $log->save();

                return false;
            } else if ($user->getPassword() == md5($pwd)) { // Password Match
                $log->setStatus("Logged In");
                $log->save();

                $genToken = new \App\Utils\TokenGenerator();
                $token = $genToken->generateToken(50);
                
                $user->setLastLogin(strtotime("now"));

                if (!$rest) {

                    $user->setSessionToken($token);
                    $user->save();

                    $this->session->set("sesToken", $token);
                    $this->session->set("user", $user->getPrimaryKey());
                } else {
                    $user->setAppToken($token);
                    $user->save();
                }

                $sessionStore = new UserSessions();
                $sessionStore->setUserId($user->getPrimaryKey());
                $sessionStore->setSessionToken($token);
                $sessionStore->setIpAddress($_SERVER['REMOTE_ADDR']);
                $sessionStore->setDevice($_SERVER['HTTP_USER_AGENT']);
                $sessionStore->save();
                //$sessionStore->setCreatedAt(curr)
;
                $this->_init($user);
                return true;
            } else {
                $log->setStatus("Password is Incorrect");
                $log->save();
                $this->error = NULL;
                return false;
            }
        } else {
            $log->setStatus("User not found");
            $log->save();
            $this->error = "User not found";
            return false;
        }
    }

    public function AuthoriseWithToken($token): bool {
        $this->session->set("sesToken", $token);
        $this->session->set("isAdmin", 'true');
        return true;
    }

    private function _init(\entities\Users $user) {
       
       
        $this->user = $user;
        $this->company_id = $user->getCompanyId();
        $perm = explode(",", $user->getRoles()->getRolePermissions());
        $this->setPerms($perm);
        $this->isLogin = true;
    }

    public function CompanyId(): int {
        return $this->company_id;
    }

    public function isLogin(): bool {
        return $this->isLogin;
    }

    public function getUser(): \entities\Users {
        return $this->user;
    }

    public function logout() {

        $session_factory = new SessionFactory;
        $sesObj = $session_factory->newInstance($_COOKIE);
        //$sesObj->setCookieParams(array('lifetime' => '1209600'));        
        $this->session = $sesObj->getSegment(_SESSIONKEY);
        $this->perms = array('any');
        $sesToken = $this->session->get("sesToken");        

        // API Auth
        if (strlen($sesToken) != 50) {      
            
            if(isset($_GET["apptoken"])) { $_SERVER['HTTP_APPTOKEN'] = $_GET["apptoken"]; }            
            if (isset($_SERVER['HTTP_APPTOKEN'])) { $sesToken = $_SERVER['HTTP_APPTOKEN']; }
        }

        if($this->RedisEnable && $this->redisClient->exists($sesToken)) {
            $this->redisClient->delete($sesToken);            
        }

        $sessions = UserSessionsQuery::create()
            ->filterBySessionToken($sesToken)
            ->find();
        foreach($sessions as $session)
        {
            $session->delete();
        }

        $this->isLogin = false;
        $this->session->set("user", "");
        $this->session->set("sesToken", "");
    }

    public function setPerms($perm = array()) {
        $this->perms = array_merge($this->perms, $perm);
    }

    public function getPerms(): array {
        return $this->perms;
    }

    public function checkPerm($perm) {
        return in_array($perm, $this->perms);
    }

    public function getError() {
        return $this->error;
    }

    function getRealIpAddr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

}
