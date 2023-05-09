<?php 
    if (isset($_GET["address"]) && !empty($_GET["address"])) {
        
        /* Initial pull of json data from APIs */

        ob_start();
        include("http://data.bter.com/api/1/ticker/LTC_BTC");
        $Bter = ob_get_contents();
        ob_end_clean();

        ob_start();
        include("http://coinbase.com/api/v1/prices/spot_rate");
        $Coinbase = ob_get_contents();
        ob_end_clean();

        ob_start();
        include("https://api.mintpal.com/v1/market/stats/LTC/BTC");
        $MintPal = ob_get_contents();
        ob_end_clean();

        ob_start();
        include("http://pubapi.cryptsy.com/api.php?method=singlemarketdata&marketid=3");
        $Cryptsy = ob_get_contents();
        ob_end_clean();

        ob_start();
        include("https://api.vircurex.com/api/get_last_trade.json?base=LTC&alt=BTC");
        $Virc = ob_get_contents();
        ob_end_clean();

        /* Converting json to strings to pull data */

        $string=($Bter);
        $json_a=json_decode($string,true); 

        $string=($Coinbase);
        $json_b=json_decode($string,true); 

        $string=($Virc);
        $json_c=json_decode($string,true);

        $string=($MintPal);
        $json_d=json_decode($string,true);

        $string=($Cryptsy);
        $json_e=json_decode($string,true);

        $address = $_GET["address"];

        /* Pulls account balance from DogeChain */

        ob_start();
        include("https://chain.so/api/v2/get_address_balance/LTC/$address/3");
        $sochain_json = (float) ob_get_contents();
        $sochain = json_decode($sochain_json, true);
        $amount = $sochain["data"]["confirmed_balance"];
        ob_end_clean();

        /* Bter Math */

        $dogePriceBter = $json_a['last'] * $json_b['amount']; // DOGE to USD using Bter and Coinbase API
        $satoshiBter = $json_a['last'] * 100000000; // Last Bter DOGE/BTC trade times 100000000
        $finalBter = $amount * $dogePriceBter; // Final value is determined by multiplying account balance by Bter DOGE Price
        $formDogePriceBter = number_format((float) $dogePriceBter, 6, ".", ","); // Formatting appearance of $dogePriceBter
        $formSatoshiBter = number_format((float) $satoshiBter, 0, ".", ","); // Formatting appearance of $satoshiBter
        $formFinalBter = number_format((float) $finalBter, 2, ".", ","); // Formatting apperance of $finalBter

        /* MintPal Math */

        $dogePriceMint = $json_d[0]['last_price'] * $json_b['amount']; // DOGE to USD using MintPal and Coinbase API
        $satoshiMint = $json_d[0]['last_price'] * 100000000; // Last MintPal DOGE/BTC trade times 100000000
        $finalMint = $amount * $dogePriceMint; // Final value is determined by multiplying account balance by Mint DOGE Price
        $formDogePriceMint = number_format((float) $dogePriceMint, 6, ".", ","); // Formatting appearance of $dogePriceMint
        $formSatoshiMint = number_format((float) $satoshiMint, 0, ".", ","); // Formatting appearance of $satoshiMint
        $formFinalMint = number_format((float) $finalMint, 2, ".", ","); // Formatting apperance of $finalMint

        /* Vircurex Math */

        $dogePriceVirc = $json_c['value'] * $json_b['amount']; // DOGE to USD using Vircurex and Coinbase API
        $satoshiVirc = $json_c['value'] * 100000000; // Last Bter DOGE/BTC trade times 100000000
        $finalVirc = $amount * $dogePriceVirc; // Final value is determined by multiplying account balance by Virc DOGE Price
        $formDogePriceVirc = number_format((float) $dogePriceVirc, 6, ".", ","); // Formatting appearance of $dogePriceVirc
        $formSatoshiVirc = number_format((float) $satoshiVirc, 0, ".", ","); // Formatting appearance of $satoshiVirc
        $formFinalVirc = number_format((float) $finalVirc, 2, ".", ","); // Formatting apperance of $finalVirc

        /* Cryptsy Average Math */

        $cP1 = $json_e["return"]["markets"]["LTC"]["recenttrades"]["0"]["price"]; // This and the following lines pull the 10 most recent buy/sell orders on Cryptsy
        $cP2 = $json_e["return"]["markets"]["LTC"]["recenttrades"]["1"]["price"];
        $cP3 = $json_e["return"]["markets"]["LTC"]["recenttrades"]["2"]["price"];
        $cP4 = $json_e["return"]["markets"]["LTC"]["recenttrades"]["3"]["price"];
        $cP5 = $json_e["return"]["markets"]["LTC"]["recenttrades"]["4"]["price"];
        $cP6 = $json_e["return"]["markets"]["LTC"]["recenttrades"]["5"]["price"];
        $cP7 = $json_e["return"]["markets"]["LTC"]["recenttrades"]["6"]["price"];
        $cP8 = $json_e["return"]["markets"]["LTC"]["recenttrades"]["7"]["price"];
        $cP9 = $json_e["return"]["markets"]["LTC"]["recenttrades"]["8"]["price"];
        $cP10 = $json_e["return"]["markets"]["LTC"]["recenttrades"]["9"]["price"];
        $satoshiCryptsyUnrounded = (($cP1 + $cP2 + $cP3 + $cP4 + $cP5 + $cP6 + $cP7 + $cP8 + $cP9 + $cP10) / 10) * 100000000; // Calculates the average of the 10 most recent orders and converts to satoshi
        $satoshiCryptsy = floor($satoshiCryptsyUnrounded); // Rounds down a satoshi because the average above sometimes results in a fraction of a satoshi

        /* Cryptsy Math */

        $dogePriceCryptsy = ($satoshiCryptsy / 100000000) * $json_b['amount']; // DOGE to USD using Cryptsy and Coinbase API
        $finalCryptsy = $amount * $dogePriceCryptsy; // Final value is determined by multiplying account balance by Cryptsy DOGE Price
        $formDogePriceCryptsy = number_format((float) $dogePriceCryptsy, 6, ".", ","); // Formatting appearance of $dogePriceCryptsy
        $formSatoshiCryptsy = number_format((float) $satoshiCryptsy, 0, ".", ","); // Formatting appearance of $satoshiCryptsy
        $formFinalCryptsy = number_format((float) $finalCryptsy, 2, ".", ","); // Formatting apperance of $finalCryptsy

        /* Other Math */

        $formAmount = number_format((float) $amount, 0, ".", ",");
        $formBTCPrice = number_format((float) $json_b['amount'], 2, ".", ",");
             
    } else {
        header("Location: index.php"); 
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LiteDash</title>

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
                    <div class="intro-text">
                        <span class="name-title">Current Balance</span><br />
                        <span class="name">&#321;<?php echo $formAmount ?></span>
                        <hr class="star-light">
                        <span class="skills" style="font-size:1em;"><?php echo $address ?></span>
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
                    <h2>USD Values</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12"><div class="row">

                    <!-- Preparing for multiple market values -->
                    <div class="col-sm-3 text-center">
                    <strong><font size="3">Bter Value</font></strong><br />
                    <font size="7"><strong>$<?php echo $formFinalBter ?></strong></font><br />
                    LTC Price: $<?php echo $formDogePriceBter ?></font>
                    </div>
                    <div class="col-sm-3 text-center">
                    <strong><font size="3">Cryptsy Value</font></strong><br />
                    <font size="7"><strong>$<?php echo $formFinalCryptsy ?></strong></font><br />
                    LTC Price: $<?php echo $formDogePriceCryptsy ?></font>
                    </div>
                    <div class="col-sm-3 text-center">
                    <strong><font size="3">MintPal Value</font></strong><br />
                    <font size="7"><strong>$<?php echo $formFinalMint ?></strong></font><br />
                    LTC Price: $<?php echo $formDogePriceMint ?></font>
                    </div>
                    <div class="col-sm-3 text-center">
                    <strong><font size="3">Vircurex Value</font></strong><br />
                    <font size="7"><strong>$<?php echo $formFinalVirc ?></strong></font><br />
                    LTC Price: $<?php echo $formDogePriceVirc ?></font>
                    </div>
                    </div>
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
                        Copyright &copy; LiteDash 2014
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

    <!-- Contact Form JavaScript -->
    <script src="../js/jqBootstrapValidation.js"></script>
    <script src="../js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/freelancer.js"></script>

</body>

</html>
