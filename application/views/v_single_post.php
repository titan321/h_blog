
<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('<?= base_url() ?>assets/img/post-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-heading">
                    <h1><?= $post['title']; ?></h1>
                    <!--                        <h2 class="subheading">Problems look mighty small from 150 miles up</h2>-->
                    <span class="meta">Posted by <a href="#"><?= $post['fullname']; ?></a> on <?= date("d M, Y", strtotime($post['created_at'])); ?></span>
                </div>
            </div>
        </div>
    </div>
</header>


<!--// Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <?= $post['description']; ?>               
                </div>                
            </div>
            
            
                     
            <div class="row">
                 <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                 
                     
               
                <h3>General Comments</h3>
                <?php     
                    if(count($comments) > 0)
                    {
                        foreach ($comments as $row){
                           ?>
                        <p>
                        <div class="container col-md-12 " >
                            <div class="row" style="padding:10px;">
                                <div class="col-md-2" style="text-align:center;"> 
                                    <?php
                                    if($row['profileimage']=='')
                                        $imglink= base_url().'assets/img/anonymus.jpg';
                                    else{
                                        $clink='https://s3-ap-southeast-1.amazonaws.com/harriken-image-bucket/profile-pic/2016/04/';
                                        $imglink=$clink.$row['profileimage'];
                                    }
                                    
                                    ?>
                                    
                                    <img src="<?= $imglink; ?>"
                                         alt="lol" height="120" width="110" ">
                                </div>
                                 <div class="col-md-9"> 
                                    <strong><?= $row['fullname'] ?></strong> 
                                </div>  
                                <div class="col-md-9 ">  
                                    Posted at <?= date('d-m-Y h:i A',strtotime($row['created_at']))?><br>
                                </div>
                                <div class="col-md-9" style="padding-top:10px;padding-bottom: 10px;">  
                                    <?= $row['comment'] ?>
                                
                                </div>
                            </div>
                        </div>
                        </p>
                    <hr>

                        <?php } ?>

                    <?php
                    } else { //when there is no comment
                        echo "<p>Currently, there is no comment.</p>";
                    }

                    if ($this->session->userdata('userid')) {//if user is loged in, display comment box
                        ?>
                        <form action="<?= base_url() ?>comments/add_comment/<?= $post['id'] ?>" method="post">
                            <div class="form_settings">
                                <p>
                                    <span>Comment</span><br>
                                    <textarea class="ckeditor" rows="8" cols="50" name="comment"></textarea>
<!--                                    <?php echo $this->ckeditor->editor("summary", html_entity_decode(set_value('summary'))); ?>     -->
                
                                </p>
                                <p style="padding-top: 15px">
                                    <span>&nbsp;</span>
                                    <input class="submit" type="submit" name="add" value="Add comment" />
                                      
                                </p>
                            </div>
                        </form>


                    <?php } else {//if no user is loged in, then show the loged in button
                        ?>
                        <a href="<?= base_url() ?>blog"></br>Login to comment</a>

                    <?php }
                    ?>
                         
                 </div>
            </div>
        </div>
    </article>


            