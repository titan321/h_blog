        <!-- Page Header -->
        <!-- Set your background image for this header on the line below. -->
        <header class="intro-header" style="background-image: url('<?= base_url()?>assets/img/home-bg.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                        <div class="site-heading">
                            <h1>Harriken Blog</h1>
                            <hr class="small">
                            <span class="subheading">JOIN US IN THE FOODTASTIC REVOLUTION</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <!--                // customized by me-->
                    <?php foreach($posts as $post){ ?>
                    <div class="post-preview">
                        <a href="<?= base_url()?>index.php/blog/post/<?= $post['id']; ?>">
                            <h2 class="post-title">
                                <?= $post['title']; ?>
                            </h2>
                            <h3 class="post-subtitle">
                                <?= substr(strip_tags($post['description']), 0, 150).'...';?>
                            </h3>
                        </a>
                        <p class="post-meta">Posted by <a href="#"><?= $post['fullname']; ?></a> on <?= date("d M, Y",strtotime($post['created_at'])); ?></p>
                    </div>
                    <hr>
                    <?php } ?>
                    <!-- end customized --> 
                </div>
            </div>
        </div>

        <hr>

      