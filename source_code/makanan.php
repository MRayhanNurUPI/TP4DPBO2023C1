<?php
include_once("models/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Makanan.controller.php");

$makanan = new MakananController();

if (isset($_POST['add'])) {
    // memanggil add
    $makanan->add($_POST);
} else if (isset($_POST['edit'])) {
    // memanggil edit
    $id = $_POST['id_makanan'];
    $makanan->edit($id, $_POST);
} else if (!empty($_GET['id_hapus'])) {
    //memanggil hapus
    $id = $_GET['id_hapus'];
    $makanan->delete($id);
} else if (!empty($_GET['id_edit'])) {
    //memanggil edit
    $id = $_GET['id_edit'];
    $makanan->index('edit', $id);
} else {
    $makanan->index('show', 0);
}
