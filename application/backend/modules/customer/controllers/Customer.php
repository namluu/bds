<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
    }

    public function index()
    {
        $customers = $this->customer_model->get_all();

        $data['customers'] = $customers;
        $data['main_view'] = 'customer/index';
        $data['title'] = 'List customers';
        $this->load->view('layout/1column', $data);
    }

    public function add()
    {
        $this->edit();
    }

    public function edit($id = null)
    {
        $customer = $this->customer_model->get($id);

        if ($data = $this->input->post()) {
            $this->form_validation->set_rules('email', 'Title', 'required|valid_email');
            try {
                if ($this->form_validation->run() == false) {
                    $this->session->set_flashdata('error', validation_errors());
                } else {
                    $this->customer_model->save($data, $data['id']);
                    $this->session->set_flashdata('success', 'Save successfully');
                    redirect('customer/customer');
                }
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }

        $data['customer'] = $customer;
        $data['main_view'] = 'customer/edit';
        $data['title'] = $id ? 'Edit customer: '.$customer->email : 'New customer';
        $this->load->view('layout/1column', $data);
    }

    public function delete($id)
    {
        $customer = $this->customer_model->get($id);
        if (!$customer->id) {
            $this->session->set_flashdata('error', 'Entity does not exist');
            redirect('customer/customer');
        }
        $this->customer_model->delete($id);
        $this->session->set_flashdata('success', 'Delete successfully');
        redirect('customer/customer');
    }

    public function disable($id)
    {
        $this->enable($id, false);
    }

    public function enable($id, $enable = true)
    {
        $customer = $this->customer_model->get($id);
        if (!$customer->id) {
            $this->session->set_flashdata('error', 'Entity does not exist');
            redirect('customer/customer');
        }
        $data['is_active'] = $enable ? 1 : 0;
        $this->customer_model->save($data, $id);
        $this->session->set_flashdata('success', 'Save successfully');
        redirect('customer/customer');
    }
}
