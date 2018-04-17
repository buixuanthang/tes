<?php
/*
 * Huy write
 */
	// controller
	
	class Sitemap_autoControllersSitemap_auto extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{
			$type = FSInput::get('type','product','txt');
			$header = '<?xml version="1.0" encoding="UTF-8"?>
			';
			echo $header;
			?>
				<urlset
				      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
				      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
				      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
				            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
				<!-- created with Free Online Sitemap Generator www.xml-sitemaps.com -->
	
			<?php
			switch ($type) {
				
				case 'product_cat':
			    	echo $this->show_products_cat();					
					break;
				case 'news':
			    	echo $this->show_news();					
					break;
				case 'news_cat':
			    	echo $this->show_news_cat();					
					break;
				case 'contents':
			    	echo $this->show_contents();					
					break;

				case 'product':
				default:
			    	echo $this->show_products();					
					break;				
			}
			   
			?>
				</urlset>
			<?php 
		}
		function show_products(){
			$model = $this -> model; 
			$list = $model -> get_products ();
			$xml = '';
			foreach($list as $item){
				$link = FSRoute::_('index.php?module=products&view=product&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id);
				$xml .= '
                      <url>
                          <loc>'.$link.'</loc>
                        </url>  
                    ';
			}
			return $xml;
		}
		
		function show_products_cat(){
			$model = $this -> model; 
			$list = $model -> get_products_cat ();
			$xml = '';
			foreach($list as $item){
				$link = FSRoute::_('index.php?module=products&view=cat&ccode='.$item -> alias.'&cid='.$item->id);
				$xml .= '
                      <url>
                          <loc>'.$link.'</loc>
                        </url>  
                    ';
			}
			return $xml;
		}

		function show_news(){
			$model = $this -> model; 
			$list = $model -> get_news ();
			$xml = '';
			foreach($list as $item){
				$link = FSRoute::_('index.php?module=news&view=news&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id);
				$xml .= '
                      <url>
                          <loc>'.$link.'</loc>
                        </url>  
                    ';
			}
			return $xml;
		}
		function show_news_cat(){
			$model = $this -> model; 
			$list = $model -> get_news_cat ();
			$xml = '';
			foreach($list as $item){
				$link = FSRoute::_('index.php?module=news&view=cat&ccode='.$item -> alias.'&cid='.$item->id);
				$xml .= '
                      <url>
                          <loc>'.$link.'</loc>
                        </url>  
                    ';
			}
			return $xml;
		}


		function show_contents(){
			$model = $this -> model; 
			$list = $model -> get_contents ();
			$xml = '';
			foreach($list as $item){
				$link = FSRoute::_('index.php?module=contents&view=contents&code='.$item -> alias.'&ccode='.$item->category_alias.'&id='.$item->id);
				$xml .= '
                      <url>
                          <loc>'.$link.'</loc>
                        </url>  
                    ';
			}
			return $xml;
		}
	}
	
?>