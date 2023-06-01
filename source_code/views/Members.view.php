<?php

class MembersView
{
    public function render($data)
    {
        $no = 1;
        $dataMembers = null;
        $dataMembers .= "<thead class='text-center'>
                <tr>
                    <th scope='col'>No</th>
                    <th scope='col'>Nama Anggota</th>
                    <th scope='col'>Email</th>
                    <th scope='col'>No Telepon</th>
                    <th scope='col'>Tanggal Bergabung</th>
                    <th scope='col'>Makanan Favorit</th>
                    <th scope='col'>Aksi</th>
                </tr>
            </thead>
            <tbody class='text-center'>
            ";

        foreach ($data['members'] as $val) {
            // list($id_members, $name, $email, $phone, $join_date, $id_makanan_fav) = $val;
            $dataMembers .= "  
                <tr>
                <td>" . $no++ . "</td>
                <td>" . $val['name'] . "</td>
                <td>" . $val['email'] . "</td>
                <td>" . $val['phone'] . "</td>
                <td>" . date("d-m-Y", strtotime($val['join_date'])) . "</td>
                <td>" . $val['nama_makanan'] . "</td>
                <td>
                <a href='formMembers.php?id_edit=" . $val['id_members'] .  "' class='btn btn-warning' '>Edit</a>
                <a href='index.php?id_hapus=" . $val['id_members'] . "' class='btn btn-danger' '>Hapus</a>
                </td>
            </tr>            
            ";
        }

        $dataMembers .= "</tbody>";

        $template = new Template("templates/skin_index.html");

        $template->replace("DATA_TABEL", $dataMembers);
        $template->replace("TITLE", "Members");

        $template->write();
    }

    public function renderForm($data, $id)
    {

        $makanan_options = null;

        if ($id == 0) {
            $action = "Tambah";
            $val_id = "";
            $val_nama = "";
            $val_email = "";
            $val_phone = "";
            $val_join_date = "";
            $name_btn = "add";
            foreach ($data['makanan'] as $opt) {
                $makanan_options .= "<option value=" . $opt['id_makanan'] . ">" . $opt['nama_makanan'] . "</option>";
            }
        } else {
            $action = "Ubah";
            $name_btn = "edit";
            foreach ($data['members'] as $val) {
                $val_id = $val['id_members'];
                $val_nama = $val['name'];
                $val_email = $val['email'];
                $val_phone = $val['phone'];
                $val_join_date = $val['join_date'];
                $val_id_makanan_fav = $val['id_makanan_fav'];
            }
            foreach ($data['makanan'] as $opt) {
                $selected = ($opt['id_makanan'] == $val_id_makanan_fav) ? 'selected' : "";
                $makanan_options .= "<option value=" . $opt['id_makanan'] . " . $selected . >" . $opt['nama_makanan'] . "</option>";
            }
        }



        $template = new Template("templates/form_members.html");

        $template->replace("ACTION", $action);
        $template->replace("VAL_ID", $val_id);
        $template->replace("VAL_NAMA", $val_nama);
        $template->replace("VAL_EMAIL", $val_email);
        $template->replace("VAL_PHONE", $val_phone);
        $template->replace("VAL_JOIN_DATE", $val_join_date);
        $template->replace("BUTTON_NAME", $name_btn);
        $template->replace("MAKANAN_OPTIONS", $makanan_options);

        $template->replace("TITLE", "Members");

        $template->write();
    }
}
