<form action="javascript:void(0);" method="post" name="comment_add_form" id='comment_add_form' class='form_comment cls' class="form_comment" onsubmit="javascript: submit_comment();return false;">
			<label class="label_form"><?php echo FSText::_('Nhận xét đánh giá'); ?></label>
			<?php include 'comments_rate.php'; ?>
			<div class="_textarea">
				<textarea name="content" id="cmt_content"   placeholder="<?php echo FSText::_('Viết bình luận của bạn'); ?>..."></textarea>
			</div>
			<div class="wrap_r cls">            
				<div class="wrap_loginpost">            
					<aside class="_right">                
						<div>           
							<input class="txt_input" name="name" type="text" placeholder="<?php echo FSText::_('Họ tên'); ?> (<?php echo FSText::_('bắt buộc'); ?>)"  id="cmt_name"  autocomplete="off" value="">
						</div>
						<div>  
							<input class="txt_input" name="email" type="text" placeholder="Email" id="cmt_email"  value="" >     
						</div>             
						
					</aside>        
				</div>
				<div class="wrap_submit">
					<div class="pull-left clearfix">
						<input type="submit" class="_btn_comment _bg1" value="<?php echo FSText::_('Gửi bình luận'); ?>">  
					</div> 
				</div>  
			</div>  
			<input type="hidden" value="comments" name='module' />
			<input type="hidden" value="comments" name='view' />
			<input type="hidden" value="<?php echo $module;?>" name='type' id="_cmt_type" />

			<input type="hidden" value="<?php echo $data -> id;?>" name='record_id' id="record_id" />
			<input type="hidden" value="<?php echo $module;?>" name='_cmt_module' id="_cmt_module" />
			<input type="hidden" value="<?php echo $view;?>" name='_cmt_view' id="_cmt_view" />
			<input type="hidden" value="save_comment" name='task' />
			<input type="hidden" value="<?php echo $rid;?>" name='record_id' id="_cmt_record_id" />
			<input type="hidden" value="<?php echo $return;?>" name='return'  id="_cmt_return"  />
			<input type="hidden" value="<?php echo '/index.php?module=comments&view=comments&type='.$module.'&task=save_comment&raw=1'; ?>" name="return" id="link_reply_form" />
		</form>