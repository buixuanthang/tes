<?php $i=0;?>
<?php if(count($products_incentives)){?>
<div class="product_inventives_item panel-group" id="accordion">
	<?php foreach($products_incentives as $item){?>
		<?php $product_item = @$array_products_incentives[$item -> product_incenty_id]; ?>
		<?php if($product_item){?>
			<?php $link  = FSRoute::_('index.php?module=products&view=product&code='.$product_item -> alias.'&id='.$product_item -> id.'&ccode='.$product_item -> category_alias.'&Itemid=37');?>
				<div class="panel panel-default">
					 <div class="panel-heading">
		             <div class="panel-heading">
		                <a class=" btn-info iconbox pull-left <?php echo ($i==0)?'':'collapsed'?>" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo  $i?>"></a>
		            	  <h4 class="panel-title media-body pull-left">
		                	<a href="<?php echo $link; ?>" title="<?php echo htmlspecialchars ($product_item -> name); ?>"><?php echo $product_item->name;?></a>
		                </h4>
		            	<div class="clear"></div>
		            </div>
		            </div>
		            <div id="collapse_<?php echo $i; ?>" class="panel-collapse collapse <?php echo ($i==0)?"in":''?>">
		                <div class="panel-body">
		                  	<a class="pull-left" href="<?php echo $link; ?>"  title="<?php echo htmlspecialchars ($product_item -> name); ?>">
		                		<img src="<?php echo URL_ROOT.'images/products/small/'.$product_item->image; ?>" alt="<?php echo htmlspecialchars ($product_item -> name); ?>"  width="70" height="70" />
		                    </a>
		                    <div class="media-body">
								<p><?php echo $product_item->summary;?></p>
							</div>
							<div class="clear"></div>
		                </div>
		            </div>
				</div>                        
		<?php }?>
		<?php $i++;?>
	<?php }?>
</div>	
<?php } else {?>
	<?php echo  FSText::_('Không có phụ kiện khuyến mãi nào đối với sản phẩm này')?>
<?php }?>