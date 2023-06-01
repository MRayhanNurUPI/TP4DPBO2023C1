<?php

class Makanan extends DB
{
    function getMakanan()
    {
        $query = "SELECT * FROM makanan";
        return $this->execute($query);
    }

    function getMakananByID($id)
    {
        $query = "SELECT * FROM makanan WHERE id_makanan=$id";
        return $this->execute($query);
    }

    function addMakanan($data)
    {
        $nama_makanan = $data['nama_makanan'];
        $harga = $data['harga'];

        $query = "INSERT INTO makanan VALUES ('', '$nama_makanan', $harga)";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function deleteMakanan($id)
    {

        $query = "DELETE FROM makanan WHERE id_makanan = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function edit($id, $data)
    {
        $nama_makanan = $data['nama_makanan'];
        $harga = $data['harga'];

        $query = "UPDATE makanan SET nama_makanan='$nama_makanan', harga='$harga' WHERE id_makanan = $id";

        // Mengeksekusi query
        return $this->execute($query);
    }
}
