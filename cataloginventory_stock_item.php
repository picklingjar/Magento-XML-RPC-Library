<?php
/*
Copyright (c) 2011, The Pickling Jar Ltd <code@thepicklingjar.com>

Permission to use, copy, modify, and/or distribute this software for any
purpose with or without fee is hereby granted, provided that the above
copyright notice and this permission notice appear in all copies.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
*/


//TODO
//cataloginventory_stock_item.list - Retrieve stock data by product ids
//cataloginventory_stock_item.update


function magento_cataloginventory_stock_item_list($xmlrpcurl, $sessionkey, $sku, $proxyipport = ""){
	global $globalerr;
	global $GLOBALS;
	$GLOBALS['xmlrpc_null_extension']=true;
	$client = new xmlrpc_client($xmlrpcurl);
	$client->setSSLVerifyPeer(false);
	$params[] = new xmlrpcval($sessionkey); //sessionkey
	$params[] = new xmlrpcval("cataloginventory_stock_item.list"); //array of attributes values
	$params[] = new xmlrpcval($sku, "string"); //sessionkey

	$msg = new xmlrpcmsg("call",$params);
	if($proxyipport != ""){
		$proxy = explode(":",$proxyipport);
		$proxyip = $proxy[0];
		$proxyport = $proxy[1];
		$client->setProxy($proxyip, $proxyport);
	}
	$r = $client->send($msg);
	if($r === false){
		$globalerr = "XMLRPC ERROR - Could not send xmlrpc message";
		return(false);
	}
	if (!$r ->faultCode()) {
		return(php_xmlrpc_decode($r->value())); //product id
	}
	else {
		//print_r($r);
		$globalerr = "XMLRPC ERROR - Code: " . htmlspecialchars($r->faultCode()) . " Reason: '" . htmlspecialchars($r->faultString()). "'";
	}
	return(false);
}


function magento_cataloginventory_stock_item_update($xmlrpcurl, $sessionkey, $sku, $qty, $isinstock = 1,$proxyipport = ""){
	global $globalerr;
	global $GLOBALS;
	$GLOBALS['xmlrpc_null_extension']=true;
	$client = new xmlrpc_client($xmlrpcurl);
	$client->setSSLVerifyPeer(false);
	$params[] = new xmlrpcval($sessionkey); //sessionkey
	$params[] = new xmlrpcval("cataloginventory_stock_item.update"); //array of attributes values
        $params[] = new xmlrpcval(
                array(
                        new xmlrpcval($sku, "string"),
                        new xmlrpcval(array(
                                        "qty" => new xmlrpcval($qty, "int"),
                                        "is_in_stock" => new xmlrpcval("1", "boolean")
                                ), "struct"
                        )
                ),
                "array");

	$msg = new xmlrpcmsg("call",$params);
	if($proxyipport != ""){
		$proxy = explode(":",$proxyipport);
		$proxyip = $proxy[0];
		$proxyport = $proxy[1];
		$client->setProxy($proxyip, $proxyport);
	}
	$r = $client->send($msg);
	if($r === false){
		$globalerr = "XMLRPC ERROR - Could not send xmlrpc message";
		return(false);
	}
	if (!$r ->faultCode()) {
		return(php_xmlrpc_decode($r->value())); //product id
	}
	else {
		//print_r($r);
		$globalerr = "XMLRPC ERROR - Code: " . htmlspecialchars($r->faultCode()) . " Reason: '" . htmlspecialchars($r->faultString()). "'";
	}
	return(false);
}
?>
