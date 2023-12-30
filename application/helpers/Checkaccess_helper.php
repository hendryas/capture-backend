<?php
function check_access($id_role, $id_menu_lvl1)
{
    $ci = get_instance();

    //query lain, buat bikin di SP
    // $ci->db->get_where('user_access_menu',[
    //     'id_role' => $id_role,
    //     'id_menu_lvl1' => $id_menu_lvl1
    // ]);

    $ci->db->where('id_role', $id_role);
    $ci->db->where('id_menu_lvl1', $id_menu_lvl1);
    $result = $ci->db->get('user_access_menu');

    // var_dump($result->num_rows() > 0);
    // die;

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
