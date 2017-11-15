<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('customer_model');
        $this->load->model('account_model');
    }

    public function facebook()
    {
        $this->load->library('facebook');
        $loginUrl = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('customer/auth/fbcallback'), 
            'scope' => array("email") // permissions here
        ));
        redirect($loginUrl);
    }

    public function fbcallback()
    {
        $this->load->library('facebook');
        $user = $this->facebook->getUser();
        $userProfile = null;
        if ($user) {
            try {
                // get permission validate by facebook
                $userProfile = $this->facebook->api('/me');
                if ($userProfile && isset($userProfile['email'])) {
                    $email = $userProfile['email'];
                    if (!$this->customer_model->check_exists('email', $email)) {
                        $this->addFacebookData($userProfile);
                    }
                    $customer = $this->account_model->authenticate($email, 'fb_password');
                    $this->session_model->setCustomerDataAsLoggedIn($customer);
                    $this->session->set_flashdata('success', 'Login successfully');
                    redirect('customer/account');
                }
            } catch (FacebookApiException $e) {
                $this->session->set_flashdata('error', $e);
                redirect('customer/account/login');
            }
        }

        $this->session->set_flashdata('error', $this->lang->line('login_fail'));
        redirect('customer/account/login');
    }

    public function addFacebookData($data)
    {
        $user_id = $this->account_model->createAccount($data, 'fb_password');

        $fbid = $data['id'];
        $arrContextOptions = array(
            'ssl'=>array(
                'cafile' => APPPATH.'/libraries/fb_ca_chain_bundle.crt',
                'verify_peer'=> true,
                'verify_peer_name'=> true,
            ),
        );
        $avatar = file_get_contents('https://graph.facebook.com/'.$fbid.'/picture?width=180', 
            false, stream_context_create($arrContextOptions));
        $avatar_name = 'facebook-avatar.jpg';
        $destinationDirectory = 'upload/data/users/'.$user_id.'/';
        if(!is_dir($destinationDirectory)) //create the folder if it's not already exists
        {
            mkdir($destinationDirectory,0777,TRUE);
        } 
        file_put_contents($destinationDirectory.$avatar_name, $avatar);

        $this->customer_model->save(['avatar' => $avatar_name], $user_id);
    }
}