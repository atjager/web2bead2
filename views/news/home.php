<article class="message is-dark">
  <div class="message-body">
  On this page, you can write and comment on a post. Have fun!</div>
</article>
<div>
    </div>
    <div class="container is-max-desktop">
    <?php 
    if(isset($_SESSION['user'])){
        echo'<p>Title:</p><form name="formPost" method="post" action="?controller=news&action=createNews">
        <input type="text" name="title" class="input" required>
        <p>Post:</p>
        <textarea required name="content" class="textarea" placeholder="Write a post" style="margin-bottom:"></textarea>
        <button class="button">Submit</button>
        </form>';
    }
    ?>
    
    <?php
    foreach($posts as $e){
    echo '<div style="margin-top:40px" class="notification is-primary is-light">
    <b>'.$e->title.'</b> <span>'.$e->date.'</span> <span>'.$e->author.'</span>
    <br>

    '.$e->content.'.
</div>


';
$comments=Comment::find($e->id);

if($comments!=null){


    foreach($comments as $comment){
        echo '<div class="columns" style="margin-left:40px">'.$comment->date. '&nbsp;<strong>'.$comment->author.'</strong></div><div class="columns" style="margin-left:40px">' .$comment->content.'</div><hr>';
    }
}
if(isset($_SESSION['user'])){
echo '<button class="button"  onclick="showComment('.$e->id.')">Write a comment</button><br><form style="display:none;" id="'.$e->id.'" name="comment" action="?controller=news&action=createComment" method="post">
<textarea required name="content" class="textarea" placeholder="Write a comment" style="margin-bottom:"></textarea>
<input style="display:none; type="text" name="to" value="'.$e->id.'">
<button class="button">Submit</button>
</form>';
}
    }
    
    ?>
    
</div> 

<script>
    
    function showComment(id) {
        if(document.getElementById(id).style.display == "block"){
            document.getElementById(id).style.display = "none";
        }else{
            document.getElementById(id).style.display = "block";

        }
}

</script>