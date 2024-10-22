<?php declare(strict_types = 1);
namespace App\Core;

use App\System\App;
use Http\Request;
use Modules\System\Processes\WorkflowManager;
use App\Utils\FormMgr;
use Com\Tecnick\Barcode\Barcode;
class Auth extends BaseController
{
    protected $app;
    protected $wfManager;
    
    public function __construct(App $app) {
        $this->app = $app; 
        $this->wfManager = new \Modules\System\Processes\WorkflowManager();
    }
    
    public function login()
    {
        $barcode = new Barcode();
        $dir = "qr-code/";
        if (! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $url = $this->app->Router()->baseUrl();        
        $urlName = explode('/',$url);
        if( !file_exists( $dir . $urlName[2] . '.png')) {

            $qrcodeObj = $barcode->getBarcodeObj('QRCODE,H', $url, - 16, - 16, 'black', array(- 2,- 2,- 2,- 2))->setBackgroundColor('#f5f5f5');
            $imageData = $qrcodeObj->getPngData();
            $this->data['qrcode'] = file_put_contents($dir . $urlName[2] . '.png', $imageData);
            $this->data['dir'] = $dir;
            $this->data['timestamp'] = $urlName[2];
        }else{
            $this->data['dir'] = $dir;
            $this->data['timestamp'] = $urlName[2];
        }
        
        
        if($this->app->Auth()->isLogin())
        {
         $this->app->Response()->redirect(_AFTERLOGIN);   
        }
        if($this->app->isPost())
        {
            $user = $this->app->Request()->getParameter("username");
            $pass = $this->app->Request()->getParameter("password");            
            
            if($this->app->Auth()->Authorise($user, $pass))
            {
                $u = $this->app->Auth()->getUser();
                $fcmtoken = $this->app->Request()->getParameter("fcmtoken","");
                // if($fcmtoken != "" && $u->getFcmToken() != $fcmtoken)
                // {                    
                //     $u->setFcmToken($fcmtoken);
                //     $u->save();
                // }
                $this->app->Response()->redirect(_AFTERLOGIN);                
            }
            else 
            {
                $this->app->Session()->setFlash("error", "Email or Password is incorrect");
                
            }
        }
        
        $this->app->Renderer()->render('auth\login.twig', $this->data);                
        
    }
    
    public function logout()
    {
        $this->app->Auth()->logout();
        $this->app->Response()->redirect($this->app->Router()->getPath('login'));
    }
    
    public function changePwd()
    {
        
        if($this->app->isPost())
        {
            $oldpwd = $this->app->Request()->getParameter("oldpwd");
            $newpwd = $this->app->Request()->getParameter("newpwd");
            $renewpwd = $this->app->Request()->getParameter("renewpwd");
            
            $user = $this->app->Auth()->getUser();
            if($user->getPassword() == md5($oldpwd))
            {
                $user->setPassword(md5($newpwd));
                $user->save();
                $this->closeModal();
                return;
            }
            else 
            {
                $this->app->Session()->setFlash("error", "Current Password does not match");                                 
            }
        }
        
        
        $this->app->Renderer()->render('auth\changepwd.twig',$this->data);                
        
    }
    public function forgotPwd()
    {
       // echo "This needs to change";
        
       if($this->app->isPost())
        {          
            $username = $this->app->Request()->getParameter("username");
            $defaultConfig = \Modules\ESS\Runtime\EssHelper::forgotpassword($username,"system",$this->app);
            if($defaultConfig){
                $this->app->Session()->setFlash("message", "Your request has been sent to ".$defaultConfig);
            }else{
                $this->app->Session()->setFlash("message", "User not found");
            }
        }
        //rupal.majmudar@biotechhealthcare.com
       $this->app->Renderer()->render('auth\forgotpwd.twig',$this->data);                
        
        
    }
    
    public function authoriseWithToken($id){
        // echo "This needs to change";
        $this->app->Auth()->AuthoriseWithToken($id);
        $this->app->Response()->redirect('/home');  
    }


    public function register()
    {
       
        
       if($this->app->isPost()){
            $exists = \entities\UsersQuery::create()                    
                    ->findByUsername($_POST['OwnerEmail'])->count();
            if($exists > 0)
            {
                $this->app->Session()->setFlash("error", "Sorry, this email id already exists in the system!!!");                            
                $this->data['post'] = $_POST;                                                 
            }
            else {
                
                        $CountryId = $this->app->Request()->getParameter("CountryId");
                        //$_POST['CompanyCode'] = strtoupper($_POST['CompanyCode']);
                        $company = new \entities\Company();
                        $company->fromArray($_POST);                                        
                        $company->save();
                        
                        //welcome email
                        
                        \Modules\HR\Runtime\HrHelper::firstDataSetup($company->getPrimaryKey(),$_POST['Password'],$this->app,$CountryId);
                        
                        $this->app->Auth()->Authorise($_POST['OwnerEmail'], $_POST['Password']);
                
                        $this->app->Response()->redirect(_AFTERLOGIN);  
            }
        } 
        
       $this->app->Renderer()->render('auth\register.twig',$this->data);                
        
        
    }
    
    public function getCountryForRegister(){
        
        $getCountry = $this->app->Request()->getParameter("country");
        
        $Country = \entities\GeoCountryQuery::create()
                ->filterByScountry($getCountry."%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                ->find()->toArray();
        
        return $this->json($Country);
    }
    public function register_new()
    {
       
        
       if($this->app->isPost()){
            $exists = \entities\UsersQuery::create()                    
                    ->findByUsername($_POST['OwnerEmail'])->count();
            if($exists > 0)
            {
                $this->app->Session()->setFlash("error", "Sorry, this email id already exists in the system!!!");                            
                $this->data['post'] = $_POST;                                                 
            }
            else {
                
                        //$_POST['CompanyCode'] = strtoupper($_POST['CompanyCode']);
                        $company = new \entities\Company();
                        $company->fromArray($_POST);                                        
                        $company->save();
                        
                        //welcome email
                        
                        \Modules\HR\Runtime\HrHelper::firstDataSetup($company->getPrimaryKey(),$_POST['Password'],$this->app);
                        
                        $this->app->Auth()->Authorise($_POST['OwnerEmail'], $_POST['Password']);
                
                        $this->app->Response()->redirect(_AFTERLOGIN);  
            }
        } 
        
       $this->app->Renderer()->render('auth\register_new.twig',$this->data);                
        
        
    }
    
    
}
