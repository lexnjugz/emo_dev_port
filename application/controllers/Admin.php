<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
            parent::__construct(); //call the controller contructor
            $this->load->model('Admin_model');
        }
// Controller For Slider Images

	public function index()
	{
		$slider_data['slider_imgs'] = $this->Admin_model->getImages();

		$this->load->view('Admin/admin',$slider_data);

	}

	public function addslider()
	{
		$this->load->view('Admin/addnew');
		if(isset($_POST['btnsave']))
			{
				$imagename = $_POST['image_name'];
					
				$imgFile = $_FILES['slider_image']['name'];
				$tmp_dir = $_FILES['slider_image']['tmp_name'];
				$imgSize = $_FILES['slider_image']['size'];

				
				
				if(empty($imagename)){
					$this->data['errMSG'] = "Please Enter Image name.";
					$this->load->view('Admin/addnew', $this->data);
				}
				else if(empty($imgFile)){
					$this->data['errMSG'] = "Please Select Image File.";
					$this->load->view('Admin/addnew', $this->data);
				}
				else
				{
					$upload_dir = 'assets/img/slider/'; // upload directory
			
					$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
				
					// valid image extensions
					$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
				
					// rename uploading image
					$sliderpic = $imagename.".".$imgExt;

					
						
					// allow valid image file formats
					if(in_array($imgExt, $valid_extensions)){			
						// Check file size '5MB'
						if($imgSize < 5000000)				{
							move_uploaded_file($tmp_dir,$upload_dir.$sliderpic);
							$result = $this->Admin_model->addImage($sliderpic);
							if ($result) {
								$this->data['successMSG'] = "new record succesfully inserted ...";
								$this->load->view('Admin/addnew', $this->data);	
								header("refresh:1;index"); // redirects image view page after 5 seconds.
							}else{
								$this->data['errMSG'] = "error while inserting....";
								$this->load->view('Admin/addnew', $this->data);	
							}
						}
						else{
							$this->data['errMSG'] = "Sorry, your file is too large.";
							$this->load->view('Admin/addnew', $this->data);
						}
					}
					else{
						$this->data['errMSG'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$this->load->view('Admin/addnew', $this->data);		
					}
					
				}
			}
	}

	public function deleteimg($img_Id){
 
	    $result = $this->Admin_model->delete($img_Id);

	    if ($result) {
	    	$slider_data['slider_imgs'] = $this->Admin_model->getImages();

			$this->load->view('Admin/admin',$slider_data);
	    }
	    else{
	    	$this->load->view('Admin/admin');
	    }
	}

	//Controller For Products

	public function product(){

		$product_name['product_name'] = $this->Admin_model->getProducts();
		$this->load->view('Admin/product',$product_name);
    
	}
	public function productSave($data)
	    { 
		  if ($this->input->post('submit')) {
		   $this->Admin_model->addProduct();
		   redirect('index.php/Admin/product');
		  } else{
		   redirect('');
		  }
		}
	public function productDelete($id)
    {
        $result = $this->Admin_model->product_delete($id);
        if ($result) {
	    	$product_name['product_name'] = $this->Admin_model->getProducts();
		$this->load->view('Admin/product',$product_name);
	    }
	    else{
	    }
    }
 
    public function productEdit($product)
    {
        $product_name['product_name'] = $this->Admin_model->product_edit($product);
        $this->load->view('Admin/editProduct', $product_name);
        if(isset($_POST['btnsave']))
        {
        	$prod_id = $product_name["product_name"];
        	$id = $prod_id[0]["product_Id"];
        	$productdata = $_POST['product_name'];
		   $result = $this->Admin_model->product_update($id,$productdata);
		   redirect('index.php/Admin/product');
		  } else{
		  }
    }
 
  //Controller For Clients  

	public function client(){
		$client_data['client'] = $this->Admin_model->getClients();
		$this->load->view('Admin/client',$client_data);
	}
	public function clientSave()
	    { 
	    	if(isset($_POST['submit'])) {

		  		$client_name = $_POST['client_name'];
					
				$imgFile = $_FILES['client_logo']['name'];
				$tmp = $_FILES['client_logo']['tmp_name'];
				$imgSize = $_FILES['client_logo']['size'];
				$upload_dir = 'assets/img/client_logo/'; // upload directory

			
					$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
				
					// valid image extensions
					$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
				
					// rename uploading image
					$client_logo = $client_name.".".$imgExt;

						
					// allow valid image file formats
					if(in_array($imgExt, $valid_extensions)){			
						// Check file size '5MB'
						if($imgSize < 5000000)				{
							move_uploaded_file($tmp,$upload_dir.$client_logo);

							$data = array('client_logo' => $client_logo, 'client_name' => $client_name );
							
							$result = $this->Admin_model->addClient($data);
							if ($result) {
								$this->data['successMSG'] = "new record succesfully inserted ...";
								$this->load->view('Admin/client', $this->data);	
								//header("refresh:1;index"); // redirects image view page after 5 seconds.
							}else{
								$this->data['errMSG'] = "error while inserting....";
								$this->load->view('Admin/client', $this->data);	
							}
						}
						else{
							$this->data['errMSG'] = "Sorry, your file is too large.";
							$this->load->view('Admin/client', $this->data);
						}
					}
					else{
						$this->data['errMSG'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$this->load->view('Admin/client', $this->data);		
					}

		   redirect('index.php/Admin/client');
		  } else{
		  }
		}
	public function clientDelete($id)
    {
        $result = $this->Admin_model->client_delete($id);
        if ($result) {
	    	$client_data['client'] = $this->Admin_model->getClients();
		$this->load->view('Admin/client',$client_data);
	    }
	    else{
	    }
    }

    public function clientEdit($client)
    {
    	$client_data = $this->Admin_model->client_edit($client);
    	$client_data = $client_data[0];
    
		$this->load->view('Admin/editClient',$client_data);
        if(isset($_POST['btnsave']))
        {
        	//$client_name = $_POST['client_name'];

        	$id = $client;
        	$clientname = $_POST['client_name'];
        	$clientlogo = $_POST['client_logo'];
        	var_dump($id);
        	var_dump($clientname);
        	var_dump($clientlogo);
        	die();
        	
		   $result = $this->Admin_model->product_update($id,$clientname,$client_logo);
		   redirect('index.php/Admin/client');
		  } else{
		  }
    }

 
}
