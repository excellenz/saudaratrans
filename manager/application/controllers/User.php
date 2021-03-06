<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	
	public function index()
	{
		$data['title'] = 'My Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		$data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('name', 'Full Name', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');

			// cek jika ada gambar (file) yang akan diupload
			$upload_image = $_FILES['image']['name'];

			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']      = '2048';
				$config['upload_path']   = './assets/img/profile/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					// cek dulu gambar lamanya apakah default
					$old_image = $data['user']['image'];
					if ( $old_image != 'default.jpg') {
						// jika bukan, maka hapus saja agar tidak terjadi penumpukan file
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$this->db->set('date_modified', time());
			$this->db->set('name', $name);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Your profile has been updated!</div>');
			redirect('user');
		}
	}

	public function grouplist()
	{
		$data['title'] = 'Upload Raport';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$user_id = $data['user']['id'];

		$this->db->select('*');
		$this->db->from('user_to_group');
		$this->db->join('user_group','user_to_group.group_id = user_group.id');
		$this->db->where('user_to_group.user_id', $user_id);
		$data['group'] = $this->db->get()->result_array();
				
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('user/group-list', $data);
		$this->load->view('templates/footer');
		
	}

	public function upload($id)
	{
		$data['title'] = 'Student Report';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['group'] = $this->db->get_where('user_group', ['id' => $id])->row_array();
		$data['student'] = $this->db->get_where('student', ['group_id' => $id])->result_array();

		$this->db->select('*');
		$this->db->from('student');
		$this->db->join('file', 'file.student_id = student.id');
		$this->db->where('student.group_id', $id);
		$this->db->order_by('student.full_name');
		$data['file'] = $this->db->get()->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view("user/upload-file", $data);
		$this->load->view('templates/footer');
	}

	public function uploadForm($id)
	{
		$data['title'] = 'Upload Raport';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['group'] = $this->db->get_where('user_group', ['id' => $id])->row_array();
		$data['student'] = $this->db->get_where('student', ['group_id' => $id])->result_array();

		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('student_id', 'Student', 'required|trim');
		$this->form_validation->set_rules('r_type', 'Report Type', 'required|trim');
		$this->form_validation->set_rules('file', '','callback_file_check');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view("user/upload-form", $data);
			$this->load->view('templates/footer');
		} else {
			
			$upload_file = $_FILES['file']['name'];
			$pecah = explode(".", $upload_file);
			$file_type = $pecah[1];			

			if ($upload_file) {
				$config['allowed_types'] = 'doc|xls|ppt|docx|xlsx|pptx|pdf';
				$config['max_size']      = '5120';
				$config['upload_path']   = './assets/files/raport/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file')) {
					$name = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			$data = [
				'date' => time(),
				'user_email' => $this->input->post('email'),
				'file_type' => $this->input->post('r_type'),
				'name' => $name,
				'student_id' => $this->input->post('student_id')
			];
			$no = $this->input->post('group_id');

			$this->db->insert('file', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Raport berhasil diupload!</div>');
			redirect("user/upload/$no");
		}
	}

	public function hapusfile($id)
	{
		$this->db->select('*');
		$this->db->from('student');
		$this->db->join('file', 'student.id = file.student_id');
		$this->db->where('file.id', $id);
		$file = $this->db->get()->row_array();
		$no = $file['group_id'];
		$this->db->delete('file', ['id' => $id]);
		unlink(FCPATH . 'assets/files/raport/' . $file['name']);
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> File berhasil dihapus!</div>');
		redirect("user/upload/$no");
	}

    // Fitur tamu hotel
    public function viewBook()
	{
		$data['title'] = 'Rental Saya';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$nomor_telp = 62 . substr($data['user']['email'], 1);

		$this->db->select('*');
		$this->db->from('hotel_kamar');
		$this->db->join('hotel_booking', 'hotel_booking.hotel_kamar_id = hotel_kamar.id');
		$this->db->join('hotel_tamu', 'hotel_booking.hotel_tamu_id = hotel_tamu.id');
		$this->db->where('hotel_tamu.nomor_telp', $nomor_telp);
		$data['booking'] = $this->db->get()->result_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tamu/view-book', $data);
		$this->load->view('templates/footer');
	}

	public function book()
	{
		$data['title'] = 'Rental Mobil';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->db->select('*');
		$this->db->from('hotel_tipe_kamar');
		$this->db->join('hotel_kamar', 'hotel_kamar.tipe_kamar_id = hotel_tipe_kamar.id');
		$this->db->where('hotel_kamar.status', 1);
		$this->db->order_by('hotel_kamar.tipe_kamar_id', 'ASC');
		$data['kamar'] = $this->db->get()->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tamu/book', $data);
		$this->load->view('templates/footer');
	}

	public function bookDetail($id)
	{
		$data['title'] = 'Detail Pemesanan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->db->select('*');
		$this->db->from('hotel_kamar');
		$this->db->join('hotel_booking', 'hotel_booking.hotel_kamar_id = hotel_kamar.id');
		$this->db->join('hotel_tamu', 'hotel_booking.hotel_tamu_id = hotel_tamu.id');
		$this->db->where('hotel_booking.id_book', $id);
		$data['booking'] = $this->db->get()->row_array();

		$data['bukti'] = $this->db->get_where('hotel_bukti_transfer', ['hotel_booking_id' => $id])->row_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tamu/book-detail', $data);
		$this->load->view('templates/footer');
	}

	public function addBook($id)
	{
		$data['title'] = 'Rental Mobil';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$nomor_telp = 62 . substr($data['user']['email'], 1);

		$this->db->select('*');
		$this->db->from('hotel_tipe_kamar');
		$this->db->join('hotel_kamar', 'hotel_kamar.tipe_kamar_id = hotel_tipe_kamar.id');
		$this->db->where('hotel_kamar.id', $id);
		$data['kamar'] = $this->db->get()->row_array();
		$data['tamu'] = $this->db->get_where('hotel_tamu', ['hotel_tamu.nomor_telp' => $nomor_telp])->row_array();

		$this->form_validation->set_rules('tgl_cin', 'Tanggal Check in', 'required|trim');
		$this->form_validation->set_rules('tgl_cout', 'Tanggal Check out', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('tamu/add-book', $data);
			$this->load->view('templates/footer');
		} else {
			$c_in = strtotime($this->input->post('tgl_cin'));
			$c_out = strtotime($this->input->post('tgl_cout'));
			$selisih = ($c_out - $c_in)/86400;
			$harga = $this->input->post('harga');
			$biaya = $selisih * $harga;
			$databook = $this->db->get_where('hotel_booking', ['tgl_c_in' => $c_in, 'hotel_kamar_id' => $this->input->post('id_kamar')])->row_array();

			if ($databook == NULL) {
				$data = [
					'tgl_inv' => time(),
					'no_invoice' => $this->input->post('nomor_invoice'),
					'hotel_tamu_id' => $this->input->post('id_tamu'),
					'hotel_kamar_id' => $this->input->post('id_kamar'),
					'jml_dewasa' => $this->input->post('jumlah_dewasa'),
					'jml_anak' => $this->input->post('jumlah_anak'),
					'tgl_c_in' => $c_in,
					'tgl_c_out' => $c_out,
					'biaya' => $biaya,
					'status' => 0,
				];

				$this->db->insert('hotel_booking', $data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Pesanan berhasil dibuat. Silahkan lakukan pembayaran. Lihat detail pesanan di bawah ini.</div>');
				redirect('user/viewbook');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"> Kamar sudah dipesan pada tanggal tersebut.
					Silahkan pilih kamar yang lain atau ubah tanggal.</div>');
				redirect('user/viewbook');
			}
		}

	}

	public function hapusbook($id)
	{
		
		$this->db->delete('hotel_booking', ['id_book' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Data berhasil dihapus!</div>');
		redirect('layanan');
	}

	public function konfBook($id)
	{
		$data['title'] = 'Konfirmasi Transfer';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->db->select('*');
		$this->db->from('hotel_kamar');
		$this->db->join('hotel_booking', 'hotel_booking.hotel_kamar_id = hotel_kamar.id');
		$this->db->join('hotel_tamu', 'hotel_booking.hotel_tamu_id = hotel_tamu.id');
		$this->db->where('hotel_booking.id_book', $id);
		$data['booking'] = $this->db->get()->row_array();

		if ($data['booking']['status'] > 0) {
			redirect('user/viewbook');
		}

		$this->form_validation->set_rules('nama_depan', 'Nama Tamu', 'required|trim');

		if($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('tamu/konfirmasi', $data);
			$this->load->view('templates/footer');
		} else {
			$booking_id = $this->input->post('booking_id');
			$nama_depan = $this->input->post('nama_depan');

			// cek jika ada gambar (file) yang akan diupload
			$upload_image = $_FILES['image']['name'];

			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']      = '2048';
				$config['upload_path']   = './assets/img/buktitrf/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$gambar = $this->upload->data('file_name');
				} else {
					echo $this->upload->display_errors();
				}
			}

			$data = [
				  'hotel_booking_id' => $booking_id,
				  'foto_trf' => $gambar
			];

			$this->db->set('status', 2);
			$this->db->where('id_book', $booking_id);
			$this->db->update('hotel_booking');

			$this->db->insert('hotel_bukti_transfer', $data);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Konfirmasi pembayaran terkirim. Menunggu verifikasi admin.</div>');
			redirect('https://wa.me/6285220489206?text=Saya sudah melakukan pembayaran untuk booking kamar. Mohon dikonfirmasi.');
		}
	}

	public function file_check()
	{
        $allowed_type_file = array('application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.documen', 'application/pdf', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $mime = get_mime_by_extension($_FILES['file']['name']);

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            if (in_array($mime, $allowed_type_file)) {
                if ($_FILES['file']['size'] > 6144000) {
                    $this->form_validation->set_message('file_check', 'Ukuran file terlalu besar! Pastikan kurang dari 5MB!');
                    return FALSE;
                } else {
                return TRUE;                    
                }
            } else {
                $this->form_validation->set_message('file_check', 'Jenis file tidak diizinkan!');
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Pilih file untuk diupload!');
                return FALSE;
        }
    }

    public function changePassword()
	{
		$data['title'] = 'Change Password';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');
		if ($this->form_validation->run() == false) {
			# code...
			$this->load->view('templates/header', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('user/changepassword', $data);
			$this->load->view('templates/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if (!password_verify($current_password, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Wrong current password!</div>');
				redirect('user/changepassword');
			} else {
				if ($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> New password cannot be the same as current password!</div>');
					redirect('user/changepassword');
				} else {
					// password sudah ok
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');

					$this->session->unset_userdata('email');
					$this->session->unset_userdata('role_id');

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password changed! Please login with new password.</div>');
					redirect('auth');
				}
			}
		}
	}
}