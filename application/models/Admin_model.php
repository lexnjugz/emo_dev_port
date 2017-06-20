<?php


class Admin_model extends CI_Model {

	var $table = 'project';
	var $column_order = array('project_title',null,'client_name','product_name'); //set column field database for datatable orderable
	var $column_search = array('project_title','client_name','product_name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('project_Id' => 'desc'); // default order 
	
	  function __construct() {
            parent::__construct(); //call the model contructor
        }

        // Model for Slider Images

      function getImages(){
      	$query = $this->db->get('slider_imgs');
      	return $query->result_array();
      }

      function addImage($sliderpic){
      	if(!isset($errMSG))
		{
			$data = array('img_name' => $sliderpic);
			$query = $this->db->insert('slider_imgs',$data);
			
			if($this->db->affected_rows() > 0)
			{
				$return = TRUE;
			}
			else
			{
				$return = FALSE;
			}
			return $return;
		}
      }

      public function delete($id){
		  $this -> db -> where('img_Id', $id);
		  if ($this -> db -> delete('slider_imgs')) {
		  	return TRUE;
		  }
		  else{
		  	return FALSE;
		  }
		}

		// Model for Products

		function getProducts(){
	      	$query = $this->db->get('product');
	      	return $query->result_array();
	      }
	    function addProduct() {
		  $product_name = $this->input->post('product_name');
		  $data = array(
		   'product_name' => $product_name
		  );
		  $this->db->insert('product', $data);
		}
	    
	 
	    function product_update($id, $productdata)
	    {
	    	$this->db->set('product_name', $productdata);
	       $this -> db -> where('product_Id', $id);
		  if ($this -> db -> update('product')) {
		  	return TRUE;
		  }
		  else{
		  	return FALSE;
		 
	    }
	}
	 
	    function product_delete($id)
	    {
	        $this -> db -> where('product_Id', $id);
		  if ($this -> db -> delete('product')) {
		  	return TRUE;
		  }
		  else{
		  	return FALSE;
		  }
	    }

	    function product_edit($id)
	    {
	    	$this->db->where('product_Id', $id);
	    	$query = $this->db->get('product');
	      	return $query->result_array();
	    }


	    // Model for Clients

	    function getClients(){
	      	$query = $this->db->get('client');
	      	return $query->result_array();
	      }

	    function addClient($data) {

			$query = $this->db->insert('client',$data);
			
			if($this->db->affected_rows() > 0)
			{
				$return = TRUE;
			}
			else
			{
				$return = FALSE;
			}
			return $return;
		}
		function client_delete($id)
	    {
	        $this -> db -> where('client_Id', $id);
		  if ($this -> db -> delete('client')) {
		  	return TRUE;
		  }
		  else{
		  	return FALSE;
		  }
	    }

	    function client_edit($id)
	    {
	    	$this->db->where('client_Id', $id);
	    	$query = $this->db->get('client');
	      	return $query->result_array();
	    }

	    function client_update($id, $clientname, $clientlogo)
	    {
	    	$this->db->set('client_name', $clientname);
	    	$this->db->set('client_logo', $clientlogo);
	       $this -> db -> where('client_Id', $id);
		  if ($this -> db -> update('client')) {
		  	return TRUE;
		  }
		  else{
		  	return FALSE;
		  }
		 
	    }

	    //Model For Projects

	    function getProjects(){
	      	$query = $this->db->get('project');
	      	return $query->result_array();
	      }
	    function getdropdown(){
	    	$query1 = $this->db->get('product');
	    	$query2 = $this->db->get('client');
	    	$data['query1'] = $query1;
	    	$data['query2'] = $query2;
	    	
	    	return $data->result_array();
	     }

	     private function _get_datatables_query()
		{
			
			$this->db->from($this->table);

			$i = 0;
		
			foreach ($this->column_search as $item) // loop column 
			{
				if($_POST['search']['value']) // if datatable send POST for search
				{
					
					if($i===0) // first loop
					{
						$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
						$this->db->like($item, $_POST['search']['value']);
					}
					else
					{
						$this->db->or_like($item, $_POST['search']['value']);
					}

					if(count($this->column_search) - 1 == $i) //last loop
						$this->db->group_end(); //close bracket
				}
				$i++;
			}
			
			if(isset($_POST['order'])) // here order processing
			{
				$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} 
			else if(isset($this->order))
			{
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
		}
	    function addProject() {
		  
		  $result = $this->db->insert('project', $data);
			
			if($this->db->affected_rows() > 0)
			{
				$return = TRUE;
			}
			else
			{
				$return = FALSE;
			}
			return $return;
		}
	    
	 
	    function project_update($id, $projectdata)
	    {
	    	$this->db->set('project_name', $projectdata);
	       $this -> db -> where('project_Id', $id);
		  if ($this -> db -> update('project')) {
		  	return TRUE;
		  }
		  else{
		  	return FALSE;
		 
	    }
	}
	 
	    function project_delete($id)
	    {
	        $this -> db -> where('project_Id', $id);
		  if ($this -> db -> delete('project')) {
		  	return TRUE;
		  }
		  else{
		  	return FALSE;
		  }
	    }

	    function project_edit($id)
	    {
	    	$this->db->where('project_Id', $id);
	    	$query = $this->db->get('project');
	      	return $query->result_array();
	    }
	    function dropzone(){
	    	$query = $this->db->insert('project_imgs',$data);
	    }

    }
?>