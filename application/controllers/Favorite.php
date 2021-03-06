<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favorite extends API_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Model_favorite');
    }
    
    public function team_get($id = "")
    {
        $response['status'] = 200;
        $response['error'] = false;
        $response['message'] = 'Approved';
        $response['data'] = array();
        
        if($id == ""){
            $query = $this->Model_favorite->get_list_team($this->jwtData->id);
            
            foreach ($query as $key => $value) {
                $item = (array) json_decode($value["favoriteTeamGson"]);
                
                $item["faveroiteTeamId"] = $value["faveroiteTeamId"];
                
                array_push($response["data"], $item);
            }
        }else{
            $query = $this->Model_favorite->get_team($this->jwtData->id, $id);
            
            if($query){
                $response['data'] = (array) json_decode($query["favoriteTeamGson"]);  
            }   else{
                $response['data'] = null;
            }
        }
        
        $this->response($response, 200);
    }
    
    public function team_post()
    {
        $post = $this->post();
        
        $this->form_validation->set_data($post);
        $this->form_validation->set_rules('favorite','favorite','required');
        $this->form_validation->set_rules('teamId','teamId','required');
        
        if ($this->form_validation->run() == TRUE) {
            
            $query = $this->Model_favorite->insert_team(array(
                "favoriteTeamGson" => $post["favorite"],
                "teamId" => $post["teamId"],
                "userId" => $this->jwtData->id
            ));
            
            if ($query){
                $response['error'] = true;
                $response['status'] = 200;
                $response['message'] = "Approved";
            }else{
                $response['error'] = false;
                $response['status'] = 200;
                $response['message'] = "Gagal menambahkan favorite";
            }
            
        }else{
            $response['error'] = true;
            $response['status'] = 200;
            $response['message'] = viewErrorValidation($this->form_validation->error_array());
        }
        
        $this->response($response, $response['status']);
    }
    
    public function team_delete($id = "")
    {
        $query = $this->Model_favorite->delete_team(array(
            "favoriteTeamId" => $id,
            "userId" => $this->jwtData->id
        ));
        
        if ($query){
            $response['error'] = true;
            $response['status'] = 200;
            $response['message'] = "Approved";
        }else{
            $response['error'] = false;
            $response['status'] = 200;
            $response['message'] = "Gagal menambahkan favorite";
        }
        
        $this->response($response, $response['status']);
    }
    
    public function match_get($id = "")
    {
        $response['status'] = 200;
        $response['error'] = false;
        $response['message'] = 'Approved';
        $response['data'] = array();
        
        if($id == ""){
            $query = $this->Model_favorite->get_list_match($this->jwtData->id);
            
            foreach ($query as $key => $value) {
                $item = (array) json_decode($value["favoriteMatchGson"]);
                
                $item["faveroiteMatchId"] = $value["faveroiteMatchId"];
                
                array_push($response["data"], $item);
            }
            
        }else{
            $query = $this->Model_favorite->get_match($this->jwtData->id, $id);
            
            if($query){
                $response['data'] = (array) json_decode($query["favoriteMatchGson"]);  
            }else{
                $response['data'] = null;
            }
        }
        
        $this->response($response, 200);
    }
    
    public function match_post()
    {
        $post = $this->post();
        
        $this->form_validation->set_data($post);
        $this->form_validation->set_rules('favorite','favorite','required');
        $this->form_validation->set_rules('matchId','matchId','required');
        
        if ($this->form_validation->run() == TRUE) {
            
            $query = $this->Model_favorite->insert_match(array(
                "favoriteMatchGson" => $post["favorite"],
                "matchId" => $post["matchId"],
                "userId" => $this->jwtData->id
            ));
            
            if ($query){
                $response['error'] = true;
                $response['status'] = 200;
                $response['message'] = "Approved";
            }else{
                $response['error'] = false;
                $response['status'] = 200;
                $response['message'] = "Gagal menambahkan favorite";
            }
            
        }else{
            $response['error'] = true;
            $response['status'] = 200;
            $response['message'] = viewErrorValidation($this->form_validation->error_array());
        }
        
        $this->response($response, $response['status']);
    }
    
    public function match_delete($id = "")
    {
        $query = $this->Model_favorite->delete_match(array(
            "favoriteMatchId" => $id,
            "userId" => $this->jwtData->id
        ));
        
        if ($query){
            $response['error'] = true;
            $response['status'] = 200;
            $response['message'] = "Approved";
        }else{
            $response['error'] = false;
            $response['status'] = 200;
            $response['message'] = "Gagal menambahkan favorite";
        }
        
        $this->response($response, $response['status']);
    }
    
}

/* End of file Favorite.php */
