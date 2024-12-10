<?php

use App\Models\metadata;

function get_meta_value($meta_key) 
{
    $data = metadata::where('meta_key', $meta_key)->first();
    if ($data) {
        return $data->meta_value;
    }
}

// function set_about_nama($nama) 
// {
//     // nama = "dimas abdus syahid"
//     $arr = explode("", "", $nama); //idx 1 dimas idx 2 abdus idx 3 dimas
//     $kataakhir = end($arr);
//     return $kataakhir;
// }