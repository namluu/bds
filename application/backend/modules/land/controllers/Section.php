<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('section_model');
    }

    public function index()
    {
        $sections = $this->section_model->get_all();

        $data['sections'] = $sections;
        $data['main_view'] = 'section/index';
        $data['title'] = 'List sections';
        $this->load->view('layout/1column', $data);
    }

    public function add()
    {
        $this->edit();
    }

    public function edit($id = null)
    {
        $section = $this->section_model->get($id);

        if ($data = $this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'required');
            try {
                if ($this->form_validation->run() == false) {
                    $this->session->set_flashdata('error', validation_errors());
                } else {
                    $alias = string_url_safe($data['title']);
                    $data['alias'] = $this->section_model->get_unique_slug($alias, $id);
                    $this->section_model->save($data, $data['id']);
                    $this->session->set_flashdata('success', 'Save successfully');
                    $this->redirectIndex();
                }
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }

        $data['section'] = $section;
        $data['main_view'] = 'section/edit';
        $data['title'] = $id ? 'Edit section: '.$section->title : 'New section';
        $this->load->view('layout/1column', $data);
    }

    public function delete($id)
    {
        $category = $this->category_model->get($id);
        if (!$category->id) {
            $this->session->set_flashdata('error', 'Entity does not exist');
            $this->redirectIndex();
        }
        $this->category_model->delete($id);
        $this->session->set_flashdata('success', 'Delete successfully');
        $this->redirectIndex();
    }

    public function disable($id)
    {
        $this->enable($id, false);
    }

    public function enable($id, $enable = true)
    {
        $category = $this->category_model->get($id);
        if (!$category->id) {
            $this->session->set_flashdata('error', 'Entity does not exist');
            $this->redirectIndex();
        }
        $data['is_active'] = $enable ? 1 : 0;
        $this->category_model->save($data, $id);
        $this->session->set_flashdata('success', 'Save successfully');
        $this->redirectIndex();
    }

    public function sortup($id)
    {
        $this->sortdown($id, false);
    }

    public function sortdown($id, $down = true)
    {
        $category = $this->category_model->get($id);
        if (!$category->id) {
            $this->session->set_flashdata('error', 'Entity does not exist');
            $this->redirectIndex();
        }

        if ($down) {
            $data['sort_order'] = $category->sort_order + 1;
        } else {
            if ($category->sort_order != 0) {
                $data['sort_order'] = $category->sort_order - 1;
            }
        }
        
        $this->category_model->save($data, $id);
        $this->session->set_flashdata('success', 'Save successfully');

        $this->redirectIndex();
    }
}
