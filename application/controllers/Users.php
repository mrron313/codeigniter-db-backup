<?php
class Users extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->helper('url_helper');
        $this->load->helper('file');
    }
 
    public function index()
    {
        $data['users'] = $this->users_model->users();
        $data['title'] = 'User Lists';
 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/users/index', $data);
        $this->load->view('templates/footer');
    }

    public function database_backup()
    {
            $this->load->dbutil();
            $prefs = array('format' => 'zip', 'filename' => 'Database-backup_' . date('Y-m-d_H-i'));
            $backup = $this->dbutil->backup($prefs);
            if (!write_file('./uploads/backup/BD-backup_' . date('Y-m-d_H-i') . '.zip', $backup)) {
                echo "Error while creating auto database backup!";
             } 
             else {
                echo "Database backup has been successfully created!";
            }
    }


}
