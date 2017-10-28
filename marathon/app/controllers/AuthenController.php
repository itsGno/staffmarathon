<?php

class AuthenController extends ControllerBase{

    public function indexAction(){
      // $month = Month::get();
      // $this->view->month = $month;
      $this->view->pick("layouts/formlogin"); // ดึงไฟล์มาแสดง

      if($this->request->isPost()){
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        $member = Staff::findFirst(["conditions"=>"username=?1","bind"=>[1=>$username]]); // ค้นหา customer ด้วย username
        $id = $member->id;
        // $this->security->hash($password); // สร้างรหัสผ่านแบบเข้ารหัส เปลี่ยนใหม่เรื่อยๆจากรหัสผ่านเดิม

        if($password == $member->password){ // ตรวจสอบรหัสถูกต้องตรงกันจากที่กรอกเข้ามาและฐานข้อมูล
            $this->setSession($username,$password,$id);
          if(!empty($remember))
          $this->setCookies($username, $password,$id); // Fn ตั้งค่าคุ๊กกี้
          else $this->deleteCookies(); // Fn ลบ คุ๊กกี้

        //  $this->flashSession->success("ยินดีต้อนรับคุณ $username"); // เข้าระบบสำเร็จ
          // $this->response->redirect("index"); // เปลี่ยนเส้นทาง

        }else{
          $this->flashSession->error("รหัสผ่านไม่ถูกต้อง"); // รหัสผ่านไม่ถูก
          $this->response->redirect("authen"); // เปลี่ยนเส้นทาง

        }

      }
    }

    function setCookies($username, $password){
      $hour = time() + 3600 * 24 * 30;

      $this->cookies->set("username",$username,$hour);
      $this->cookies->set("password",$password,$hour); // set cookie
      $this->cookies->set("id",$password,$hour); // set cookie


      return;
    }
    function setSession($username, $password,$id){
      $this->session->set("username",$username); // set session
      $this->session->set("password",$password);
      $this->session->set("id",$id);
      return;
    }

    function deleteCookies(){
      $cookiesusername = $this->cookies->get('username');
      $cookiesPass = $this->cookies->get('password');

      $cookiesusername->delete(); // delete cookie
      $cookiesPass->delete(); //delete cookie

      return;
    }

    public function getdatafbAction(){
      $this->view->disable();
      $token = $this->request->getPost('token');
      $fb = $this->getDI()->getShared('facebook');
      $response = $fb->get('/me?fields=id,name,username,picture', $token);
      $user = $response->getGraphUser();
      var_dump($user);
      // exit();

      // $this->view->disable();
      // $token = $this->request->getPost('token');
      // $fb = $this->getDI()->getShared('facebook');
      // $response = $fb->get('/me?fields=id,name,username,first_name,last_name,gender,middle_name,short_name,picture', $token);
      // $user = $response->getGraphUser();

      // if($user){
      //   $dataUser = json_decode($user);
      //   $member = Member::findFirst(["conditions"=>"username=?1","bind"=>[1=>$dataUser->username]]);
      //
      //   if(COUNT($member) == 0 || empty($member)){
      //     $data = new Member();
      //     $data->firstName = $dataUser->first_name;
      //     $data->midName = $dataUser->middle_name;
      //     $data->lastName = $dataUser->last_name;
      //     $data->gender = $dataUser->gender;
      //     $data->username = $dataUser->username;
      //     $data->facebookId = $dataUser->id;
      //     $data->pictureType = 1;
      //     $data->picture = $dataUser->picture->url;
      //     $data->loginType = 1;
      //
      //     if($data->save() != false){
      //       $this->session->set("memberAuthen", ["firstName"=>$dataUser->first_name,"midName"=>$dataUser->middle_name,"lastName"=>$dataUser->last_name,"picture"=>$dataUser->picture->url,"username"=>$dataUser->username]);
      //       $this->flashSession->success('Saved');
      //       echo "success";
      //     }else {
      //       $this->flashSession->success('Save Failed');
      //       echo "failed";
      //     }
      //   }else{
      //     if($member->loginType == "1"){ //facebook
      //       if(!$this->session->has("memberAuthen")){
      //         $this->session->set("memberAuthen", ["firstName"=>$dataUser->first_name,"midName"=>$dataUser->middle_name,"lastName"=>$dataUser->last_name,"picture"=>$dataUser->picture->url,"username"=>$dataUser->username]);
      //         echo "success";
      //       }
      //     }else if($member->loginType == "2"){ //google
      //       echo "failed";
      //     }else{
      //       echo "failed";
      //     }
      //   }
      // }else{
      //   echo "failed";
      // }
    }

