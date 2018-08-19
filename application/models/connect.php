<?php 
 
class Connect extends CI_Model{
	function new_product(){
		$data = $this->db->query("SELECT * from product");
		$this->db->order_by('DateUpload', 'ASC');
		return $data->result();

	}
	function category(){
		$data = $this->db->query("SELECT * from kategori");
		return $data->result();	
	}
	function Slider(){
		$data = $this->db->query("SELECT * from Slider");
		return $data->result();	
	}
	function Featured_product(){
		$this->db->select('*');
		$this->db->from('product');
		$this->db->order_by('ProductID', 'RANDOM');
		$this->db->limit(6);
		$data = $this->db->get();
        return $data->result();
	}
	function detail_product(){
		$id = $this->input->get('id');
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('ProductID',$id);
		$data = $this->db->get();
        return $data->result();
	}
	function add_shopping_cart(){
		$item1 = $this->cart->contents();
		foreach ($item1 as $row) {
			$dataid[] = $row['id']; 
		};
		$dataid[] = 0;
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where_in('ProductID',$dataid);
		$data = $this->db->get();
        return $data->result();
	}
	function load_form_pembelian(){
		$idproduct = $_POST['id'];
		if ($idproduct == "") {
			header("Location: ".base_url()."");
		}
		else {
			foreach ($idproduct as $row) {
			$id[] = $row; 
		};
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where_in('ProductID',$id);
		$data = $this->db->get();
        return $data->result();
		}
	}
		
	function category_item(){
		$id = $this->input->get('id');
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('category',$id);
		$data = $this->db->get();
        return $data->result();
	}
	function search(){
		$search = $this->input->get('search');
		$this->db->select('*');
		$this->db->from('product');
		$this->db->like('ProductName',$search);
		$data = $this->db->get();
        return $data->result();
	}
	function retur_produk(){
		include 'application/konfigurasi.php';
		$nama = $this->input->post('nama');
		$noorder = $this->input->post('noorder');
		$catatan = $this->input->post('catatan');
		$this->db->select('noorder');
		$this->db->from('order');
		$this->db->where('noorder',$noorder);
		$base = $this->db->get();
		$count = count($base->result());

 		if ($count < "1") {
    		echo "
    		Maaf No Order anda tidak terdaftar
    		<a href='".base_url('home/retur_produk')."'>Back</a>

    		";
		} else {
    		$data = array(
        	'nama' => $nama,
        	'noorder' => $noorder,
        	'catatan' => $catatan
			);
			$this->db->insert('retur', $data);
			$pesan = 'Permintaan Retur dari '.$nama.' No Order '.$noorder.'';
			$email = 'andichaerul85';
			$subject = 'Retur Produk No Order '.$noorder.'';
			$config = Array(
      		'protocol' => 'smtp',
      		'smtp_host' => $editor['smtp_host'],
      		'smtp_port' => 465,
      		'smtp_user' => 'andichaerul85@gmail.com', //isi dengan gmailmu!
      		'smtp_pass' => 'birakomputer4812519', //isi dengan password gmailmu!
      		'mailtype' => 'html',
      		'charset' => 'iso-8859-1',
      		'wordwrap' => TRUE
    		);
		    $this->load->library('email', $config);
		    $this->email->set_newline("\r\n");
		    $this->email->from($email);
		    $this->email->to('andichaerul85@gmail.com'); //email tujuan. Isikan dengan emailmu!
		    $this->email->subject($subject);
		    $this->email->message($pesan);
		    $this->email->send();
		    echo "
		    Permintaan Retur anda sudah di ajukan. Selanjutnya team kami akan menghubungi anda,
		    <a href='".base_url()."'>Home</a>
		    ";
		};

	}
	function syarat_dan_ketentuan(){
		$data = $this->db->query("SELECT * from syarat_dan_ketentuan");
		return $data->result();
	}
	function kebijakan_privasi(){
		$data = $this->db->query("SELECT * from kebijakan_privasi");
		return $data->result();
	}
	function tentang_kami(){
		$data = $this->db->query("SELECT * from tentang_kami");
		return $data->result();
	}
	function hubungi_kami_action(){
		$fname = $this->input->post('fname');
		$email = $this->input->post('email');
		$subject = $this->input->post('subject');
		$msg = $this->input->post('msg');
		$data = array(
        	'Name' => $fname,
        	'Email' => $email,
        	'Subject' => $subject,
        	'Msg' => $msg,
        	'Date' => date("Y-m-d h:i:sa")
		);
		$this->db->insert('hubungi_kami', $data);
	}
	function subscribe(){
			$emailuser = $this->input->post('email');
			//PESAN YG DIKIRM
			$pesan = $this->load->view('email/subscribe/subscribe','',true);
        	//Pesan YG DIKIRIM//
			$email = 'Sepeda Online';
			$subject = 'Konfirmasi Permintaan Subcribe Anda';
			$config = Array(
      		'protocol' => 'smtp',
      		'smtp_host' => 'ssl://smtp.gmail.com',
      		'smtp_port' => 465,
      		'smtp_user' => 'andichaerul85@gmail.com', //isi dengan gmailmu!
      		'smtp_pass' => 'birakomputer4812519', //isi dengan password gmailmu!
      		'mailtype' => 'html',
      		'charset' => 'iso-8859-1',
    		);
		    $this->load->library('email', $config);
		    $this->email->set_newline("\r\n");
		    $this->email->from($email);
		    $this->email->to($emailuser); //email tujuan. Isikan dengan emailmu!
		    $this->email->subject($subject);
		    $this->email->message($pesan);
		     if (!$this->email->send()) {  
   				 show_error($this->email->print_debugger());   
  			 }else{  
   				 echo 'Success to send email';   
  				 }  
		}
		function subscribe_add(){
		$email = $this->input->get('email');	
		$data = array(
	        'email' => $email,
			);
		$this->db->insert('subscribe', $data);
		}
		function order_table(){
		$ProductID = $this->input->post('ProductID');
		$qty = $this->input->post('qty');
		$sisastock = $this->input->post('Sisa');
		$PriceAmount = $this->input->post('PriceAmount');

		print_r($ProductID);	
		$count = count($ProductID);
			for ($x = 0; $x < $count; $x++) {
    		$data = array(

        	'ProductID' => $ProductID[$x],
        	'Qty' => $qty[$x],

			);
			$this->db->insert('order', $data);
			}
			//Update Stock ketika user order
			for ($x = 0; $x < $count; $x++) {
    		$ProductID[$x] = $ProductID[$x];
    		$data = array(
        	'Stock' => $sisastock[$x],
			);
			$this->db->where('ProductID', $ProductID[$x]);
			$this->db->update('product', $data);
			}	

		}
		function punyaniya(){
			$niya = $this->input->post('longti');
			$data = array(
        	'Name' => $niya,
		);
		$this->db->insert('hubungi_kami', $data);

		} 


		
}
