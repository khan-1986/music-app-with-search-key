<?php
$connect = mysqli_connect("localhost", "root", "", "music");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM bd 
  WHERE audio LIKE '%".$search."%'
  
 ";


$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive col-lg-4">
   <table class="table table bordered">
    <tr>
     <th>id</th>
     <th>name</th>
     
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
	 //$song_id = $row["id"];
	 // <td id='.$song_id.' class="imi12">'.$row["audio"].'</td>
 $output .= '
  <tr>
    <td>'.$row["id"].'</td>
    <td><a href="play.php?name='.$row["audio"].'">'.$row["audio"].'</a></td>
	<td><a href="play.php?name12='.$row["img"].'"></a></td>
    
   </tr>
  ';
 }
 echo $output;
}
else
{
echo 'Data Not Found';
}
}
?>