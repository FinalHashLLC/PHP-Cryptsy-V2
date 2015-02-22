<?php

ini_set('max_execution_time', 1000);
$args = [];
$args["key"] = "key";
$args["secret"] = "secret";

require 'cryptsy.php';

$bot = new \FinalHashLLC\CryptsyAPIv2($args);

function maintenance_update($currency) {
    if($currency['maintenance'] == 0) {
        $currency['maintenance'] = "No Issues";
    }
    else if ($currency['maintenance'] == 1) {
        $currency['maintenance'] = "Maintenance";
    }
    else if ($currency['maintenance'] == 2) {
        $currency['maintenance'] = "Updating Wallet";
    }
    else if ($currency['maintenance'] == 3) {
        $currency['maintenance'] = "Network Issues";
    }
    return $currency;
}

function get_balance($balance, $key) {
    $available_balance = $balance['available'];
    $held_balance = $balance['held'];

    if(array_key_exists($key, $available_balance)) {
        $balance['available'] = $available_balance[$key];
    }
    else {
        $balance['available'] = 0;
    }

    if(array_key_exists($key, $held_balance)) {
        $balance['held'] = $held_balance[$key];
    }
    else {
        $balance['held'] = 0;
    }
    return $balance;
}
?>

<h1>User Methods</h1>
<ul>
        <?php
            $info = $bot->info();
            echo("<li> User ID:  " . $info['data']['id'] . "</li>" );
            echo("<li> UserName: " . $info['data']['username'] . "</li>" );
            echo("<li> Acc Type: " . $info['data']['accounttype'] . "</li>" );
            echo("<li> Email: " . $info['data']['email'] . "</li>" );
            echo("<li> Name: " . $info['data']['first_name'] . " " . $info['data']['last_name'] . "</li>" );
            echo("<li> TradeKey: " . $info['data']['trade_key'] . "</li>" );
        ?>
</ul>

<h1>Currencies</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Status</th>
        <th>Available Balance</th>
        <th>Held Balance</th>
    </tr>
    <?php
            $currencies = $bot->currencies()['data'];
            foreach($currencies as $currency) {
                $currency = maintenance_update($currency);
                $balance = $bot->balances($currency['id'])['data'];
                $balance = get_balance($balance, $currency['id']);
                echo("<tr>");
                    echo("<td>" . $currency['id'] . "</td>");
                    echo("<td>" . $currency['name'] . "</td>");
                    echo("<td>" . $currency['maintenance'] . "</td>");
                    echo("<td>" . $balance['available'] . "</td>");
                    echo("<td>" . $balance['held'] . "</td>");
                echo("</tr>");
            }
    ?>
</table>

<h1>Deposits</h1>
<table border="1">
        <tr>
            <th>Currency</th>
            <th>Time</th>
            <th>Address</th>
            <th>Amount</th>
            <th>TXID</th>
            <th>Status</th>
        </tr>
        <?php
        $deposits = $bot->deposits()['data'];
        foreach($deposits as $deposit) {
            $currency = $bot->currencies($deposit['currency'])['data'];
            echo("<tr>");
            echo("<td>" . $currency['name'] . "</td>");
            echo("<td>" . $deposit['datetime'] . "</td>");
            echo("<td>" . $deposit['address'] . "</td>");
            echo("<td>" . $deposit['amount'] . "</td>");
            echo("<td>" . $deposit['trxid'] . "</td>");
            echo("<td>" . $deposit['status'] . "</td>");
            echo("</tr>");
        }
        ?>
</table>

<h1>Withdrawals</h1>
<table border="1">
        <tr>
            <th>Currency</th>
            <th>Time</th>
            <th>Address</th>
            <th>Amount</th>
            <th>TXID</th>
            <th>Fee</th>
        </tr>
        <?php
        $withdrawals = $bot->withdrawals()['data'];
        foreach($withdrawals as $withdrawal) {
            $currency = $bot->currencies($withdrawal['currencyid'])['data'];
            echo("<tr>");
            echo("<td>" . $currency['name'] . "</td>");
            echo("<td>" . $withdrawal['datetime'] . "</td>");
            echo("<td>" . $withdrawal['address'] . "</td>");
            echo("<td>" . $withdrawal['amount'] . "</td>");
            echo("<td>" . $withdrawal['trxid'] . "</td>");
            echo("<td>" . $withdrawal['fee'] . "</td>");
            echo("</tr>");
        }
        ?>
</table>

<h1>Order Info</h1>
<pre>
    <?php
        $order = $bot->createOrder('DGC_BTC', 'BUY', '100', '0.00000010');
        echo("<p>" . print_r($order) . "</p>")
    ?>

</pre>
		// Order Methods
		public function createOrder($marketid, $ordertype, $quantity, $price);
		public function orderInfo($orderid);
		public function cancelOrder($orderid);
*/
