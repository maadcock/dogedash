<?php 
    ob_start();
    include("http://coinbase.com/api/v1/prices/spot_rate");
    $Coinbase = ob_get_contents();
    ob_end_clean();

    $string=($Coinbase);
    $json_coinbase=json_decode($string,true);

    $formBTCPrice = number_format((float) $json_coinbase['amount'], 2, ".", ",");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>VertDash</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php include 'http://www.dogedash.io/analytics.html' ?>

</head>

<body id="page-top" class="index">

    <?php include 'nav.php' ?>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="../img/profile_vtc.png" alt="">
                    <div class="intro-text">
                        <span class="name">VertDash</span>
                        <hr class="star-light">
                        <form class="form-horizontal" method="get" action="dash.php">
                <fieldset>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Please enter your Vertcoin address to begin."><br />
                        </div>
						<div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
						</div>
                    </div>
                </fieldset>
            </form>
            <p>If you just want to know the value of a certain amount, use the buttons below.</p>
            <a href="amount.php?amount=1" class="btn btn-primary">ᗐ1</a> <a href="amount.php?amount=10" class="btn btn-primary">ᗐ10</a> <a href="amount.php?amount=100" class="btn btn-primary">ᗐ100</a> <a href="amount.php?amount=1000" class="btn btn-primary">ᗐ1,000</a> <a href="amount.php?amount=10000" class="btn btn-primary">ᗐ10,000</a> <a href="amount.php?amount=100000" class="btn btn-primary">ᗐ100,000</a> <a href="amount.php?amount=1000000" class="btn btn-primary">ᗐ1,000,000</a><br /><br />
            <form class="form-horizontal" method="get" action="amount.php">
                <fieldset>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Alternatively, enter a custom Vert amount to view its value."><br />
                        </div>
						<div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
						</div>
                    </div>
                </fieldset>
            </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>
                        VertDash allows you have to have all your important Vertcoin information in one place. View your current wallet balance, value at current market values, and other information.
                    </p>
                </div>
                <div class="col-lg-4">
                    <p>
                        VertDash uses the <a href="https://explorer.vertcoin.org/chains">Vertcoin Explorer</a> API to pull wallet related information, and currently uses the <a href="http://www.bter.com/">Bter</a>, <a href="http://www.mintpal.com/">Mintpal</a>, <a href="http://www.vircurex.com/">Vircurex</a> and <a href="http://www.coinbase.com/">Coinbase</a> APIs for market values.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <!--
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-12">
                        <h3>Around the Web</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        -->
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; VertDash 2014
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="../js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="../js/classie.js"></script>
    <script src="../js/cbpAnimatedHeader.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/freelancer.js"></script>

</body>

</html>
