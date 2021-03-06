<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" dir="ltr">

<head>
<?php 
$title = menu_pagetitle();
$title[] = $this->config->item('site_name');
?>
	<title><?php echo implode(' - ', $title); ?></title>

	<link media="all" rel="stylesheet" type="text/css" href="/inc/css/jquery-ui/theme/ui.all.css"/>
	<link media="all" rel="stylesheet" type="text/css" href="/inc/css/site.css"/>
	
	
	<?php if($css){ ?>
	<link media="all" rel="stylesheet" type="text/css" href="<?php echo $css; ?>"/>
	<?php } ?>
	
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" /> 
	<script type="text/javascript" src="/inc/js/jquery.js"></script>
	<script type="text/javascript" src="/inc/js/jquery.pause.js"></script>
	<script type="text/javascript" src="/inc/js/jquery-ui.js"></script>
	<script type="text/javascript" src="/inc/js/site.js"></script>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<?php
	if(!empty($feedurl)){
		echo '<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="'.$feedurl.'" />';
	}
	if(isset($reqkey)){ echo "\n\t" . '<script type="text/javascript">var reqk="'.$reqkey.'";</script>'; }
	if(isset($seckey)){ echo "\n\t" . '<script type="text/javascript">var seck="'.$seckey.'";</script>'; }
	?>
</head>
<body id="page-<?php echo menu_get_current_area(); ?>">

<div id="hd">
    <div class="container_12 top">
    	<div class="grid_12">
    		<div class="usr">
    			<div class="wrapper">
        		<?php if (user_is_auth()): ?>
        			Logged in as <strong><a href="/user/view/<?php echo user_get_id(); ?>"><?php echo escape(user_get_username()); ?></a></strong> | 
        			<a href="/user/main">Account</a> | 
        			<a href="/user/logout">Logout</a>
        		<?php else: ?>
        			<a href="/user/login">Login</a> or <a href="/user/register">Register</a>
        		<?php endif; ?>
    			</div>
    			<div class="clear"></div>
    		</div>
    	</div>
    	<div class="clear"></div>
    </div>

    <div class="container_12 nav">
    	<div class="grid_3 logo">
    		<a href="/"><img src="/inc/img/logo.gif" border="0" alt="<?php echo $this->config->item('site_name'); ?> Logo"/></a>
    	</div>
    	<div class="grid_6 menu">
    		<ul>
				<li id="menu-event"><a href="/event">Events</a>
				<li id="menu-talk"><a href="/talk">Talks</a>
				<!--<li id="menu-search"><a href="/search">Search</a>-->
				<li id="menu-about" class="sep"><a href="/about">About</a>
				<li id="menu-help"><a href="/help">Help</a>
				<li id="menu-blog"><a href="/blog">Blog</a>
    		</ul>
    		<div class="clear"></div>
    	</div>
    	<div class="grid_3 search">
    		<form id="top-search" method="post" action="/search">
    			<label id="top-search-label" accesskey="2" for="top-search-input">Search <?php echo $this->config->item('site_name'); ?>...</label>
    			<input type="text" value="" id="top-search-input" name="search_term"/>
    			<input type="image" alt="Search" src="/inc/img/top-search-submit.gif" id="top-search-submit"/>
    		</form>
    		<div class="clear"></div>
    	</div>
    	<div class="clear"></div>
    </div>
</div>

<?php if (menu_get_current_area() == 'home'): ?>

<div id="splash">
    <div class="container_12">
    	<div class="grid_12">
			<?php if(!$this->session->userdata('ID')): ?>
    		<a href="/user/register"><img src="/inc/img/splash.jpg" border="0" alt="Join <?php echo $this->config->item('site_name'); ?> now!"/></a>
			<?php endif; ?>
    	</div>
    	<div class="clear"></div>
	</div>
</div>
<?php endif; ?>

<div id="ctn">
    <div class="container_12 container">
        <div class="grid_8">
			<div class="main">
			    <?php if(isset($info_block)){ echo $info_block; } ?>
                <?php echo $content?>
            </div>
        </div>
    	<div class="grid_4">
        	<div class="sidebar">
        	<?php foreach (menu_sidebar() as $box): ?>
        		<div class="box<?php if (!empty($box['class'])): ?> <?php echo $box['class']; ?><?php endif; ?>">
        		<?php if (!empty($box['title'])): ?>
                	<h4><?php echo $box['title']; ?></h4>
                <?php endif; ?>
                	<div class="ctn">
                	    <?php echo $box['content']; ?>
                	</div>
                </div>
        	<?php endforeach; ?>
            <?php if (!user_is_auth()): ?>
            	<div class="box">
                	<h4>Sign in</h4>
                	<div class="ctn">
                	
                    	<?php echo form_open('user/login', array('class' => 'form-login')); ?>
    
                        <div class="row">
                        	<label for="sidebar_user">Username</label>
                        	<?php echo form_input(array('name' => 'user', 'id' => 'sidebar_user')); ?>
                        
                            <div class="clear"></div>
                        </div>
                        
                        <div class="row">
                        	<label for="sidebar_pass">Password</label>
                        	<?php echo form_input(array('name' => 'pass', 'id' => 'sidebar_pass', 'type' => 'password')); ?>
                        
                            <div class="clear"></div>
                        </div>
                        
                        <div class="row row-buttons">
                        	<?php echo form_submit(array('name' => 'sub', 'class' => 'btn'), 'Login'); ?> 
                        	<!-- <a style="margin-left:10px" href="/user">Forgot your password?</a> -->
                        </div>
                        
                        <?php echo form_close(); ?>

    					<p>
							<small>Need an account? <a href="/user/register">Register now!</a></small><br/>
							<small><a href="/user/forgot">Forgot Password</a></small>
						</p>
            		</div>
            	</div>
            	<?php endif; ?>
            	<div class="box">
                	<h4>Submit your event</h4>
                	<div class="ctn">
                    	<p>
                    		Know of an event happening? Let us know! We love to get the word out about events the community would be interested in and you can help us spread the word!
                    	</p>
    					<p style="text-align:center">
                    		<a href="/event/submit" class="btn-big">Submit your event!</a>
                    	</p>
                	</div>

            	</div>
				<?php echo $sidebar3?>
				<?php echo $sidebar2?>
            </div>
    	</div>
    	<div class="clear"></div>
	</div>
</div>

<div id="ftr">
    <div class="container_12">
    	<div class="grid_6">
        	<a href="/event">Events</a> | 
        	<a href="/talk">Talks</a> | 
        	<a href="/search">Search</a> | 
        	<a href="/about">About</a> | 
			<a href="/help">Help</a> | 
        	<a href="/blog">Blog</a> | 
			<a href="/api">API</a> |
        	<a href="/about/contact">Contact</a>
    	</div>
    	<div class="grid_6 rgt">
    		&copy; <?php echo $this->config->item('site_name'); ?> <?php echo date('Y')?>
    	</div>
    	<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-246789-3");
pageTracker._trackPageview();
</script>

</body>
</html>
