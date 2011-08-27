<?php

class Auth extends Controller{

  function Auth(){
    parent::Controller();
  }

  function index(){
    redirect('/auth/login');
  }

  function login(){
    $this->load->view('auth/login');
  }



}
