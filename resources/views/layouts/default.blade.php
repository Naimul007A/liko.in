<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@yield('meta')
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" href="/css/liko2.css" type="text/css" media="all">
</head>

<body class="posts">
<div id="page">
<header id="header">
	<div class="blog-top"><a class="blogtitle" href="/">Liko.In</a>
	<div class="description">Find a School near you</div>
	@yield('breadcrumb')
	@include('includes.linkad')
	</div>
</header>
<div id="content" class="narrowcolumn">
<main role="main">
<section>
<article id="post" class="post">
<div class="entry">
@include ('includes.topofpage1')
@yield('content')
</div>
</article>
</section>
</main>
</div>
<div id="sidebar">
<aside>
<div id="adbox">
<ul>
<li>
<div class="textwidget">
	<div class="searchform header-search">
	<form role="search" method="get" id="searchform" class="searchform" action="{{action('MainController@search')}}" method="GET">
	<label class="screen-reader-text" for="s">Search for:</label>
	<input type="text" placeholder="Search" value="" name="s" id="s" pattern=".{3,50}" required title="3 to 50 characters" />
	<button type="submit">Search</button>
	</form> 
	</div>
@include('includes.sidead')
</div>
</li>
</ul>
</div>
</aside>
</div>
<footer id="footer">
<p>
<a class="nav-link" rel="nofollow" href="/privacy">Privacy Policy</a> | <a class="nav-link" rel="nofollow" href="/terms-of-use">Terms of Use</a> | <a class="nav-link" rel="nofollow" href="/contact-us">Contact Us</a> | © 2017 Copyright Liko.In | {{ (microtime(true) - LARAVEL_START) }}
</p>
</footer>
</div>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> 
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-46057781-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-46057781-1');
</script>
</body> 
</html>