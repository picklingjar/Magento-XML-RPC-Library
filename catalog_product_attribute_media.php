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
//catalog_product_attribute_media.currentStore - Set/Get current store view
//catalog_product_attribute_media.list - Retrieve product image list
//catalog_product_attribute_media.info - Retrieve product image
//catalog_product_attribute_media.types - Retrieve product image types
//catalog_product_attribute_media.create - Upload new product image
//catalog_product_attribute_media.update - Update product image
//catalog_product_attribute_media.remove - Remove product image

function magento_catalog_product_attribute_media_create($xmlrpcurl, $sessionkey, $sku, $base64, $mime = "image/jpeg", $label = "", $position = "", $exclude = "0", $types = "", $storeid = "0", $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_product_attribute_media.create","string"); //array of attributes values
        if($types == "" || $types == "all"){
	        $params[] = new xmlrpcval(
        	        array(
                	        new xmlrpcval($sku, "string"),
                        	new xmlrpcval(array(
                                        "file" => new xmlrpcval(array(
                                                "content" => new xmlrpcval($base64, "base64"),
						"mime" => new xmlrpcval($mime, "string")
                                                ),
                                                "struct"
                                        ),
					"label"    => new xmlrpcval($label, "string"),
					"position" => new xmlrpcval($position, "int"),
                                        "types"    => new xmlrpcval(array(
                                                new xmlrpcval("small_image","string"),
						new xmlrpcval("thumbnail", "string"),
						new xmlrpcval("image", "string"),
                                                ),"struct"),
					"exclude"  => new xmlrpcval($exclude, "int")
                                ), "struct"
                        ),
                        new xmlrpcval($storeid, "int")
                ),
                "array");
        }
        else {
	        $params[] = new xmlrpcval(
        	        array(
                	        new xmlrpcval($sku, "string"),
                        	new xmlrpcval(array(
                                        "file" => new xmlrpcval(array(
                                                "content" => new xmlrpcval($base64, "base64"),
						"mime" => new xmlrpcval($mime, "string")
                                                ),
                                                "struct"
                                        ),
					"label"    => new xmlrpcval($label, "string"),
					"position" => new xmlrpcval($position, "int"),
                                        "types"    => new xmlrpcval(array(
						new xmlrpcval($types, "string")
                                                ),"struct"),
					"exclude"  => new xmlrpcval($exclude, "int")
                                ), "struct"
                        ),
                        new xmlrpcval($storeid, "int")
                ),
                "array");
        }
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

function magento_catalog_product_attribute_media_current_store($xmlrpcurl, $sessionkey, $storeid = "0", $proxyipport = ""){
	global $globalerr;
	global $GLOBALS;
	$GLOBALS['xmlrpc_null_extension']=true;
	$client = new xmlrpc_client($xmlrpcurl);
	$client->setSSLVerifyPeer(false);
	//$client->setDebug(2);
	$params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
	$params[] = new xmlrpcval("catalog_product_attribute_media.currentStore","string"); //array of attributes values
	$params[] = new xmlrpcval(
                array(
                        new xmlrpcval($storeid, "int")
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

function magento_catalog_product_attribute_media_list($xmlrpcurl, $sessionkey, $sku, $storeid = "0", $proxyipport = ""){
	global $globalerr;
	global $GLOBALS;
	$GLOBALS['xmlrpc_null_extension']=true;
	$client = new xmlrpc_client($xmlrpcurl);
	$client->setSSLVerifyPeer(false);
	//$client->setDebug(2);
	$params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
	$params[] = new xmlrpcval("catalog_product_attribute_media.list","string"); //array of attributes values
	$params[] = new xmlrpcval(
                array(
                        new xmlrpcval($sku, "string"),
                        new xmlrpcval($storeid, "int")
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

function magento_catalog_product_attribute_media_info($xmlrpcurl, $sessionkey, $sku, $filename, $storeid = "0", $proxyipport = ""){
	global $globalerr;
	global $GLOBALS;
	$GLOBALS['xmlrpc_null_extension']=true;
	$client = new xmlrpc_client($xmlrpcurl);
	$client->setSSLVerifyPeer(false);
	//$client->setDebug(2);
	$params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
	$params[] = new xmlrpcval("catalog_product_attribute_media.info","string"); //array of attributes values
	$params[] = new xmlrpcval(
                array(
                        new xmlrpcval($sku, "string"),
                        new xmlrpcval($filename, "string"),
                        new xmlrpcval($storeid, "int")
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

function magento_catalog_product_attribute_media_types($xmlrpcurl, $sessionkey, $setid, $proxyipport = ""){
	global $globalerr;
	global $GLOBALS;
	$GLOBALS['xmlrpc_null_extension']=true;
	$client = new xmlrpc_client($xmlrpcurl);
	$client->setSSLVerifyPeer(false);
	//$client->setDebug(2);
	$params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
	$params[] = new xmlrpcval("catalog_product_attribute_media.types","string"); //array of attributes values
	$params[] = new xmlrpcval(
                array(
                        new xmlrpcval($setid, "int")
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

function magento_catalog_product_attribute_media_update($xmlrpcurl, $sessionkey, $sku, $filename, $label, $position, $exclude, $types, $storeid = "0", $proxyipport = ""){
	global $globalerr;
	global $GLOBALS;
	$GLOBALS['xmlrpc_null_extension']=true;
	$client = new xmlrpc_client($xmlrpcurl);
	$client->setSSLVerifyPeer(false);
	//$client->setDebug(2);
	$params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
	$params[] = new xmlrpcval("catalog_product_attribute_media.update","string"); //array of attributes values
	$params[] = new xmlrpcval(
                array(
                        new xmlrpcval($sku, "string"),
                        new xmlrpcval($filename, "string"),
                        new xmlrpcval($sku, "string"),
                        new xmlrpcval($storeid, "int")
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

function magento_catalog_product_attribute_media_remove($xmlrpcurl, $sessionkey, $sku, $filename, $proxyipport = ""){
	global $globalerr;
	global $GLOBALS;
	$GLOBALS['xmlrpc_null_extension']=true;
	$client = new xmlrpc_client($xmlrpcurl);
	$client->setSSLVerifyPeer(false);
	//$client->setDebug(2);
	$params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
	$params[] = new xmlrpcval("catalog_product_attribute_media.remove","string"); //array of attributes values
	$params[] = new xmlrpcval(
                array(
                        new xmlrpcval($sku, "string"),
                        new xmlrpcval($filename, "string")
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
?>
