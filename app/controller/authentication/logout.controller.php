<?php

class LogoutController extends Controller{
    public function submitAction(){
        session_destroy();
        $url = PARENT_FOLDER . '/login';
        header('Location: ' . $url);
    }
}