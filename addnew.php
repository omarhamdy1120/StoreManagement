<?php
session_start();

if(!isset($_SESSION['userId']))
{
  header('location:login.php');
}
 ?>
<?php require "assets/function.php" ?>
<?php require 'assets/db.php';?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo siteTitle(); ?></title>
  <?php require "assets/autoloader.php" ?>
  <style type="text/css">
  <?php include 'css/customStyle.css'; ?>

  </style>
  <?php 
  $notice="";
  if (isset($_POST['safeIn'])) 
  {
    $filename = $_FILES['inPic']['name'];
    move_uploaded_file($_FILES["inPic"]["tmp_name"], "photo/".$_FILES["inPic"]["name"]);
    if ($con->query("insert into categories (name,pic) value ('$_POST[name]','$filename')")) {
      $notice ="<div class='alert alert-success'>Done</div>";
    }
    else
      $notice ="<div class='alert alert-danger'>Error :".$con->error."</div>";
  }

   ?>
</head>
<body style="background: #ECF0F5;padding:0;margin:0">
<div class="dashboard" style="position: fixed;width: 18%;height: 100%;background:#222D32">
  <div style="background:#064663;padding: 15px 3px;color:white;font-size: 15pt;text-align: center;text-shadow: 1px 1px 11px black">
    <a href="index.php" style="color: white;text-decoration: none;"><?php echo strtoupper(siteName()); ?> </a>
  </div>
  <div class="flex" style="padding: 3px 7px;margin:5px 2px;">
    <div><img src="photo/<?php echo $user['pic'] ?>" class='img-circle' style='width: 77px;height: 66px'></div>
    <div style="color:white;font-size: 13pt;padding: 14px 7px;margin-left: 11px;"><?php echo ucfirst($user['name']); ?></div>
  </div>
  <div style="background: #1A2226;font-size: 10pt;padding: 11px;color: #79978F">Menu</div>
  <div>
    <div style="background:#1E282C;color: white;padding: 13px 17px;border-left: 3px solid #2D4263;"><span><i class="fa fa-dashboard fa-fw"></i> Control panal</span></div>
    <div class="item">
      <ul class="nostyle zero">
        <a href="index.php"><li ><i class="fa fa-circle-o fa-fw"></i> Home</li></a>
        <a href="inventeries.php"><li><i class="fa fa-circle-o fa-fw"></i> Items</li></a>
       <a href="addnew.php"><li style="color: white"><i class="fa fa-circle-o fa-fw"></i> Add New Item</li></a>
        <!-- <a href="newsell"><li><i class="fa fa-circle-o fa-fw"></i> New Sell</li></a> -->
        <a href="reports.php"><li><i class="fa fa-circle-o fa-fw"></i> Bills</li></a>
      </ul><
    </div>
  </div>
  <div style="background:#1E282C;color: white;padding: 13px 17px;border-left: 3px solid #2D4263;"><span><i class="fa fa-globe fa-fw"></i> Setting</span></div>
  <div class="item">
      <ul class="nostyle zero">
        <a href="sitesetting.php"><li><i class="fa fa-circle-o fa-fw"></i> Store setting</li></a>
       <a href="profile.php"><li><i class="fa fa-circle-o fa-fw"></i> Profile</li></a>
        <a href="accountSetting.php"><li><i class="fa fa-circle-o fa-fw"></i> Account Setting</li></a>
        <a href="logout.php"><li><i class="fa fa-circle-o fa-fw"></i> Logout</li></a>
      </ul><
    </div>
</div>
<div class="marginLeft" >
  <div style="color:white;background:#064663" >
    <div class="pull-right flex rightAccount" style="padding-right: 11px;padding: 11px;">
      <div><img src="photo/<?php echo $user['pic'] ?>" style='width: 41px;height: 33px;' class='img-circle'></div>
      <div style="padding: 8px"><?php echo ucfirst($user['name']) ?></div>
    </div>
    <div class="clear"></div>
  </div>
<div class="account" style="display: none;">
  <div style="background: #064663;padding: 22px;" class="center">
    <img src="photo/<?php echo $user['pic'] ?>" style='width: 100px;height: 100px; margin:auto;' class='img-circle img-thumbnail'>
    <br><br>
    <span style="font-size: 13pt;color:#CEE6F0"><?php echo $user['name'] ?></span><br>
    <span style="color: #CEE6F0;font-size: 10pt">User since:<?php echo $user['date']; ?></span>
  </div>
  <div style="padding: 11px;">
    <a href="profile.php"><button class="btn btn-default" style="border-radius:0">Profile</button>
    <a href="logout.php"><button class="btn btn-default pull-right" style="border-radius: 0">Logout</button></a>
  </div>
</div>
<?php 
if (isset($_POST['saveProduct'])) {
if ($con->query("insert into inventeries (catId,supplier,name,price,description,company) values ('$_POST[catId]','$_POST[supplier]','$_POST[name]','$_POST[price]','$_POST[discription]','$_POST[company]')")) {
  $notice ="<div class='alert alert-success'>Done</div>";
}
else{
  $notice ="<div class='alert alert-danger'>Error:".$con->error."</div>";
}
}

 ?>
  <div class="content2">
<ol class="breadcrumb ">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add New Item</li>
    </ol>
    <?php echo $notice ?>
    <div style="width: 55%;margin: auto;padding: 22px;" class="well well-sm center">

      <h4>Add New Item</h4><hr>
      <form method="POST">
         <div class="form-group">
            <label for="some" class="col-form-label">Item Name</label>
            <input type="text" name="name" class="form-control" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">Price</label>
            <input type="number" name="price"  class="form-control" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">Brand Name</label>
            <input type="text" name="supplier"  class="form-control" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">Company Name</label>
            <input type="text" name="company"  class="form-control" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">Choose Category</label>
            <select class="form-control" required name="catId">
              <option selected disabled value="">Please Choose Category</option>
            <?php getAllCat(); ?>
              
            </select>
          </div>
           <div class="form-group">
            <label for="some" class="col-form-label">Discription</label>
          <textarea class="form-control" name="discription" required placeholder="Write a Disciption"></textarea> 
          </div>
          <div class="center">
            <button type="submit" name="saveProduct" class="btn btn-primary">Save</button>
            <button type="reset" class="btn btn-success">Close</button>
          </div>
        </form>
    </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});});
</script>

