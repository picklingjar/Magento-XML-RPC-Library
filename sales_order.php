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
//sales_order.addComment - Add comment to order
//sales_order.hold - Hold order
//sales_order.unhold - Unhold order
//sales_order.cancel - Cancel order

//sales_order.list - Retrieve list of orders by filters
function magento_sales_order_list($xmlrpcurl, $sessionkey, $storeid = "0", $filter = array(), $proxyipport = ''){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("sales_order.list","string"); //array of attributes values
        $params[] = php_xmlrpc_encode($filter);
        //array(array('customer_firstname'=>array('eq'=>'Foo'), 'customer_lastname'=>array('eq'=>'Bar'))));
        //$params[] = php_xmlrpc_encode(array(array('customer_firstname'=>array('eq'=>'Foo'), 'customer_lastname'=>array('eq'=>'Bar'))));
        $msg = new xmlrpcmsg("call",$params);
        if(@$proxyipport != ""){
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

//sales_order.info - Retrieve order information
function magento_sales_order_info($xmlrpcurl, $sessionkey, $storeid = "0", $incrementid = "", $proxyipport = ''){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("sales_order.info","string"); //array of attributes values
        $params[] = new xmlrpcval(
                array(
                        new xmlrpcval($incrementid, "int") //untested
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
