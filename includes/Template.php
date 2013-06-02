<?php

class Template {
	public function output($content) {
		$ldap = new LDAP;
		$user = $ldap->getMember($_SERVER['PHP_AUTH_USER']);
		$return='<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>'.SITE_BRAND.' TrackIt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.1/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="'.LINK_ABS.'/js/home.js"></script>
  </head>

  <body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">'.SITE_BRAND.' TrackIt</a>
          <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> Hi '.$user['nick'].'
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#"><i class="icon-cog"></i> Profile</a></li>
              <li class="divider"></li>
              <li><a href="#"><i class="icon-remove"></i> Sign Out</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Fault Reporting</li>
              <li class="active"><a href="#"><i class="icon-wrench"></i> Report a Fault</a></li>
              <li><a href="#"><i class="icon-list"></i> List Faults</a></li>
              <li class="nav-header">Inventory Management</li>
              <li><a href="#"><i class="icon-search"></i> Find Equipment</a></li>
              <li><a href="#"><i class="icon-plus"></i> Add Equipment</a></li>
              <li class="nav-header">Equipment Bookings</li>
              <li><a href="#"><i class="icon-book"></i> Book Equipment</a></li>
              <li><a href="#"><i class="icon-calendar"></i> Future Bookings</a></li>
              <li class="nav-header">External Hires</li>
              <li><a href="#"><i class="icon-share-alt"></i> New Hire</a></li>
              <li><a href="#"><i class="icon-calendar"></i> Future Bookings</a></li>
              <li><a href="#"><i class="icon-shopping-cart"></i> Manage Invoices</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
'.$content.'
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; '.SITE_BRAND.' '.date('Y').'</p>
      </footer>

    </div><!--/.fluid-container-->


  </body>
</html>
';
		if ($GLOBALS['template'] == FALSE) {
			return $content;
		} else {
			return $return;
		}
	}
}
?>