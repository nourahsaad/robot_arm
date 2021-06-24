<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "robot1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "تم الاتصال بقاعدة البيانات بنجاح";

// UPDATE DATA
if (isset($_POST["save"])) { // only call function when a post request is being processed

    // print_r($_POST);
    $datatime = date('Y-m-d H:i:s');
    $sql = "UPDATE controller
    SET range_weight_disp = '$_POST[weight]', 
    range1weight = '$_POST[w1]',
    range2weight = '$_POST[w2]',
    range3weight = '$_POST[w3]',
    range4weight = '$_POST[w4]',
    range5weight = '$_POST[w5]',
    updated_at = '$datatime'";

    if (mysqli_query($conn, $sql)) {
        echo "<br>";
        echo "\n  تم حفظ التعديلات بنجاح";

    } else {
        echo "حدث خطأ عند محاولة تحديث البيانات: " . mysqli_error($conn);
    }
}

// GET current data
$getSql = "SELECT * FROM `controller` ORDER BY `updated_at`";
$result = $conn->query($getSql);

echo '<br>';
$robot_data = $result->fetch_array(MYSQLI_ASSOC);
?>

<head>
   <style>
      body {
      background-image: url("img/bg.jpg");
      }
      body {
      text-align: center;
      position: relative;
      display: block;
      }
   </style>
</head>
<body>
   <form method="post" action="index.php">
      <h1> محركات ذراع الروبوت</h1>
      <p>المحرك 1</p>
      <input type="range" name="weight" id="range_weight" value="<?php echo $robot_data['range_weight_disp'] ?>" min="1" max="100" oninput="range_weight_disp.value = range_weight.value">
      <output  id="range_weight_disp"></output>
      <br>
      <p>المحرك 2</p>
      <input type="range" name="w1" id="range1" value="<?php echo $robot_data['range1weight'] ?>" min="1" max="100" oninput="range1weight.value = range1.value">
      <output  id="range1weight"></output>
      <br>
      <p>المحرك 3:</p>
      <input type="range" name="w2" id="range2" value="<?php echo $robot_data['range2weight'] ?>" min="1" max="100" oninput="range2weight.value = range2.value">
      <output  id="range2weight"></output>
      <br>
      <p>المحرك 4:</p>
      <input type="range" name="w3" id="range3" value="<?php echo $robot_data['range3weight'] ?>" min="1" max="100" oninput="range3weight.value = range3.value">
      <output  id="range3weight"></output>
      <br>
      <p>المحرك 5:</p>
      <input type="range" name="w4" id="range4" value="<?php echo $robot_data['range4weight'] ?>" min="1" max="100" oninput="range4weight.value = range4.value">
      <output  id="range4weight"></output>
      <br>
      <p>المحرك 6:</p>
      <input type="range" name="w5" id="range5" value="<?php echo $robot_data['range5weight'] ?>" min="1" max="100" oninput="range5weight.value = range5.value">
      <output  id="range5weight"></output>
      <br>
      <button  type="submit" name="save" >حفظ</button>
      <br>
      <br>
      <br>
      <button type="button">تشغيل</button>
   </form>
</body>
</html>
