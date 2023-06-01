<?php
include_once("models/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Members.controller.php");

$members = new MembersController();

if (isset($_POST['add'])) {
    // memanggil add
    $members->add($_POST);
} else if (isset($_POST['edit'])) {
    // memanggil edit
    $id = $_POST['id_members'];
    $members->edit($id, $_POST);
} else if (!empty($_GET['id_edit'])) {
    //memanggil edit
    $id = $_GET['id_edit'];
    $members->showForm('edit', $id);
} else {
    $members->showForm('show', 0);
}
