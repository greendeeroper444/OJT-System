<?php
    class adminSettingsController extends Controller{
        public function showAction() {
            $data = [
                'userType' => 'admin',
            ];
            $this->render('admin/adminSettings',$data);
        }
    }
 