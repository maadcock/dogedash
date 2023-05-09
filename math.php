    /* Manual Amount Input */
    $manualAmount = $_GET["manualAmount"];

    /* Bter Math */

    $dogePriceBter = $json_a['last'] * $manualAmount; // DOGE to USD using Bter and Coinbase API
    $satoshiBter = $json_a['last'] * 100000000; // Last Bter DOGE/BTC trade times 100000000
    $finalBter = $manualAmount * $dogePriceBter; // Final value is determined by multiplying account balance by Bter DOGE Price
    $formDogePriceBter = number_format((float) $dogePriceBter, 6, ".", ","); // Formatting appearance of $dogePriceBter
    $formSatoshiBter = number_format((float) $satoshiBter, 0, ".", ","); // Formatting appearance of $satoshiBter
    $formFinalBter = number_format((float) $finalBter, 2, ".", ","); // Formatting apperance of $finalBter

    /* MintPal Math */

    $dogePriceMint = $json_d[0]['last_price'] * $manualAmount; // DOGE to USD using MintPal and Coinbase API
    $satoshiMint = $json_d[0]['last_price'] * 100000000; // Last MintPal DOGE/BTC trade times 100000000
    $finalMint = $manualAmount * $dogePriceMint; // Final value is determined by multiplying account balance by Mint DOGE Price
    $formDogePriceMint = number_format((float) $dogePriceMint, 6, ".", ","); // Formatting appearance of $dogePriceMint
    $formSatoshiMint = number_format((float) $satoshiMint, 0, ".", ","); // Formatting appearance of $satoshiMint
    $formFinalMint = number_format((float) $finalMint, 2, ".", ","); // Formatting apperance of $finalMint

    /* Vircurex Math */

    $dogePriceVirc = $json_c['value'] * $manualAmount; // DOGE to USD using Vircurex and Coinbase API
    $satoshiVirc = $json_c['value'] * 100000000; // Last Bter DOGE/BTC trade times 100000000
    $finalVirc = $manualAmount * $dogePriceVirc; // Final value is determined by multiplying account balance by Virc DOGE Price
    $formDogePriceVirc = number_format((float) $dogePriceVirc, 6, ".", ","); // Formatting appearance of $dogePriceVirc
    $formSatoshiVirc = number_format((float) $satoshiVirc, 0, ".", ","); // Formatting appearance of $satoshiVirc
    $formFinalVirc = number_format((float) $finalVirc, 2, ".", ","); // Formatting apperance of $finalVirc

    /* Cryptsy Average Math */

    $cP1 = $json_e["return"]["markets"]["DOGE"]["recenttrades"]["0"]["price"]; // This and the following lines pull the 10 most recent buy/sell orders on Cryptsy
    $cP2 = $json_e["return"]["markets"]["DOGE"]["recenttrades"]["1"]["price"];
    $cP3 = $json_e["return"]["markets"]["DOGE"]["recenttrades"]["2"]["price"];
    $cP4 = $json_e["return"]["markets"]["DOGE"]["recenttrades"]["3"]["price"];
    $cP5 = $json_e["return"]["markets"]["DOGE"]["recenttrades"]["4"]["price"];
    $cP6 = $json_e["return"]["markets"]["DOGE"]["recenttrades"]["5"]["price"];
    $cP7 = $json_e["return"]["markets"]["DOGE"]["recenttrades"]["6"]["price"];
    $cP8 = $json_e["return"]["markets"]["DOGE"]["recenttrades"]["7"]["price"];
    $cP9 = $json_e["return"]["markets"]["DOGE"]["recenttrades"]["8"]["price"];
    $cP10 = $json_e["return"]["markets"]["DOGE"]["recenttrades"]["9"]["price"];
    $satoshiCryptsyUnrounded = (($cP1 + $cP2 + $cP3 + $cP4 + $cP5 + $cP6 + $cP7 + $cP8 + $cP9 + $cP10) / 10) * 100000000; // Calculates the average of the 10 most recent orders and converts to satoshi
    $satoshiCryptsy = floor($satoshiCryptsyUnrounded); // Rounds down a satoshi because the average above sometimes results in a fraction of a satoshi

    /* Cryptsy Math */

    $dogePriceCryptsy = ($satoshiCryptsy / 100000000) * $manualAmount; // DOGE to USD using Cryptsy and Coinbase API
    $finalCryptsy = $manualAmount * $dogePriceCryptsy; // Final value is determined by multiplying account balance by Cryptsy DOGE Price
    $formDogePriceCryptsy = number_format((float) $dogePriceCryptsy, 6, ".", ","); // Formatting appearance of $dogePriceCryptsy
    $formSatoshiCryptsy = number_format((float) $satoshiCryptsy, 0, ".", ","); // Formatting appearance of $satoshiCryptsy
    $formFinalCryptsy = number_format((float) $finalCryptsy, 2, ".", ","); // Formatting apperance of $finalCryptsy

    /* Other Math */

    $formAmount = number_format((float) $manualAmount, 0, ".", ",");
    $formBTCPrice = number_format((float) $json_b['amount'], 2, ".", ",");
        
?>