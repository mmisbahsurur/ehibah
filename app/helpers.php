<?php

function active_class($path, $active = 'active') {
  return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

function is_active_route($path) {
  return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

function show_class($path) {
  return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
}

function getHibah($poktan, $jenis_hibah) {
    ini_set('max_execution_time', 180);
    $hibah = 0;
    foreach ($poktan as $kelompok_tani) {
        $hibahs = App\Models\Hibah::where('id_kelompoktani', $kelompok_tani->id)
            ->where('jenis_hibah', $jenis_hibah)
            // ->whereIn('kegiatan', ['2022', '2023'])
            ->get();
        if (count($hibahs) > 0) {
            foreach ($hibahs as $row) {
                $hibah += $row->jumlah;
            }
        }
    }
    return $hibah;
}
