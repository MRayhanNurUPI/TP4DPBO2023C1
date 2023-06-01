<?php
include_once("conf.php");
include_once("models/Makanan.class.php");
include_once("views/Makanan.view.php");

class MakananController
{
    private $makanan;

    function __construct()
    {
        $this->makanan = new Makanan(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    public function index($job, $id)
    {
        $this->makanan->open();
        $this->makanan->getMakanan();
        $data = array(
            'makanan' => array(),
        );
        while ($row = $this->makanan->getResult()) {
            array_push($data['makanan'], $row);
        }
        $this->makanan->close();

        if ($job == "edit") {
            $this->makanan->open();
            $this->makanan->getMakananByID($id);
            $dataByID = array(
                'makanan' => array(),
            );
            while ($row = $this->makanan->getResult()) {
                array_push($dataByID['makanan'], $row);
            }
            $this->makanan->close();
        } else {
            $dataByID = '';
        }

        $view = new MakananView();
        $view->render($id, $data, $dataByID);
    }

    function add($data)
    {
        $this->makanan->open();
        $this->makanan->addMakanan($data);
        $this->makanan->close();

        header("location:makanan.php");
    }

    function edit($id, $data)
    {
        $this->makanan->open();
        $this->makanan->edit($id, $data);
        $this->makanan->close();

        header("location:makanan.php");
    }

    function delete($id)
    {
        $this->makanan->open();
        $this->makanan->deleteMakanan($id);
        $this->makanan->close();

        header("location:makanan.php");
    }
}
