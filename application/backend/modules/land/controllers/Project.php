<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('section_model');
        $this->load->model('project_model');
    }

    public function index()
    {
        $projects = $this->project_model->get_all();

        $data['projects'] = $projects;
        $data['main_view'] = 'project/index';
        $data['title'] = 'List projects';
        $this->load->view('layout/1column', $data);
    }

    public function add()
    {
        $this->edit();
    }

    public function edit($id = null)
    {
        $project = $this->project_model->get($id);

        if ($data = $this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'required');
            try {
                if ($this->form_validation->run() == false) {
                    $this->session->set_flashdata('error', validation_errors());
                } else {
                    $alias = string_url_safe($data['title']);
                    $data['alias'] = $this->project_model->get_unique_slug($alias, $id);
                    $this->project_model->save($data, $data['id']);
                    $this->session->set_flashdata('success', 'Save successfully');
                    $this->redirectIndex();
                }
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }

        $data['categories'] = $this->category_model->get_data_form('id', 'title');

        $data['project'] = $project;
        $data['main_view'] = 'project/edit';
        $data['title'] = $id ? 'Edit project: '.$project->title : 'New project';
        $this->load->view('layout/1column', $data);
    }
}