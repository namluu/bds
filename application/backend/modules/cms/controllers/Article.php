<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('article_model');
    }

    public function index()
    {
        $limit = 20;
        $startIndex = $this->input->get('per_page') ? $this->input->get('per_page') : 0;
        $articles = $this->article_model->get_all($limit, $startIndex);
        $total = $this->article_model->num_rows();

        $data['articles'] = $articles;
        $data['title'] = 'List articles';
        $data['main_view'] = 'article/index';
        $data['pagination'] = $this->initPagination($total, $limit);
        $this->load->view('layout/1column', $data);
    }

    public function add()
    {
        $this->edit();
    }

    public function edit($id = null)
    {
        $article = $this->article_model->get($id);

        if ($data = $this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('content', 'Content', 'required');
            try {
                if ($this->form_validation->run() == false) {
                    $this->session->set_flashdata('error', validation_errors());
                } else {
                    $alias = string_url_safe($data['title']);
                    $data['alias'] = $this->article_model->get_unique_slug($alias, $id);
                    $this->article_model->save($data, $data['id']);
                    $this->session->set_flashdata('success', 'Save successfully');
                    $this->redirectIndex();
                }
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }

        $data['article'] = $article;
        $data['main_view'] = 'article/edit';
        $data['title'] = $id ? 'Edit article: '.$article->title : 'New article';
        $this->load->view('layout/1column', $data);
    }

    public function delete($id)
    {
        $article = $this->article_model->get($id);
        if (!$article->id) {
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
        $article = $this->article_model->get($id);
        if (!$article->id) {
            $this->session->set_flashdata('error', 'Entity does not exist');
            $this->redirectIndex();
        }
        $data['is_active'] = $enable ? 1 : 0;
        $this->article_model->save($data, $id);
        $this->session->set_flashdata('success', 'Save successfully');
        $this->redirectIndex();
    }

    public function sortup($id)
    {
        $this->sortdown($id, false);
    }

    public function sortdown($id, $down = true)
    {
        $article = $this->article_model->get($id);
        if (!$article->id) {
            $this->session->set_flashdata('error', 'Entity does not exist');
            $this->redirectIndex();
        }

        if ($down) {
            $data['sort_order'] = $article->sort_order + 1;
        } else {
            if ($article->sort_order != 0) {
                $data['sort_order'] = $article->sort_order - 1;
            }
        }
        
        $this->article_model->save($data, $id);
        $this->session->set_flashdata('success', 'Save successfully');

        $this->redirectIndex();
    }
}
