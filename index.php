<?php $connect = mysqli_connect('localhost', 'root', 'root', 'dbforum');
?>

<?php 
    if(isset($_POST['add_button'])){
        $add_title = $_POST['add_title'];
        $add_text = $_POST['add_text'];
        $add_author = $_POST['add_author'];

        if($add_title != '' || $add_text != ''){
            $imgName = $_FILES['addDiscuss_image_img']['name'];
            $tempname = $_FILES["addDiscuss_image_img"]["tmp_name"];
            $folder = "image/".$imgName;
            $query_add = "INSERT INTO discuss_block(title, text, author,image, likes) Values('$add_title','$add_text', '$add_author','$imgName',0)";
            $result_add = mysqli_query($connect, $query_add);
            move_uploaded_file($tempname, $folder);
            // $query_add = "INSERT INTO discuss_block(title, text, author,image, likes) Values('$add_title','$add_text', '$add_author','',0)";
            // $result_add = mysqli_query($connect, $query_add);  
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<script src="script.js"></script>

    <header class="header">
        <div class="heading">
            <h1 class="heading_1">Discussion Service</h1>
            <span class="heading_companyName">Interview Ready</span>
        </div>
    </header>
 
    <section class="addDiscuss">
        <h1 class="heading_1 blue">Add Your Discussion</h1>
        <form action="index.php" method="post" enctype="multipart/form-data" class="addDiscuss_form">
            <input type="text" name="add_title" placeholder="Title" class="addDiscuss_title">
            <input type="text" name="add_author" placeholder="Your Name" class="addDiscuss_author">
            <textarea name="add_text" placeholder="Text" class="addDiscuss_text" rows="5" cols="20"></textarea>
            <form action="" method="post"  class="addDiscuss_image">
            <input type="file" name="addDiscuss_image_img" class="addDiscuss_image_img">    
            <button name="add_button" class="add_button">Add</button>
        </form>
    
    </section>
 
    <section class="display">
        <div class="display_search">
            <input type="text" placeholder="Search Here" class="display_search_box" onKeyUp ='search()'>
        </div>
        <div class="display_discussion">
            <!-- script is for like button  -->

  
        <?php

            $query = "SELECT * FROM discuss_block";
            $result = mysqli_query($connect, $query);
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $title = $row['title'];
                $text = $row['text'];
                $author = $row['author'];  
                $image = $row['image'];
                $likes = $row['likes'];
                   
            ?>       
            <div class="block"> 
                <div class="block_title">
                    <h2 class="heading_2"><?php echo $title?></h2>
                </div>   
                <div class="block_text">
                        <h2 class="heading_2_small"><?php echo $text;?></h2><br>
                        <h2 class="block_text_author">&mdash; <?php echo $author;?></h2>
                </div>
                
                <img class="block_img_img" src="./image/<?php echo $image; ?>" alt="">    
                
                
                <div class="block_likeComment">
                    <button class="like_button" onclick="toggleLike(<?php echo $id;?>)" >Like</button>
                    <form action="index.php" method="post" class="block_likeComment_form">
                        <button class="comment_button" name="comment">comment</button>
                    </form>
                </div> 
               
            </div>
        <?php } ?>
        </div>
    </section>
</body>
</html>