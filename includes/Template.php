<?php

class Template {
	public function output($content) {
    if ($GLOBALS['template'] == TRUE) {
      $mainMenu = new Menu();
      $mainMenu->add_many(
        array(NULL, 'Fault Reporting', NULL),
        array('#', 'Report a Fault', 'wrench'),
        array('#', 'List Faults', 'list'),
        array(NULL, 'Inventory Management', NULL),
        array('#', 'Find Equipment', 'search'),
        array('#', 'Add Equipment', 'plus'),
        array(NULL, 'Equipment Bookings', NULL),
        array('#', 'Book Equipment', 'book'),
        array('#', 'Future Bookings', 'calendar'),
        array(NULL, 'External Hires', NULL),
        array('#', 'New Hire', 'share-alt'),
        array('#', 'Future Bookings', 'calendar'),
        array('#', 'Manage Invoices', 'shopping-cart')
        );

      $navBarMenu = new Menu();
      $navBarMenu->add_many(
        array('#', 'Profile', 'cog'),
        array(NULL, NULL, NULL),
        array('#', 'Sign Out', 'remove')
        );

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
              <i class="icon-user"></i> Hi '.$GLOBALS['user']['nick'].'
              <span class="caret"></span>
            </a>'.$navBarMenu->output('',7,'dropdown-menu').'
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">'.$mainMenu->output('',6).'
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
</html>';
      return $return;
    } else {
		  return $content;
    }
	}
}
?>