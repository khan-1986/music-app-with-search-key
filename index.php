<?php
$con = mysqli_connect('localhost','root');
mysqli_select_db($con,'music');

if(isset($_POST['submit']))
{
$file_name=$_FILES["audio"]["name"];
$tmp_name=$_FILES["audio"]["tmp_name"];
$file_img=$_FILES["img"]["name"];
$tmp_img=$_FILES["img"]["tmp_name"];
$singer=$_POST["sname"];
$sql = "INSERT INTO bd (id,audio,img,singer) VALUES(NULL,'$file_name','$file_img','$singer')";
$qu=mysqli_query($con,$sql) or die(mysqli_error());

move_uploaded_file($tmp_name,"upload/".$file_name);
  move_uploaded_file($tmp_img,"img/".$file_img);
}
?>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Music Player | CodingNepal</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
      integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
      crossorigin="anonymous"
    ></script>
</head>
<body>
  <div class="wrapper">
    <div class="top-bar">
      
    </div>
	<div class="container">
 <div class="row">

   <div class="form-group col-lg-4">
    <div class="input-group">
     <span class="input-group-addon ">Search</span>
     <input type="text" name="search_text" id="search_text" placeholder="Search by song" class="form-control"/>
	</div>
   
   </div>
   <div id="result"></div>
    <div class="img-area">
      <img src="" alt="">
    </div>
    <div class="song-details">
      <p class="name"></p>
      <p class="artist"></p>
    </div>
    <div class="progress-area">
      <div class="progress-bar">
        <audio id="main-audio" src=""></audio>
      </div>
      <div class="song-timer">
        <span class="current-time">0:00</span>
        <span class="max-duration">0:00</span>
      </div>
    </div>
    <div class="controls">
      <i id="repeat-plist" class="material-icons" title="Playlist looped">repeat</i>
      <i id="prev" class="material-icons">skip_previous</i>
      <div class="play-pause">
        <i class="material-icons play">play_arrow</i>
      </div>
      <i id="next" class="material-icons">skip_next</i>
      <i id="more-music" class="material-icons">queue_music</i>
    </div>
	<div class="volume">
            <p id="volume_show">90</p>
            <i class="fa fa-volume-up" aria-hidden="true" onclick="mute_sound()" id="volume_icon"></i>
            <input type="range" min="0" max="100" value="90" onchange="volume_change()" id="volume">  
         </div>
    <div class="music-list">
      <div class="header">
        <div class="row">
          <i class= "list material-icons">queue_music</i>
          <span>Music list</span>
        </div>
        <i id="close" class="material-icons">close</i>
      </div>
      <ul>
        <!-- here li list are coming from js -->
      </ul>
    </div>
  </div>
  
<script type="text/javascript">

// To add more song, just copy the following code and paste inside the array

//   {
//     name: "Here is the music name",
//     artist: "Here is the artist name",
//     img: "image name here - remember img must be in .jpg formate and it's inside the images folder of this project folder",
//     src: "music name here - remember img must be in .mp3 formate and it's inside the songs folder of this project folder"
//   }

//paste it inside the array as more as you want music then you don't need to do any other thing

let allMusic = [
  <?php

 $connect = mysqli_connect("localhost", "root", "", "music");
 $query = "
  SELECT * FROM bd 
  ";
	$result = mysqli_query($connect, $query);
foreach($result as $key=>$row){
 ?>
   {
	  
     name: "<?php echo $row['audio']; ?>",
     path: "upload/<?php echo $row['audio']; ?>",
     img: "img/<?php echo $row['img']; ?>",
	
     singer: "<?php echo $row['singer']; ?>"
	 
	   
   },
  
   <?php } ?>
];




</script>
  <script>
  $("#search_text").keyup(function(){
	var search = $("#search_text").val();
load_data(search);
});
 function load_data(query)
 {
  $.ajax({
   url:"new.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
  
 /* $(document).ready(function(){
		 $(document).on("click",".imi12",function() {
        var song_id = $(this).attr("id");
         alert(song_id);
		  playsong(song_id);
		
    });
 });
 */
});
  </script>
  <script src="js/script.js"></script>

</body>
</html>
