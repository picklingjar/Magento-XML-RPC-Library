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
//catalog_category.level
//catalog_category.currentStore

function magento_catalog_category_assign_product($xmlrpcurl, $sessionkey, $catid, $sku, $position = "0", $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_category.assignProduct","string"); //array of attributes values
        $params[] = new xmlrpcval(
                array(
                        new xmlrpcval($catid, "int"),
                        new xmlrpcval($sku, "string"),
                        new xmlrpcval($position, "int"),
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

function magento_catalog_category_update_product($xmlrpcurl, $sessionkey, $catid, $sku, $position = "0", $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_category.updateProduct","string"); //array of attributes values
        $params[] = new xmlrpcval(
                array(
                        new xmlrpcval($catid, "int"),
                        new xmlrpcval($sku, "string"),
                        new xmlrpcval($position, "int"),
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

function magento_catalog_category_assigned_products($xmlrpcurl, $sessionkey, $catid, $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_category.assignedProducts","string"); //array of attributes values
        $params[] = new xmlrpcval(
                array(
                        new xmlrpcval($catid, "int"),
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

function magento_catalog_category_delete($xmlrpcurl, $sessionkey, $catid, $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_category.delete","string"); //array of attributes values
        $params[] = new xmlrpcval(
                array(
                        new xmlrpcval($catid, "int"),
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

function magento_catalog_category_move($xmlrpcurl, $sessionkey, $catid, $parentid, $afterid = "", $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_category.move","string"); //array of attributes values
        if($afterid != ""){
	        $params[] = new xmlrpcval(
        	        array(
                	        new xmlrpcval($catid, "int"),
                        	new xmlrpcval($parentid, "int"),
	                        new xmlrpcval($afterid, "int")
        	        ),
                	"array");
        }
        $params[] = new xmlrpcval(
            array(
                new xmlrpcval($catid, "int"),
                new xmlrpcval($parentid, "int"),
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

function magento_catalog_category_update($xmlrpcurl, $sessionkey, $catid, $catdata, $storeid = "0", $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_category.update","string"); //array of attributes values
        $params[] = php_xmlrpc_encode(array($catid,$catdata,$storeid));
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

function magento_catalog_category_info($xmlrpcurl, $sessionkey, $catid, $storeid = "0", $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_category.info","string"); //array of attributes values
        $params[] = new xmlrpcval(
                array(
                        new xmlrpcval($catid, "int"),
                        new xmlrpcval($storeid, "string"),
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

function magento_catalog_category_create($xmlrpcurl, $sessionkey, $parentid, $catdata, $storeid = "0", $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_category.create","string"); //array of attributes values
        $params[] = php_xmlrpc_encode(array($parentid,$catdata,$storeid));
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

function magento_catalog_category_create_wrapper($xmlrpcurl, $sessionkey, $parentid, $name, $meta_title ="", $meta_keywords ="", $meta_description = "", $parent_id = "", $is_active = "1", $storeid = "0", $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_category.create","string"); //array of attributes values
        if($parentid != ""){
	        $params[] = new xmlrpcval(
        	        array(
                	        new xmlrpcval($parentid, "int"),
                        	new xmlrpcval(array(
					"name" => new xmlrpcval($name, "string"),
					"meta_title" => new xmlrpcval($meta_title, "string"),
					"meta_keywords" => new xmlrpcval($meta_keywords, "string"),
					"meta_description" => new xmlrpcval($meta_description, "string"),
					"parent_id" => new xmlrpcval($parentid, "int"),
					"is_active" => new xmlrpcval($is_active, "string"),
				), "struct"),
                	        new xmlrpcval($storeid, "int")
			),
                	"array");
        }
        else {
            $params[] = new xmlrpcval(
        	        array(
                	        new xmlrpcval(0, "int"),
                        	new xmlrpcval(array(
                                "name" => new xmlrpcval($name, "string"),
                                "meta_title" => new xmlrpcval($meta_title, "string"),
                                "meta_keywords" => new xmlrpcval($meta_keywords, "string"),
                                "meta_description" => new xmlrpcval($meta_description, "string"),
                                "is_active" => new xmlrpcval($is_active, "string"),
                            ), "struct"),
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
function magento_catalog_category_remove_product($xmlrpcurl, $sessionkey, $catid, $sku, $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        //$client->setDebug(2);
        $params[] = new xmlrpcval($sessionkey,"string"); //sessionkey
        $params[] = new xmlrpcval("catalog_category.removeProduct","string"); //array of attributes values
        $params[] = new xmlrpcval(
                array(
                        new xmlrpcval($catid, "int"),
                        new xmlrpcval($sku, "string"),
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

function magento_catalog_category_tree($xmlrpcurl, $sessionkey, $proxyipport = ""){
        global $globalerr;
        global $GLOBALS;
        $GLOBALS['xmlrpc_null_extension']=true;
        $client = new xmlrpc_client($xmlrpcurl);
        $client->setSSLVerifyPeer(false);
        $params[] = new xmlrpcval($sessionkey); //sessionkey
        $params[] = new xmlrpcval("catalog_category.tree");
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
                return(php_xmlrpc_decode($r->value()));
        }
        else {
                $globalerr = "XMLRPC ERROR - Code: " . htmlspecialchars($r->faultCode()) . " Reason: '" . htmlspecialchars($r->faultString()). "'";
        }
        return(false);
}

function magento_catalog_category_id_by_url_key($xmlrpcurl, $sessionkey, $urlkey, $proxyipport = ""){
        global $globalerr;
        $res = magento_catalog_category_tree($xmlrpcurl, $sessionkey, $proxyipport = "");
        if($res === false){
            $globalerr = 'Could not get magento category tree';
            return(false);
        }
        else {
            $cinfo = magento_catalog_category_info($xmlrpcurl, $sessionkey, $res['category_id'], 0, $proxyipport);
            if($cinfo['url_key'] == $urlkey){
                return($res['category_id']);
            }
            $c = count($res['children']);
            for($x = 0; $x < $c; $x++){
                $cinfo = magento_catalog_category_info($xmlrpcurl, $sessionkey, $res['children'][$x]['category_id'], 0, $proxyipport);
                if($cinfo['url_key'] == $urlkey){
                    return($res['children'][$x]['category_id']);
                }
                $d = count($res['children'][$x]['children']);
                for($y = 0; $y < $d; $y++){
                    $cinfo = magento_catalog_category_info($xmlrpcurl, $sessionkey, $res['children'][$x]['children'][$y]['category_id'], 0, $proxyipport);
                    if($cinfo['url_key'] == $urlkey){
                        return($res['children'][$x]['children'][$y]['category_id']);
                    }
                    $e = count($res['children'][$x]['children'][$y]['children']);
                    for($z = 0; $z < $e; $z++){
                        $cinfo = magento_catalog_category_info($xmlrpcurl, $sessionkey, $res['children'][$x]['children'][$y]['children'][$z]['category_id'], 0, $proxyipport);
                        if($cinfo['url_key'] == $urlkey){
                            return($res['children'][$x]['children'][$y]['children'][$z]['category_id']);
                        }
                        $f = count($res['children'][$x]['children'][$y]['children'][$z]['children']);
                        for($za = 0; $za < $f; $za++){
                            $cinfo = magento_catalog_category_info($xmlrpcurl, $sessionkey, $res['children'][$x]['children'][$y]['children'][$z]['children'][$za]['category_id'], 0, $proxyipport);
                            if($cinfo['url_key'] == $urlkey){
                                return($res['children'][$x]['children'][$y]['children'][$z]['children'][$za]['category_id']);
                            }
                        }
                    }
                }
            }
        }
        $globalerr = "Could not find magento category name";
        return(false);
}


/* Bonus Function */
function magento_catalog_category_id_by_name($xmlrpcurl, $sessionkey, $categoryname, $proxyipport =""){
        global $globalerr;
        $res = magento_catalog_category_tree($xmlrpcurl, $sessionkey, $proxyipport);
        if($res === false){
            $globalerr = 'Could not get magento category tree';
            return(false);
        }
        else {
            if($res['name'] == $categoryname){
                return($res['category_id']);
            }
            $c = count($res['children']);
            for($x = 0; $x < $c; $x++){
                if($res['children'][$x]['name'] == $categoryname){
                    return($res['children'][$x]['category_id']);
                }
                $d = count($res['children'][$x]['children']);
                for($y = 0; $y < $d; $y++){
                    if($res['children'][$x]['children'][$y]['name'] == $categoryname){
                        return($res['children'][$x]['children'][$y]['category_id']);
                    }
                    $e = count($res['children'][$x]['children'][$y]['children']);
                    for($z = 0; $z < $e; $z++){
                        if($res['children'][$x]['children'][$y]['children'][$z]['name'] == $categoryname){
                            return($res['children'][$x]['children'][$y]['children'][$z]['category_id']);
                        }
                        $f = count($res['children'][$x]['children'][$y]['children'][$z]['children']);
                        for($za = 0; $za < $f; $za++){
                            if($res['children'][$x]['children'][$y]['children'][$z]['children'][$za]['name'] == $categoryname){
                                return($res['children'][$x]['children'][$y]['children'][$z]['children'][$za]['category_id']);
                            }
                        }
                    }
                }
            }
        }
        $globalerr = "Could not find magento category name";
        return(false);
}
?>
