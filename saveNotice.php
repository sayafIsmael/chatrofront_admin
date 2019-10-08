<?php  
        include 'db.php';
        
		$sql="INSERT INTO notice VALUES
(DEFAULT,'$_POST[title]','$_POST[message]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
    
  
  function sendMessage() {
      $content      = array(
          "en" => $_POST[message]
      );
      $heading      = array(
        "en" => $_POST[title]
      );
      $hashes_array = array();
      
      $fields = array(
          'app_id' => "333341a1-0a70-477f-91eb-196ff6bb8bd4",
          'included_segments' => array(
              'All'
          ),
          'data' => array(
              "foo" => "bar"
          ),
          'contents' => $content,
          'headings' => $heading,

      );
      
      $fields = json_encode($fields);
      print("\nJSON sent:\n");
      print($fields);
      
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json; charset=utf-8',
          'Authorization: Basic Y2FjOTRiZGYtNDg5Ni00YmM3LThmNDQtZDdjN2YwODZmOGYw'
      ));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
      
      $response = curl_exec($ch);
      curl_close($ch);
      
      return $response;
  }
  
  $response = sendMessage();
  $return["allresponses"] = $response;
  $return = json_encode($return);
  
  $data = json_decode($response, true);
  print_r($data);
  $id = $data['id'];
  print_r($id);
  
  print("\n\nJSON received:\n");
  print($return);
  print("\n");
  

mysqli_close($con);
header("Location:notice.php");
?>