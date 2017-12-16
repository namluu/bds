<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Article_model extends MY_Model
{
    protected $_table = 'cms_article';

    public function save($data, $id = null)
    {
        $alias = string_url_safe($data['title']);
        $uniqueAlias = $this->article_model->get_unique_slug($alias, $id);

        
        $dataPrepare = [
            'title' => $data['title'],
            'content' => $data['content'],
            'alias' => $uniqueAlias
        ];
        

        $id = parent::save($dataPrepare, $id);

        // image
        if ($this->input->post('images')) {
            $isUpload = $this->uploadimage($id,$data);
            if($isUpload){
                $id = parent::save(['image' => $data['image']], $id);
            }
        }

        return $id;
    }

    public function uploadimage($id,&$data){
        $images = $data['images'];

        $path_to = BASEPATH.'../images/cms/'.$id;
        if(!is_dir($path_to)){
            mkdir($path_to,0777, true);
        }

        if(!empty($images['image'])){
            $file_name = $images['image'];
            $file_name = preg_replace("#[^a-zA-Z0-9_\-.]+#", "_", $file_name);
            $path = BASEPATH.'../tmp/upload/'.$images['image'];
            $result = copy($path,$path_to.'/'.$file_name);
            if($result){
                $data['image'] = $file_name;
                require_once(APPPATH.'libraries/image.php');
                // thumb_780_203
                /*$img = new Image($path_to.'/'.$file_name);
                $img->resize(780,203);
                $img->save($path_to.'/thumb_780_203_'.$file_name);
                $img = new Image($path_to.'/'.$file_name);
                $img->crop(780,203);
                $img->save($path_to.'/thumb_780_203_crop_'.$file_name);
                // thumb_378_252
                $img = new Image($path_to.'/'.$file_name);
                $img->resize(378,252);
                $img->save($path_to.'/thumb_378_252_'.$file_name);
                $img = new Image($path_to.'/'.$file_name);
                $img->crop(378,252);
                $img->save($path_to.'/thumb_378_252_crop_'.$file_name);
                // thumb_244_195
                $img = new Image($path_to.'/'.$file_name);
                $img->resize(244,195);
                $img->save($path_to.'/thumb_244_195_'.$file_name);
                $img = new Image($path_to.'/'.$file_name);
                $img->crop(244,195);
                $img->save($path_to.'/thumb_244_195_crop_'.$file_name);*/
                // thumb_260_168
                /*$img = new Image($path_to.'/'.$file_name);
                $img->resize(260,168);
                $img->save($path_to.'/thumb_260_168_'.$file_name);
                $img = new Image($path_to.'/'.$file_name);
                $img->crop(260,168);
                $img->save($path_to.'/thumb_260_168_crop_'.$file_name);*/
                // thumb_65_65
                $img = new Image($path_to.'/'.$file_name);
                $img->resize(65,65);
                $img->save($path_to.'/thumb_65_65_'.$file_name);
                $img = new Image($path_to.'/'.$file_name);
                $img->crop(65,65);
                $img->save($path_to.'/thumb_65_65_crop_'.$file_name);
            }
            return true;
        }
        return false;
    }

    public function removeImage($id = 0){
        return parent::save(['image' => ''], $id);
    }
}