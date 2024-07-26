<?php
function is_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    }
}

function block()
{
    $ci = get_instance();
    if ($ci->session->userdata('role_id') == 1) {
        redirect('home/index');
    }
}
