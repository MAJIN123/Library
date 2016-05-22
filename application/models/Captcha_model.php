<?php

class Captcha_model extends CI_Model 
{
	public function __construct() {
    	// Call the CI_Model constructor
    	parent::__construct();
    }

    public function init_pic() {
        
        $this->load->helper('captcha');
        
        $vals = array(
            'img_path'      => './captcha/',
            'img_url'       =>  base_url() .'/captcha/',
            //'font_path'     =>  base_url() . 'system/fonts/texb.ttf',
            'img_width'     => '150',
            'img_height'    => 30,
            'expiration'    => 120,
            'word_length'   => 4,
            'font_size'     => 16,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    
            // White background and border, black text and red grid
            'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 40, 40)
            )
        );

        $cap = create_captcha($vals);
        
        return $cap['image'];
    }   
}