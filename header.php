<!DOCTYPE html>
<html lang="en" id="theHTML">
	<head>
  	<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
		<script src="https://use.fontawesome.com/75360aa574.js"></script>

  	<title>Matt Rothaus - Scientist</title>

		<style>

			html{
				background-size: cover;
				-o-background-size: cover;
				-moz-background-size: cover;
				-webkit-background-size: cover;
				background-position: 100% 0%;
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-image: url('http://www.mr-ecology.com/wp-content/uploads/2017/09/background.jpg');
			}

			#header {
				overflow: hidden;
				background-size: cover;
				-o-background-size: cover;
				-moz-background-size: cover;
				-webkit-background-size: cover;
				background-position: 100% 0%;
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-image: url('http://www.mr-ecology.com/wp-content/uploads/2017/09/background.jpg');
				transition: all .3s linear;
			}

            #header-background-screen {
                background-color: #159632;
                background-color: rgba(0, 168, 38, .75);
		        background-blend-mode: color-burn;
				background-position: 100% 0%;
				background-repeat: no-repeat;
				background-attachment: fixed;
                width: 100%;
                height: 100%;
                pointer-events: none;
                z-index: 0;
				transition: opacity .3s linear;
            }

           #header-content-holder {
                position: fixed;
                top: 0;
                right: 1em;
                z-index: 50;
            }

			#background-screen {
				position: fixed;
				width: 100vw;
				height: 100vh;
				background-color: rgba(255, 255, 255, .8);
				background-blend-mode: screen;
				z-index: 1;
				pointer-events: none;
			}

			#background-screen::before{
				content: '';
				position: fixed;
				top: -10em;
				right: -2em;
				width: 100%;
				height: 100em;
				background: -webkit-linear-gradient(left, transparent 20%, rgba(21, 150, 50, 1));
				background: -o-linear-gradient(left, transparent 20%, rgba(21, 150, 50, 1));
				background: -moz-linear-gradient(left, transparent 20%, rgba(21, 150, 50, 1));
				background: linear-gradient(to right, transparent 20%, rgba(21, 150, 50, 1));
				pointer-events: none;
				opacity: 1;
				transition: opacity .4s linear;
				transform: rotate(5deg);
				background-blend-mode: color-burn;
				z-index: 2;
				pointer-events: none;
			}

		</style>

	</head>
	<body <?php body_class();?> id="theBody">

		<header id="header">
          <div id="header-background-screen"></div>
          <div id="header-content-holder">
			<div id="menu-button">
				<div></div>
				<div></div>
				<div></div>
			</div>
			<div id="avatar">
				<?php echo get_avatar(get_the_author_meta('ID')); ?>
			</div>
			<h1 id ="author-name">
				<?php
				$f_name = get_the_author_meta('first_name');
				$l_name = get_the_author_meta('last_name');

				echo $f_name . ' ' . $l_name;
				?>
			</h1>
			<div id="floaty-leaf"></div>
			<nav id="navbar">
				<?php wp_nav_menu(array('theme_location' => 'primary')); ?>
			</nav>
          </div>
		</header>
		<div id="background-screen"></div>
		<div id="header-border"></div>
		<div id="wrapper">
			<main id="main">