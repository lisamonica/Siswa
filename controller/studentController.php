<?php
    require 'model/studentModel.php';
    require 'model/student.php';
    require_once 'config.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

    class studentController
    {

        function __construct()
        {
            $this->objconfig = new config();
            $this->objsm = new studentModel($this->objconfig);
        }

        public function siswaHandler()
        {
            $act = isset($_GET['act']) ? $_GET['act'] : NULL;
            switch ($act)
            {
                case 'add' :
                    $this->insert();
                    break;
                case 'update' :
                    $this->update();
                    break;
                case 'delete' :
                    $this-> delete();
                    break;
                default:
                    $this->list();
            }
        }

        public function pageRedirect($url)
        {
            header('Location:'.$url);
        }

        public function checkvalidation($studenttb)
        {   $noerror=true;

            if(empty($studenttb->name)){
                $studenttb->name_msg = "File is empty.";$noerror=false;
            } elseif(!filter_var($studenttb->name, FILTER_VALIDATE_REGEXP,
array("option"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $studenttb->name_msg = "Invalid entry.";$noerror=false;
            }else{$studenttb->name_msg ="";}
            if(empty($studenttb->name)){
                $studenttb->TTL_msg = "File is empty.";$noerror=false;
            } elseif(!filter_var($studenttb->TTL, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $studenttb->TTL_msg = "Invalid entry.";$noerror=false;
            }else{$studenttb->TTL_msg ="";}
            return $noerror;
        }

        public function insert()
        {
            try{
                $studenttb=new student();
                if (isset($_POST['addbtn']))
                {

                    $studenttb->name = trim($_POST['name']);
                    $studenttb->TTL = trim($_POST['TTL']);

                    $chk=$this->checkvalidation($studenttb);
                    if($chk)
                    {
                        $pid = $this -> objsm ->insertRecord($studenttb);
                        if($pid>0){
                            $this->list();
                        }else{
                            echo "somthing is wrong..., try again.";
                        }
                    }else
                    {
                        $_SESSION['studenttb10']=serialize($studenttb);//add session obj
                        $this->pageRedirect("view/insert.php");
                    }
                }
            }
        catch (Exception $e)
        {
            $this->close_db();
            throw $e;
        }
    }

    public function update()
    {
        try
        {
            if(isset($_POST['updatebtn']))

            {
                $studenttb=unserialize($_SESSION['studenttb10']);
                $studenttb->id = trim($_POST['id']);
                $studenttb->name = trim($_POST['name']);
                $studenttb->TTL = trim($_POST['TTL']);
                $studenttb->sekolah = trim($_POST['sekolah']);
                $studenttb->jurusan = trim($_POST['jurusan']);
                // check validation
                $chk=$this->checkValidation($studenttb);
                if($chk)
                {
                    $res = $this -> objsm ->updateRecord($studenttb);
                    if($res){
                        $this->list();
                    }else{
                        echo "somthing is wrong..., try again.";
                    }
                }else
                {
                    $_SESSION['studenttb10']=serialize($studenttb);
                    $this->pageRedirect("view/update.php");
                }
            }elseif(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
                $id=$_GET['id'];
                $result=$this->objsm->selecRecord($id);
                $row=mysqli_fetch_array($result);
                $studenttb=new student();
                $studenttb->id=$row["id"];
                $studenttb->name =$row['name'];
                $studenttb->TTL =$row['TTL'];
                $studenttb->sekolah =$row['sekolah'];
                $studenttb->jurusan =$row['jurusan'];
                $_SESSION['studenttb10']=serialize($studenttb);
                $this->pageRedirect('view/update.php');
            }else{
                echo "Invalid operation.";
            }
        }
        catch (Exception $e)
        {
            $this->close_db();
            throw $e;
        }
    }
    public function delete()
    {
        try
        {
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
                $res=$this->objsm->deleteRecord($id);
                if($res){
                    $this->pageRedirect('index.php');
                }else{
                    echo "somthing is wrong..., try again.";
                }
            }else{
                echo "Invalid operation.";
            }
        }
        catch (Exception $e)
        {
            $this->close_db();
            throw $e;
        }
    }
    public function list(){
        $result=$this->objsm->selectRecord(0);
        include "view/list.php";
    }
}

?>