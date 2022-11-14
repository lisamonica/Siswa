<?php
        require '../model/student.php'; 
        session_start();             
        $studenttb=isset($_SESSION['studenttbl0'])?unserialize($_SESSION['studenttbl0']):new student();            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Record</title>
    <link rel="stylesheet" href="../libs/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <div class="wrapper">
   
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Tambah Siswa</h2>
                    </div>
                    <p>Isilah form untuk menambahkan data pada database</p>
                    <form action="../index.php?act=add" method="post" >
                    
                        <div class="form-group <?php echo (!empty($studenttb->category)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $studenttb->name; ?>">
                            <span class="help-block"><?php echo $studenttb->name_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($studenttb->name_msg)) ? 'has-error' : ''; ?>">
                            <label>Jurusan</label>
                            <input name="name" class="form-control" value="<?php echo $studenttb->name; ?>">
                            <span class="help-block"><?php echo $studenttb->name_msg;?></span>
                        </div>
                        
                        <br/>
                        <input type="submit" name="addbtn" class="btn btn-primary" value="Submit">
                        
                        <a href="../index.php" class="btn btn-default">Batal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>