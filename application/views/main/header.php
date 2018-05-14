<html lang="en">
<head>
	<title>TRIUNE - <?php echo $title;?></title>

	<meta name="description" content="overview &amp; stats" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/fontawesome-free-5.0.8/web-fonts-with-css/css/fontawesome-all.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
	<!-- page specific plugin styles -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/stylesheets/triune.css" />
	<!-- basic scripts -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/jquery-3.3.1.min.js"></script>

	<script src="<?php echo base_url();?>assets/scripts/bootstrap.js"></script>
	<script src="<?php echo base_url();?>assets/scripts/triune.js"></script>
    
</head>
 
<body class="no-skin">

<nav class="navbar navbar-expand-sm navbar-custom">
    <a href="/" class="navbar-brand">TRIUNE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCustom">
        <i class="fa fa-bars fa-lg py-1 text-white"></i>
    </button>
    <div class="navbar-collapse collapse" id="navbarCustom">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" select-app="calendar" >Calendar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" select-app="messaging"  >Messaging</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"  id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Applications
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" select-app="humanResource">Human Resource</a>
                    <a class="dropdown-item" select-app="finance">Finance</a>
                    <a class="dropdown-item" select-app="registrar">Registrar</a>
                    <a class="dropdown-item" select-app="main/jobRequest">Job Request</a>
                </div>
            </li>
        </ul>
        <span class="ml-auto navbar-text"><?php echo $this->session->userName; ?></span>

    </div>
</nav>

<div class="content"> </div>
<div class="content1"> </div>
<div class="content2"> </div>
