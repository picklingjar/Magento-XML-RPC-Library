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
//catalog_product.setSpecialPrice

function magento_catalog_product_current_store($xmlrpcurl, $sessionkey, $storeid = "0"){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_product.currentStore","string"); //array of attributes values
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

function magento_catalog_product_list($xmlrpcurl, $sessionkey, $filter = array(), $storeid = "0", $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_product.list","string"); //array of attributes values
        $params[] = php_xmlrpc_encode(array($filter,$storeid));
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

function magento_catalog_product_info($xmlrpcurl, $sessionkey, $sku, $storeid = "0", $attributes = array(), $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_product.info","string"); //array of attributes values
        //TODO fix individual attributes
        if(is_array($attributes)){
            $params[] = new xmlrpcval(
                array(
                    new xmlrpcval($sku, "string"),
                    new xmlrpcval($storeid, "int"),
                        //new xmlrpcval($attributes, "array")
                ), "array"
            );
        }
        else {
            $params[] = new xmlrpcval(
                array(
                    new xmlrpcval($sku, "string"),
                    new xmlrpcval($storeid, "int"),
                    //new xmlrpcval(array(
                        //new xmlrpcval($filters, "string")
                    //	), "array"
                    //)
                ), "array"
            );
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

function magento_catalog_product_update($xmlrpcurl, $sessionkey, $sku, $productdata = array(), $storeid="0", $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_product.update","string"); //array of attributes values
        $params[] = php_xmlrpc_encode(array($sku,$productdata,$storeid));
        /*$params[] = new xmlrpcval(
            array(
                new xmlrpcval($sku, "string"),
                new xmlrpcval($productdata, "array"),
                new xmlrpcval($storeid, "int"),
            ), "array"
        );*/
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

function magento_catalog_product_set_special_price($xmlrpcurl, $sessionkey, $sku, $price, $fromdate = "", $todate ="", $storeid= "", $proxyipport = ""){
        //catalog_product.setSpecialPrice
        die("magento_catalog_product_set_special_price TODO");
}

function magento_catalog_product_get_special_price($xmlrpcurl, $sessionkey, $sku, $storeid= "", $proxyipport = ""){
        //catalog_product.getSpecialPrice
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_product.getSpecialPrice","string"); //array of attributes values
        $params[] = new xmlrpcval(
            array(
                new xmlrpcval($sku, "string"),
                new xmlrpcval($storeid, "int"),
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
                //print_r($r);
                $globalerr = "XMLRPC ERROR - Code: " . htmlspecialchars($r->faultCode()) . " Reason: '" . htmlspecialchars($r->faultString()). "'";
        }
        return(false);
}

function magento_catalog_product_delete($xmlrpcurl, $sessionkey, $sku, $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_product.delete","string"); //array of attributes values
        $params[] = new xmlrpcval(
            array(
                new xmlrpcval($sku, "string")
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
                $globalerr = "XMLRPC ERROR - Code: " . htmlspecialchars($r->faultCode()) . " Reason: '" . htmlspecialchars($r->faultString()). "'";
        }
        return(false);
}

function magento_catalog_product_create($xmlrpcurl, $sessionkey, $producttype = "simple", $productset, $sku, $name, $shortdesc, $desc, $price, $weight, $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $taxclassid = 2;
        $quantity = 0;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_product.create","string"); //array of attributes values
        $params[] = new xmlrpcval(
            array(
                new xmlrpcval($producttype, "string"),
                new xmlrpcval($productset, "int"),
                new xmlrpcval($sku, "string"),
                new xmlrpcval(array(
                        "name" => new xmlrpcval($name, "string"),
                        "websites" => new xmlrpcval(array(
                            new xmlrpcval("1", "string")
                            ),
                            "array"
                        ),
                        "short_description" => new xmlrpcval($shortdesc, "string"),
                        "description" => new xmlrpcval($desc, "string"),
                        "price" => new xmlrpcval($price, "string"),
                        "weight" => new xmlrpcval($weight, "string"),
                        "tax_class_id" => new xmlrpcval($taxclassid),
                        "status" => new xmlrpcval("1", "boolean"),
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
                $globalerr = "XMLRPC ERROR - Code: " . htmlspecialchars($r->faultCode()) . " Reason: '" . htmlspecialchars($r->faultString()). "'";
        }
        return(false);
}
?>
