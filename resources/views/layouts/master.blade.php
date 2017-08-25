<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Documentation - Bootflat</title>
    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- SmartAddon.com Verification -->
    <meta name="smartaddon-verification" content="936e8d43184bc47ef34e25e426c508fe"/>
    <meta name="keywords"
          content="Flat UI Design, UI design, UI, user interface, web interface design, user interface design, Flat web design, Bootstrap, Bootflat, Flat UI colors, colors">
    <meta name="description" content="The complete style of the Bootflat Framework.">
    <!-- site css -->
    <link rel="stylesheet" href="{{asset('css/my.css')}}">
    <link rel="stylesheet" href="{{asset('bootflat/css/site.min.css')}}">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic"
          rel="stylesheet" type="text/css">
    <!-- <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'> -->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src="{{asset('bootflat/css/js/html5shiv.js')}}"></script>
    <script src="{{asset('bootflat/js/respond.min.js')}}"></script>
    <![endif]-->
    <script type="text/javascript" src="{{asset('bootflat/js/site.min.js')}}"></script>
</head>
<body style="background-color: #f1f2f6;">
<div class="docs-header">
    <!--nav-->
    <nav class="navbar navbar-default navbar-custom" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('home')}}">
                    <img src="{{asset('bootflat/img/logo.png')}}" height="40">
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"> Category <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{route('vocabulary.index')}}">Index</a></li>
                            <li><a href="{{route('vocabulary.create')}}">Create</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"> Transaction <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{route('lesson.index')}}">Index</a></li>
                            <li><a href="{{route('lesson.create')}}">Create</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@yield('header')
<!--documents-->
</div>
<div class="container documents">
    @yield('content')
</div>
@yield('extra_js')
</body>
</html>