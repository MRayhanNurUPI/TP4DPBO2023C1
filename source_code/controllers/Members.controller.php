<?php
include_once("conf.php");
include_once("models/Members.class.php");
include_once("models/Makanan.class.php");
include_once("views/Members.view.php");

class MembersController
{
    private $members;
    private $makanan;

    function __construct()
    {
        $this->members = new Members(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        $this->makanan = new Makanan(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    public function index()
    {
        $this->members->open();
        $this->members->getMembers();
        $this->makanan->open();
        $this->makanan->getMakanan();

        $data = array(
            'members' => array(),
            'makanan' => array()
        );

        while ($row = $this->members->getResult()) {
            array_push($data['members'], $row);
        }

        $this->members->close();

        $view = new MembersView();
        $view->render($data);
    }

    function add($data)
    {
        $this->members->open();
        $this->members->addMembers($data);
        $this->members->close();

        header("location:index.php");
    }

    function edit($id, $data)
    {
        $this->members->open();
        $this->members->edit($id, $data);
        $this->members->close();

        header("location:index.php");
    }

    function delete($id)
    {
        $this->members->open();
        $this->members->deleteMembers($id);
        $this->members->close();

        header("location:index.php");
    }

    public function showForm($title, $id)
    {
        $this->members->open();
        $this->makanan->open();
        $data = array(
            'members' => array(),
            'makanan' => array()
        );

        if ($title == 'edit') {
            $this->members->getMembersByID($id);
            while ($row = $this->members->getResult()) {
                array_push($data['members'], $row);
            }
        } else {
            $data = array(
                'makanan' => array()
            );
        }

        $this->makanan->getMakanan();
        while ($row = $this->makanan->getResult()) {
            array_push($data['makanan'], $row);
        }

        $this->members->close();
        $this->makanan->close();

        $view = new MembersView();
        $view->renderForm($data, $id);
    }
}
