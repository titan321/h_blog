<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Harriken Blog</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?= base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?= base_url()?>assets/css/clean-blog.min.css" rel="stylesheet">
        <link href="<?= base_url()?>assets/css/styles.css" rel="stylesheet">
        <link href="<?= base_url()?>assets/css/login_modal.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,700,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Asap:400,700' rel='stylesheet' type='text/css'>



        <script type = "text/javascript" 
        src = "http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">Harriken Blog</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?= base_url()?>/blog">Home</a>
                        </li>
                        <li>
                            <a href="">About</a>
                        </li>
                        <li>
                            <a href="">Sample </a>
                        </li>
                        <li>
                            <a href="">Contact</a>
                        </li>
                        <li>
                            <?php if ($this->session->userdata("userid")) { ?>
                                <a href="<?= base_url()?>user/logout/" id="logout_text">Logout</a>
                            <?php } else { ?>
                                <a href="#" id="login_text">Login</a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        
      <!--?= print_r($userinfo); ?-->
      
      
       <!-- The Modal -->
  
        <div id="myModal" class="modal" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Login to Harriken Blog</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="well forpad">
                                
                                <a href="<?= base_url()?>fblogin" class="btn btn-default btn-block btn-ownfb">Login with Facebook</a>
                                
                                <div style="text-align: center; margin-top: 40px;">
                                        <h4 style="text-transform: capitalize;"> ALREADY REGISTERED ??? </h4>
                                       
                                    </div>
                                
                                <form id="loginForm" method="POST" action="<?= base_url()?>user/login" novalidate="novalidate">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" value="" required="" title="Please enter you email" placeholder="example@gmail.com">
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="control-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
                                        <span class="help-block"></span>
                                    </div>
                                    <div id="loginErrorMsg" class="alert alert-error hide">Wrong username or password</div>
<!--                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" id="remember"> Remember login
                                        </label>
                                        <p class="help-block">(if this is a private computer)</p>
                                    </div>-->
                                    <button type="submit" class="btn btn-success btn-block btn-harriken">Login with Harriken</button>
                                    
                                  
<!--                                <button type="submit" class="btn btn-success btn-block btn-ownfb">Login with Facebook </button>-->
                                
                                </form>
                            </div>
                        </div>
                      <div class="col-xs-6">
                             <div class="well forpad">

                                <div class="panel-body">
                                    <div style="text-align: center; margin-top: 0px;">
                                        <h4 style="text-transform: capitalize;"> NOT YET REGISTERED !!!! </h4>
                                       
                                    </div>
                                    <?php #myModal.css('display':'block'); ?>
                                    <?php $attributes = array("name" => "registrationform");
                                    echo form_open("user/register", $attributes);?>
  
                                    <div class="form-group">
                                            <label for="fullname">Full Name</label>
                                            <input class="form-control" name="fullname" placeholder="Your Full Name" type="text" value="<?php echo set_value('fullname'); ?>" />
                                            <span class="text-danger"><?php echo form_error('fullname'); ?></span>
                                    </div>

                                    <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input class="form-control" name="email" placeholder="Email " type="text" value="<?php echo set_value('email'); ?>" />
                                            <span class="text-danger"><?php echo form_error('email'); ?></span>
                                    </div>

                                    <div class="form-group">
                                            <label for="subject">Password</label>
                                            <input class="form-control" name="password" placeholder="Password" type="password" />
                                            <span class="text-danger"><?php echo form_error('password'); ?></span>
                                    </div>

                                    <div class="form-group">
                                            <label for="subject">Confirm Password</label>
                                            <input class="form-control" name="cpassword" placeholder="Confirm Password" type="password" />
                                            <span class="text-danger"><?php echo form_error('cpassword'); ?></span>
                                    </div>

                                    <div class="form-group">
                                            <button name="submit" type="submit" class="btn btn-success btn-block btn-harriken">Signup</button>
                                          
                                    </div>
                                    <?php echo form_close(); ?>
                                    <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 

 
<!-- end modal -->
