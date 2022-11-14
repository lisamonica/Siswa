<?php
        require '../model/student.php';
        session_start();
        $studenttb=isset($_SESSION['studenttbl0'])?unserialize($_SESSION['studenttbl0']):new student();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Record</title>
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
                        <h2>Update Jurusan</h2>
                    </div>
                    <p>Isilah form untuk menambahkan data ke database</p>
                    <form action="../index.php?act=update" method="post" >
                    <div class="form-group <?php echo (!empty($studenttb->name_msg)) ? 'has-error'
: ''; ?>">
                        <label>Kategori</label>
                        <input type="text" name="category" class="form-control" value="<?php echo
$studenttb->name; ?>">
                        <span class="help-block"><?php echo $studenttb->name_msg;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($studenttb->TTL_msg)) ? 'has-error' :
''; ?>">
                    <label>Jurusan</label>
                    <input type="text" name="name" class="form-control" value="<?php echo
$studenttb->name; ?> ">
                            <span class="help-block"><?php echo $studenttb->TTL_msg;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $studenttb->id; ?>"/>
                        <input type="submit" name="updatebtn" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-default">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
