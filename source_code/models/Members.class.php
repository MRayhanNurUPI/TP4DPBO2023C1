<?php

class Members extends DB
{
    function getMembers()
    {
        $query = "SELECT * FROM members JOIN makanan ON members.id_makanan_fav = makanan.id_makanan ORDER BY members.id_members";
        return $this->execute($query);
    }

    function getMembersByID($id)
    {
        $query = "SELECT * FROM members WHERE id_members=$id";
        return $this->execute($query);
    }

    function addMembers($data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $input_date = $data['join_date'];
        $join_date = date("Y-m-d", strtotime($input_date));
        $id_makanan_fav = $data['makanan_fav'];

        $query = "insert into members values ('', '$name', '$email', '$phone', '$join_date', '$id_makanan_fav')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function deleteMembers($id)
    {

        $query = "delete FROM members WHERE id_members = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function edit($id, $data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $input_date = $data['join_date'];
        $join_date = date("Y-m-d", strtotime($input_date));
        $id_makanan_fav = $data['makanan_fav'];

        $query = "UPDATE members SET name='$name', email='$email', phone='$phone', join_date='$join_date', id_makanan_fav = $id_makanan_fav WHERE id_members = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
}
