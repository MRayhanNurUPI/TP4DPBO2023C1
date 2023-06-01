<?php
include_once("models/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Members.controller.php");

$members = new MembersController();

if (!empty($_GET['id_hapus'])) {
    //memanggil hapus
    $id = $_GET['id_hapus'];
    $members->delete($id);
} else {
    $members->index();
}
