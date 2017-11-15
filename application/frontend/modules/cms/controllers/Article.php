<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MX_Controller 
{
    public function _remap($method, $params = [])
    {
        $this->load->model('cms/Category_model');
        $this->load->model('Article_model');
        $segments = [];

        switch (count($params)) {
            case 2:
                $category = $this->Category_model->get_by(['alias' => $params[0]], true);
                $article = $this->Article_model->get_by(['alias' => $params[1]], true);
                if (!$category || !$article) {
                    break;
                }
                $segments[] = $article->id;
                $segments[] = $category->id;
                
                if (method_exists($this, $method)) {
                    return call_user_func_array(array($this, $method), $segments);
                }
                break;
            case 1:
                $article = $this->Article_model->get_by(['alias' => $params[0]], true);
                if (!$article) {
                    break;
                }
                $segments[] = $article->id;

                if (method_exists($this, $method)) {
                    return call_user_func_array(array($this, $method), $segments);
                }
                break;
            case 0:
                show_404();
                break;
        }
        show_404();
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Article_model');
        $this->load->model('cms/Category_model');
    }

    public function view($articleId, $categoryId = null)
    {
        $article = $this->Article_model->get($articleId);

        $data['article'] = $article;
        $data['title'] = $article->title;
        $data['main_view'] = 'article/view';
        $this->load->view('layout/2columns', $data);
    }
}