<label class="label_form">Nhận xét và đánh giá</label>
			<?php include 'comments_rate.php'; ?>
			
<form action="/index.php?module=comments&view=comments&task=save_comment_amp" method="get" name="comment_add_form" id='comment_add_form' class='form_comment cls' target="_top" >
			<input type="hidden" value="comments" name='module' />
			<input type="hidden" value="comments" name='view' />
			<input type="hidden" value="<?php echo $module;?>" name='type' id="_cmt_type" />

			<input type="hidden" value="<?php echo $data -> id;?>" name='record_id' id="record_id" />
			<input type="hidden" value="<?php echo $module;?>" name='_cmt_module' id="_cmt_module" />
			<input type="hidden" value="<?php echo $view;?>" name='_cmt_view' id="_cmt_view" />
			<input type="hidden" value="save_comment_amp" name='task' />
			<input type="hidden" value="<?php echo $rid;?>" name='record_id' id="_cmt_record_id" />
			<?php 
			$link_r = $_SERVER['REQUEST_URI'];
			$link_r = URL_ROOT.substr(str_replace('.amp','.html',$link_r),1).'#comment_add_form';
			?>

			<input type="hidden" value="<?php echo 	base64_encode($link_r); ?>" name='return'  id="_cmt_return"  />
			

			
			<div class="_textarea">
				<textarea name="content" id="cmt_content"   placeholder="Viết bình luận của bạn..."></textarea>
			</div>
			<div class="wrap_r cls">            
				<div class="wrap_loginpost">            
					<aside class="_right">                
						<div>           
							<input class="txt_input" name="name" type="text" placeholder="Họ tên (bắt buộc)"  id="cmt_name"  autocomplete="off" value="">
						</div>
						<div>  
							<input class="txt_input" name="email" type="text" placeholder="Email" id="cmt_email"  value="" >     
						</div>             
						
					</aside>        
				</div>
				<div class="wrap_submit mbl">
					<div class="pull-left clearfix">
						<input type="submit" class="_btn_comment" value="Gửi bình luận">  
					</div> 
				</div>  
			</div>  
			
		</form>