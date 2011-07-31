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
//catalog_product_link.update - Update product link
//catalog_product_link.attributes

function magento_catalog_product_link_types($xmlrpcurl, $sessionkey, $proxyipport = ""){
	global $globalerr;
	global $GLOBALS;
	$GLOBALS['xmlrpc_null_extension']=true;
	$client = new xmlrpc_client($xmlrpcurl);
	$client->setSSLVerifyPeer(false);
	$params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
	$params[] = new xmlrpcval("catalog_product_link.types","string"); //array of attributes values
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
		$globalerr = "XMLRPC ERROR - Code: " . htmlspecialchars($r->faultCode()) . " Reason: '" . htmlspecialchars($r->faultString()). "'";
	}
	return(false);
}

function magento_catalog_product_link_list($xmlrpcurl, $sessionkey, $type = "related", $sku, $proxyipport = ""){
	global $globalerr;
	global $GLOBALS;
	$GLOBALS['xmlrpc_null_extension']=true;
	$client = new xmlrpc_client($xmlrpcurl);
	$client->setSSLVerifyPeer(false);
	$params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
	$params[] = new xmlrpcval("catalog_product_link.list","string"); //array of attributes values
	$params[] = new xmlrpcval(
		array(
			new xmlrpcval($type, "string"),
			new xmlrpcval($sku, "string")
		), "array"
	);
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
		$globalerr = "XMLRPC ERROR - Code: " . htmlspecialchars($r->faultCode()) . " Reason: '" . htmlspecialchars($r->faultString()). "'";
	}
	return(false);
}

function magento_catalog_product_link_assign($xmlrpcurl, $sessionkey, $type = "related", $sku, $linkedsku, $proxyipport = ""){
	global $globalerr;
	global $GLOBALS;
	$GLOBALS['xmlrpc_null_extension']=true;
	$client = new xmlrpc_client($xmlrpcurl);
	$client->setSSLVerifyPeer(false);

	if(is_array($linkedsku)){
		foreach($linkedsku as $l){
			if(isset($params)) unset($params);
			$params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
			$params[] = new xmlrpcval("catalog_product_link.assign","string"); //array of attributes values
			$params[] = new xmlrpcval(
				array(
					new xmlrpcval($type, "string"),
					new xmlrpcval($sku, "string"),
					new xmlrpcval($l, "string")
				), "array"
			);
			$msg[] = new xmlrpcmsg("call",$params);
		}
	}
	else {
		$params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
		$params[] = new xmlrpcval("catalog_product_link.assign","string"); //array of attributes values
		$params[] = new xmlrpcval(
			array(
				new xmlrpcval($type, "string"),
				new xmlrpcval($sku, "string"),
				new xmlrpcval($linkedsku, "string")
			), "array"
		);
		$msg = new xmlrpcmsg("call",$params);
	}
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
	if(!is_array($linkedsku)){
		if (!$r ->faultCode()) {
			return(php_xmlrpc_decode($r->value())); //product id
		}
		else {
			$globalerr = "XMLRPC ERROR - Code: " . htmlspecialchars($r->faultCode()) . " Reason: '" . htmlspecialchars($r->faultString()). "'";
		}
	}
	else {
		$globalerr = "";
		foreach($r as $res){
			if(!$res->faultCode()){
				$resval[] = php_xmlrpc_decode($res->value());
			}
			else {
				$globalerr .= "XMLRPC ERROR - Code: " . htmlspecialchars($res->faultCode()) . " Reason: '" . htmlspecialchars($res->faultString()). "'\n";
			}
		}
		if(count($resval) == count($r)){
			return($resval);
		}
		return(false);
	}
	return(false);
}

function magento_catalog_product_link_remove($xmlrpcurl, $sessionkey, $type = "related", $sku, $linkedsku, $proxyipport = ""){
	global $globalerr;
	global $GLOBALS;
	$GLOBALS['xmlrpc_null_extension']=true;
	$client = new xmlrpc_client($xmlrpcurl);
	$client->setSSLVerifyPeer(false);

	if(is_array($linkedsku)){
		foreach($linkedsku as $l){
			if(isset($params)) unset($params);
			$params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
			$params[] = new xmlrpcval("catalog_product_link.remove","string"); //array of attributes values
			$params[] = new xmlrpcval(
				array(
					new xmlrpcval($type, "string"),
					new xmlrpcval($sku, "string"),
					new xmlrpcval($l, "string")
				), "array"
			);
			$msg[] = new xmlrpcmsg("call",$params);
		}
	}
	else {
		$params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
		$params[] = new xmlrpcval("catalog_product_link.remove","string"); //array of attributes values
		$params[] = new xmlrpcval(
			array(
				new xmlrpcval($type, "string"),
				new xmlrpcval($sku, "string"),
				new xmlrpcval($linkedsku, "string")
			), "array"
		);
		$msg = new xmlrpcmsg("call",$params);
	}
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
	if(!is_array($linkedsku)){
		if (!$r ->faultCode()) {
			return(php_xmlrpc_decode($r->value())); //product id
		}
		else {
			$globalerr = "XMLRPC ERROR - Code: " . htmlspecialchars($r->faultCode()) . " Reason: '" . htmlspecialchars($r->faultString()). "'";
		}
	}
	else {
		$globalerr = "";
		foreach($r as $res){
			if(!$res->faultCode()){
				$resval[] = php_xmlrpc_decode($res->value());
			}
			else {
				$globalerr .= "XMLRPC ERROR - Code: " . htmlspecialchars($res->faultCode()) . " Reason: '" . htmlspecialchars($res->faultString()). "'\n";
			}
		}
		if(count($resval) == count($r)){
			return($resval);
		}
		return(false);
	}
	return(false);
}
?>
