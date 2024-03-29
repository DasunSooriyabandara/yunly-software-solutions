<?php 
  session_start(); 
  require_once('inc/connection.php');

  $user_id = $_SESSION['user_id'];

  $errors=array();
if(isset($_POST['submit'])){

$today = date("Y-m-d");

if($fromdate > $todate){
  $errors[]=" ToDate should be greater than FromDate ";
}
        //23      25 26
 if ($fromdate > $today) {
    echo "<script>
            alert('Incorrect date. Choose today or future date.');
            window.location.href = 'assetapplyform.php';
          </script>";
    return;
  }

  if ($fromdate > $todate) {
    echo "<script>
            alert('Incorrect date1. Choose date after from date.');
            window.location.href = 'assetapplyform.php';
          </script>";
    return;
  }

if (empty($errors)) {
    
  $asset=$_POST['asset'];
  $fromdate=$_POST['bdate'];
  $todate=$_POST['fdate'];
  $notes =$_POST['notes'];

$sql_query="INSERT INTO asset_request(asset_name,from_date,to_date,user_id,notes, status) 
    VALUES('{$asset}','{$fromdate}','{$todate}','{$user_id}','{$notes}', 'Pending')";

$result_set=mysqli_query($connection,$sql_query);
if($result_set)
{
echo "<script>alert('Successful.');</script>";
header("location: ../dashboard.php");
}
else 
{
echo "Error:" .mysqli_error($connection);
}

}
}
?> 


<!DOCTYPE html>
<html>
  <head>
    <title>Asset Apply Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
      html, body {
      min-height: 100%;
      }
      body, div, form, input, select, textarea, p { 
      padding: 1;
      margin: 1;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      line-height: 22px;
      }
      h1 {
      position: absolute;
      margin: 1;
      font-size: 36px;
      color: #fff;
      z-index: 2;
      }
      .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 195px;
      padding-top: 50px;
      }
      form {
      width: 100%;
      padding: 19px;
      border-radius: 6px;
      background: #D3D3D3;
      box-shadow: 0 0 20px 0 #333; 
      }
      .banner {
      position: relative;
      height: 211px;
    
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      }
      .banner::after {
      content: "";
      background-color: rgba(0, 0, 0, 0.4); 
      position: absolute;
      width: 100%;
      height: 100%;
      }
      input, textarea, select {
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      }
      input {
      width: calc(100% - 10px);
      padding: 4px;
      }
      select {
      width: 100%;
      padding: 7px ;
      background: transparent;
      }
      textarea {
      width: calc(100% - 12px);
      padding: 5px;
      }
      .item:hover p, .item:hover i, .question:hover p, .question label:hover, input:hover::placeholder {
      color: #333;
      }
      .item input:hover, .item select:hover, .item textarea:hover {
      border: 1px solid transparent;
      box-shadow: 0 0 6px 0 #333;
      color: #333;
      }
      .item {
      position: relative;
      margin: 10px 0;
      }
      input[type="date"]::-webkit-inner-spin-button {
      display: none;
      }
      .item i, input[type="date"]::-webkit-calendar-picker-indicator {
      position: absolute;
      font-size: 20px;
      color: #a9a9a9;
      }
      .item i {
      right: 1%;
      top: 30px;
      z-index: 1;
      }
      [type="date"]::-webkit-calendar-picker-indicator {
      right: 0;
      z-index: 2;
      opacity: 0;
      cursor: pointer;
      }
      input[type="time"]::-webkit-inner-spin-button {
      margin: 2px 22px 0 0;
      }
      input[type=radio], input.other {
      display: none;
      }
      label.radio {
      position: relative;
      display: inline-block;
      margin: 5px 20px 10px 0;
      cursor: pointer;
      }
      .question span {
      margin-left: 30px;
      }
      label.radio:before {
      content: "";
      position: absolute;
      top: 2px;
      left: 0;
      width: 15px;
      height: 15px;
      border-radius: 50%;
      border: 2px solid #ccc;
      }
      #radio_5:checked ~ input.other {
      display: block;
      }
      input[type=radio]:checked + label.radio:before {
      border: 2px solid #444;
      background: #444;
      }
      label.radio:after {
      content: "";
      position: absolute;
      top: 7px;
      left: 5px;
      width: 7px;
      height: 4px;
      border: 3px solid #fff;
      border-top: none;
      border-right: none;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after {
      opacity: 1;
      }
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      button {
      width: 150px;
      padding: 10px;
      border: none;
      border-radius: 5px; 
      background: #444;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      }
      button:hover {
      background: #666;
      }
      @media (min-width: 568px) {
      .name-item, .city-item {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      }
      .name-item input, .city-item input {
      width: calc(50% - 20px);
      }
      .city-item select {
      width: calc(50% - 8px);
      }
      }
    </style>



  </head>
  <body>
    <div class="testbox">
      <form action="assetapplyform.php" method="POST">
        <div class="banner">
          <h1>Asset Apply Form</h1>
        </div>
        <div class="item">
          <p>User ID</p>  
          <div class="name-item">
            <input type="text" name="user_id"  disabled value="<?php echo $user_id; ?>" />

            
          </div>
        </div>

         <div class="item" >
          <p>Asset Type<p>
        
          <select name="asset" style="background-color:#fff;">
              <?php
                $out = '<option>Select item</option>';

                $res = mysqli_query($connection, "SELECT asset_name FROM assets ORDER BY asset_name");

                if ($res) {
                  while ($d = mysqli_fetch_array($res)) {
                    $out .= '<option>'.$d['asset_name'].'</option>';
                  }

                  echo $out;
                }else {
                  echo mysqli_error($connection);
                }
              ?>
            </select>
             </div>
       
          
                
        <div class="item">
          <p>From</p>
          <input type="date" name="bdate" />
          <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="item">
          <p>To</p>
          <input type="date" name="fdate" />
          <i class="fas fa-calendar-alt"></i>
        </div>
        
        <div class="item" >
          <p>Notes</p>

          <textarea rows="3" name="notes"></textarea>
        </div>
        <div class="btn-block">
          <button type="submit" name="submit" >APPLY</button>
        </div>
      </form>
    </div>
  </body>
</html>
