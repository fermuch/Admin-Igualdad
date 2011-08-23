<?php

class Auth extends Controller{

  function Auth(){
    parent::Controller();
  }

  function index(){
    redirect('/auth/login');
  }

  function login(){
    $this->load->view('auth/head');
    $this->load->view('auth/login');
    $this->load->view('auth/foot');
  }



}
