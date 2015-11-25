<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Session Login - Via Database</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/bootstrap/css/font-awesome.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="<?php echo base_url() ?>assets/bootstrap/js/html5shiv.min.js"></script>
      <script src="<?php echo base_url() ?>assets/bootstrap/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="background:#eeeeee;">

    <div class="container">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url() ?>index.php/chome">MyLogin</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Article</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Download <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo base_url() ?>index.php/home"><?php echo $name; ?></a></li>
	<li><a href="<?php echo base_url() ?>index.php/home/logout" id="logout_url">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="jumbotron">
  <h1>Hello, <?php echo $name; ?>!</h1>
  <p>This is the CodeIgniter Session-Warning Logout Mini-App.</p>
  <p>The JavaScript actually uses the $this->session->sess_expiration value (set in the config.php) to match the Session Lifetime.</p>
  <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
</div>
    </div>


    <!---Session Timeout Modal--->
    <div class="modal fade" id="logout_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div style="width:100%;height:100%;margin: 0px; padding:0px">
              <div style="width:25%;margin: 0px; padding:0px;float:left;">
                <i class="fa fa-warning" style="font-size: 140px;color:#da4f49"></i>
              </div>
              <div style="width:70%;margin: 0px; padding:0px;float:right;padding-top: 10px;padding-left: 3%;">
                <h4>Your session is about to expire!</h4>
                <p style="font-size: 15px;">You will be logged out in <span id="timer" style="display: inline;font-size: 30px;font-style: bold">10</span> seconds.</p>				
                <p style="font-size: 15px;">Do you want to stay signed in?</p>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div style="margin-left: 30%;margin-bottom: 20px;margin-top: 20px;">
            <a href="javascript:;" onclick="resetTimer()" class="btn btn-primary" aria-hidden="true">Yes, Keep me signed in</a>
            <a href="<?php echo base_url() ?>index.php/home/logout" class="btn btn-danger" aria-hidden="true">No, Sign me out</a>
          </div>
        </div>
      </div>
    </div>
    <!--End--->
		<?php
		$str     = $this->session->sess_expiration;
	  $order   = array('trim(', ')');
		$replace = '';
		// Processes \r\n's first so they aren't converted twice.
		$timeout = str_replace($order, $replace, $str);
		
		
		?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url() ?>bootstrap/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url() ?>bootstrap/js/bootstrap.min.js"></script>
    <script>
    //Session Timeout Warning:
    var c = 0; 
    //max_count = 10; 
    max_count  = <?php echo $timeout;?>;
    logout = true;
    startTimer();
    function startTimer(){
      setTimeout(function(){
        logout = true;
        c = 0; 
        max_count = <?php echo $timeout;?>;
        $('#timer').html(max_count);
        $('#logout_popup').modal('show');
        startCount();
    
      }, 10000);
    }
    
    function resetTimer(){
      logout = false;
      $('#logout_popup').modal('hide');
      startTimer();
    }
    
    function timedCount() {
        c = c + 1;
        remaining_time = max_count - c;
        if( remaining_time == 0 && logout ){
          $('#logout_popup').modal('hide');
        location.href = $('#logout_url').val();
    
      }else{
          $('#timer').html(remaining_time);
          t = setTimeout(function(){timedCount()}, 1000);
      }
    }
    
    function startCount() {
       timedCount();
    }
</script>
  </body>
</html>
