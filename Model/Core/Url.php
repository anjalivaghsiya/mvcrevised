  <?php

class Model_Core_Url
{
	
	 public function getCurrentUrl( )
	 {
	 	return $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	 	 
	 	 
	 }
	 public function getUrl($controller=null, $action=null, $params=[], $reset=false)
	 {
	  // $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	 	$request=new Model_Core_Request();
	 	$final=$request->getParam();
	 	if ($reset)
	 	 {
	 		 $final=[];
	 	}

	 	if ($controller)
	 	{
	 		 $final['c']=$controller;
	 	}
	 	else{
	 		$final['c']=$request->getControllerName();
	 	}
	 	if ($action)
	 	{

	 		 $final['a']=$action;
	 	}
	 	else{
	 		$final['a']=$request->getActionName();
	 	}
	 	if ($params) 
	 	{
	 		 $final=array_merge($final,$params);
	 	}
	 
	   $uri=trim($_SERVER['REQUEST_URI'],$_SERVER['QUERY_STRING']);
	$querystring=http_build_query($final);
	   $url=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$uri.$querystring;
	   return $url;

	   

}	  
}
?>