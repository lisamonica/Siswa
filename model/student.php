<?php

class student
{
    // table fields
    public $id;
    public $name;
    public $TTL;
    public $sekolah;
    public $jurusan;
    // message string
    public $id_msg;
    public $name_msg;
    public $TTL_msg;
    public $sekolah_msg;
    public $jurusan_msg;
    // constructor set default value
    function __construct()
    {
        $id=0;$name=$TTL=$sekolah=$jurusan="";
        $id_msg=$name_msg=$TTL_msg=$sekolah_msg=$jurusan_msg="";
    }
}
?>