<?php
/**
 * Code Igniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package     CodeIgniter
 * @author      Rick Ellis
 * @copyright   Copyright (c) 2006, pMachine, Inc.
 * @license     http://www.codeigniter.com/user_guide/license.html
 * @link        http://www.codeigniter.com
 * @since       Version 1.0
 * @filesource
 */


class Usermodel extends Model 
{
    function Usermodel()
    {
        $this->obj =& get_instance();
        
        parent::Model();
    }

    function getCountries()
    {
        if ($this->obj->config->item('auth_use_country'))
        {
            $query = $this->obj->db->get($this->obj->config->item('auth_country_table_name'));
            if ($query->num_rows() > 0)
            {
                foreach ($query->result() as $row)
                    $options[$row->{$this->obj->config->item('auth_country_id_field')}] = $row->{$this->obj->config->item('auth_country_name_field')};
            
                return $options;
            }
        }
        
        return null;
    }
    
    function getSecurityPermissionsBySecurityRoleId($id)
    {
        $this->db->select($this->obj->config->item('auth_security_role_table_name').'.'.$this->obj->config->item('auth_security_role_id_field').' AS '.AUTH_SECURITY_ROLE_ID.', '.
                          $this->obj->config->item('auth_security_role_table_name').'.'.$this->obj->config->item('auth_security_role_name_field').' AS '.AUTH_SECURITY_ROLE_ID.', '.
                          $this->obj->config->item('auth_security_permission_table_name').'.'.$this->obj->config->item('auth_security_permission_id_field').' AS '.AUTH_SECURITY_PERMISSION_ID.', '.
                          $this->obj->config->item('auth_security_permission_table_name').'.'.$this->obj->config->item('auth_security_permission_name_field').' AS '.AUTH_SECURITY_PERMISSION_NAME.'');
        $this->db->where($this->obj->config->item('auth_security_role_table_name').'.'.$this->obj->config->item('auth_security_role_id_field'), $id);
        $this->db->join($this->obj->config->item('auth_security_role_permission_table_name'), $this->obj->config->item('auth_security_role_table_name').'.'.$this->obj->config->item('auth_security_role_id_field') .' = '. $this->obj->config->item('auth_security_role_permission_table_name').'.'.$this->obj->config->item('auth_security_role_permission_role_id_field'));
        $this->db->join($this->obj->config->item('auth_security_permission_table_name'), $this->obj->config->item('auth_security_role_permission_table_name').'.'.$this->obj->config->item('auth_security_role_permission_permission_id_field') .' = '. $this->obj->config->item('auth_security_permission_table_name').'.'.$this->obj->config->item('auth_security_permission_id_field'));
        
        return $this->db->get($this->obj->config->item('auth_security_role_table_name'));
    }
    
    function getSecurityRoleByUserId($id)
    {
        
        $query = $this->getUserById($id);

        if ($query->num_rows() <= 0)
            return null;
            
        $row = $query->row();
        $security_role_id = $row->{$this->obj->config->item('auth_user_security_role_field')};
        
        $this->db->select($this->obj->config->item('auth_security_role_id_field').', '.
                          $this->obj->config->item('auth_security_role_name_field'));
        $this->db->where($this->obj->config->item('auth_security_role_id_field'), $security_role_id);
        
        return $this->db->get($this->obj->config->item('auth_security_role_table_name'));
    }
    
	function getUserById($id)
	{
		$this->db->where($this->obj->config->item('auth_user_id_field'), $id);
        return $this->db->get($this->obj->config->item('auth_user_table_name'));
	}

	function getUserForActivation($id, $activation_code)
	{
		$this->db->where($this->obj->config->item('auth_user_id_field'), $id);
        $this->db->where($this->obj->config->item('auth_user_activation_code_field'), $activation_code);
        return $this->db->get($this->obj->config->item('auth_user_table_name'));
	}
	
	function getUserForForgottenPassword($email)
	{
	    $this->db->where($this->obj->config->item('auth_user_email_field'), $email);
        return $this->db->get($this->obj->config->item('auth_user_table_name'));
	}

	function getUserForForgottenPasswordReset($id, $activation_code)
	{
		$this->db->where($this->obj->config->item('auth_user_id_field'), $id);
        $this->db->where($this->obj->config->item('auth_user_forgotten_password_code_field'), $activation_code);
        return $this->db->get($this->obj->config->item('auth_user_table_name'));
	}
	
	function getUserForLogin($username, $password)
	{
		$this->db->where($this->obj->config->item('auth_user_name_field'), $username);
        $this->db->where($this->obj->config->item('auth_user_password_field'), $password);
        return $this->db->get($this->obj->config->item('auth_user_table_name'));
	}
	
	function insertUserForRegistration($values)
	{
	    foreach($values as $key=>$value)
            $this->db->set($key, $value);
        
        $this->db->insert($this->obj->config->item('auth_user_table_name'));
	}

	function updateUserForActivation($id)
	{
	    $this->db->set($this->obj->config->item('auth_user_activated_field'), 1);
        $this->db->set($this->obj->config->item('auth_user_activation_code_field'), '');
        $this->db->where($this->obj->config->item('auth_user_id_field'), $id);
        $this->db->update($this->obj->config->item('auth_user_table_name'));
	}
	
	function updateUserForForgottenPassword($id, $activation_code)
	{
	    $this->db->set($this->obj->config->item('auth_user_forgotten_password_code_field'), $activation_code);
        $this->db->where($this->obj->config->item('auth_user_id_field'), $id);
        $this->db->update($this->obj->config->item('auth_user_table_name'));
	}
	
	function updateUserForForgottenPasswordReset($id, $encrypted_password)
	{
	    $this->db->set($this->obj->config->item('auth_user_password_field'), $encrypted_password);
        $this->db->set($this->obj->config->item('auth_user_forgotten_password_code_field'), '');
        $this->db->where($this->obj->config->item('auth_user_id_field'), $id);
        $this->db->update($this->obj->config->item('auth_user_table_name'));
    }
    
    function updateUserForRegistration($id, $activation_code)
    {
        $this->db->set($this->obj->config->item('auth_user_activation_code_field'), $activation_code);
        $this->db->where($this->obj->config->item('auth_user_id_field'), $id);
        $this->db->update($this->obj->config->item('auth_user_table_name'));
    }
    
    function updateUserForLogin($id)
    {
        $this->db->set($this->obj->config->item('auth_user_last_visit_field'), date ("Y-m-d H:i:s"));
        $this->db->where($this->obj->config->item('auth_user_id_field'), $id);
        $this->db->update($this->obj->config->item('auth_user_table_name'));
    }
}
?>