    public function logoutAction(){
      $this->session->remove('username'); //delete session
      $this->session->remove('password'); //delete session

      $this->session->getId(); //reset id session
      $this->session->regenerateId(); //create id new session

      $this->response->redirect("authen");
    }

    public function googlecallbackAction(){
      // if(file_exists(__DIR__ . "/../../public/lib/Google/src/Google/autoload.php"))
      //   include_once __DIR__ . "/../../public/lib/Google/src/Google/autoload.php";
      // else
      //   echo "false";

      $client = $this->getDI()->getShared('google_client');
      // $client = new Google_Client();
      // $client->setClientId($this->config->google->clientId);
      // $client->setClientSecret($this->config->google->clientSecret);
      // $client->setRedirectUri($this->config->google->redirect);
      // $client->addScope("username");
      // $client->addScope("profile");

      if ($this->request->get('code')) {
        $client->authenticate($this->request->get('code'));
        $this->session->set('access_token', $client->getAccessToken());
        header('Location: ' . filter_var($this->config->google->profile, FILTER_SANITIZE_URL));

      } else {
        $auth_url = $client->createAuthUrl();
        echo '<div align="center">';
        echo '<h3>Login with Google</h3>';
        echo '<div>Please click login button to connect to Google.</div>';
        echo '<a class="login" href="' . $auth_url . '"><img src="../img/google-login-button.png" /></a>';
        echo '</div>';
       // header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
      }

      /*if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
        $service = new Google_Service_Oauth2($client);
          $client->setAccessToken($_SESSION['access_token']);

        $user = $service->userinfo->get();
        echo '<img src="'.$user->picture.'" style="float: right;margin-top: 33px;" />';
          echo 'Welcome '.$user->name.'! [<a href="'.$this->config->google->redirect.'?logout=1">Log Out</a>]';


        //print user details
        echo '<pre>';
        print_r($user);
        echo '</pre>';
      }*/
      if ($this->request->get('logout')) {
        $this->session->remove('access_token');
      }

    }

    public function profileAction(){
      // if(file_exists(__DIR__ . "/../../public/lib/Google/src/Google/autoload.php"))
      //   include_once __DIR__ . "/../../public/lib/Google/src/Google/autoload.php";
      // else
      //   echo "false";

      $client = $this->getDI()->getShared('google_client');
      // $client = new Google_Client();
      // $client->setClientId($this->config->google->clientId);
      // $client->setClientSecret($this->config->google->clientSecret);
      // $client->setRedirectUri($this->config->google->redirect);

      if ($this->session->has('access_token')) {
        // $service = new Google_Service_Oauth2($client);
        $service = $this->getDI()->getShared('google_service_oauth2');
          $client->setAccessToken($this->session->get('access_token'));

        $user = $service->userinfo->get();
        echo '<img src="'.$user->picture.'" style="float: right;margin-top: 33px;" />';
        echo 'Welcome '.$user->name.'! [<a href="'.$this->config->google->redirect.'?logout=1">Log Out</a>]';


        //print user details
        echo '<pre>';
        print_r($user);
        echo '</pre>';
      }
      else{
        header('Location: ' . filter_var($this->config->google->redirect, FILTER_SANITIZE_URL));
      }

      exit();
    }

}
