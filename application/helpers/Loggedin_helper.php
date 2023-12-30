<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('login');
    } else {
        $id_role = $ci->session->userdata('id_role');
        $menu = $ci->uri->segment(1); //controller mana yang mau di ambil/url mana

        //cocokkan dengan tabel user menu dengan user access menu
        $queryMenu = $ci->db->get_where('menu_level_1', ['url' => $menu])->row_array();
        $menu_id = $queryMenu['id_menu_lvl1'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'id_role' => $id_role,
            'id_menu_lvl1' => $menu_id
        ]);

        // var_dump($userAccess->num_rows() < 1);
        // die;

        //admin kenapa ke block?
        if ($userAccess->num_rows() < 1) {
            redirect('errors/blocked');
        }
    }
}
