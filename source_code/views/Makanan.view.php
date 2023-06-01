<?php

class MakananView
{
    public function render($id, $data, $dataByID)
    {
        if ($id == 0) {
            $action = "Tambah";
            $val_nama = "";
            $val_harga = "";
            $name_btn = "add";
            $val_id = "";
        } else {
            $action = "Ubah";
            $name_btn = "edit";
            foreach ($dataByID['makanan'] as $val) {
                list($id_makanan, $nama_makanan, $harga) = $val;
                $val_id = $id_makanan;
                $val_nama = $nama_makanan;
                $val_harga = $harga;
            }
        }

        $no = 1;
        $dataMakanan = null;

        $dataMakanan .= "
                    <thead>
                <tr>
                    <th scope='col'>No</th>
                    <th scope='col'>Nama Makanan</th>
                    <th scope='col'>Harga per Porsi</th>
                    <th scope='col'>Aksi</th>
                </tr>
            </thead>
            <tbody>
        ";

        foreach ($data['makanan'] as $val) {
            list($id_makanan, $nama_makanan, $harga) = $val;
            $dataMakanan .= "
            <tr>
                <td>" . $no++ . "</td>
                <td>" . $nama_makanan . "</td>
                <td>Rp" . $harga . "</td>
                <td>
                <a href='makanan.php?id_edit=" . $id_makanan .  "' class='btn btn-warning' '>Edit</a>
                <a href='makanan.php?id_hapus=" . $id_makanan . "' class='btn btn-danger' '>Hapus</a>
                </td>
            </tr>
            ";
        }

        $dataMakanan .= "
        </tbody>
        ";

        $template = new Template("templates/makanan.html");

        $template->replace("DATA_TABEL", $dataMakanan);
        $template->replace("ACTION", $action);
        $template->replace("VAL_ID", $val_id);
        $template->replace("VAL_NAMA", $val_nama);
        $template->replace("VAL_HARGA", $val_harga);
        $template->replace("NAME_BUTTON", $name_btn);
        $template->replace("TITLE", "Makanan");
        $template->write();
    }
}
