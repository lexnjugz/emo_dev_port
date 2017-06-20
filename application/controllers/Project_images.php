<?php


class Project_images extends CI_Controller
{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function index($id){
		$data['id'] = $id;
		$query = $this->db->select('project_title')
             ->from('project')
             ->where('project_Id',$id)
             ->get();
         $data['name'] = $query->result_array();
         // var_dump($data["name"][0] ["project_title"]);
         // die();
		$this->load->view('Admin/addproject',$data);
	}


	//For the process of uploading project images
	function project_image_upload(){

        $config['upload_path']   = FCPATH.'/assets/img/projects/';
        $config['allowed_types'] = 'gif|jpg|png|ico';
        $this->load->library('upload',$config);

        if($this->upload->do_upload('userfile')){
        	$token=$this->input->post('token_image');
        	$id=$this->input->post('id');
        	var_dump($id);
        	$img_name=$this->upload->data('file_name');
        	$this->db->insert('project_imgs',array('project_image'=>$img_name,'project_Id'=>$id,'token'=>$token));
        }


	}


	//	To delete a photo
	function project_image_delete(){

		//Take token photo
		$token=$this->input->post('token');

		
		$image=$this->db->get_where('project_imgs',array('token'=>$token));


		if($image->num_rows()>0){
			$result=$image->row();
			$img_name=$result->img_name;
			if(file_exists($file=FCPATH.'/assets/img/projects/'.$img_name)){
				unlink($file);
			}
			$this->db->delete('project_imgs',array('token'=>$token));

		}


		echo "{}";
	}
	 function project_slider_images(){
                    $uploadpath = base_url().'assets/img/projects/';
                    $rs = $this->db->get('project_imgs');
                    $rr = $this->db->join('project', 'project.project_Id=project_imgs_Id.project_Id', 'left');
                    
                    foreach ($rs->result() as $row) {
                        $alt = $row->project_image;
                        $id = $row->project_imgs_Id;
                        $token = $row->token;
                        echo "<li class='thumbnail' token='$token'>
                            <span id='$row->project_imgs_Id' class='btn btn-info btn-block btn-delete'><i class='glyphicon glyphicon-remove'></i>&nbsp;&nbsp;&nbsp;Delete</span>
                            <img src='$uploadpath$alt' alt='$alt' style='height: 150px; width: 150px'>
                                <span class='btn btn-warning btn-block'>$alt</span></li>";
                         
                    }
                }
                 
    function project_deleteimg(){

      $image =  $this->db->where('project_imgs_Id', $this->input->post('id'));
      $this->db->delete('project_imgs');
    }

}