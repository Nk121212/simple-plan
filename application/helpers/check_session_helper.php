<?php
    //Get Current CI Instance
    $CI = & get_instance();
    //Use $CI instead of $this

    $CI->load->library('session');

    //Check for session details here, here's an example
    $logged_in = isset($_SESSION['login']) ? $CI->session->userdata('login') : false ;

    //Get current controller to avoid infinite loop
    $controller = $CI->router->class;
    $method = $CI->router->method;
 
    //Check if user session exists and you are not already on the login page
    if ($controller == "auth" || $controller == "landing") {

        //do nothing
        if ($logged_in === false) {
        
        } else {

            //redirect('home');

        }

    } else {

        if ($logged_in === false) {

            redirect('auth/login_page');
        
        } else {

            //redirect('home');

        }

    }

?>
