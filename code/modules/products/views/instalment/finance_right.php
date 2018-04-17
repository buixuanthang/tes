<div class=" col-modal-r">
                  <div class="input_text_wrap">
                    <input type="text" name="sender_name" id="sender_name" placeholder="Họ và tên"  value="Huy test" class="input_text" />
                  </div>
                  <div class="input_text_wrap">
                    <input type="text" name="sender_telephone" id="sender_telephone"  placeholder="Điện thoại"  value="0987654321" class="input_text" />
                  </div>
                  <div class="input_text_wrap">
                    <input type="text" name="sender_email" id="sender_email"  placeholder="Email"  value="huy@huy.com" class="input_text" />
                  </div>
                  <div class="input_text_wrap">
                    <input type="text" name="sender_address" id="sender_address" placeholder="Địa chỉ" value="HN" class="input_text" />
                  </div>

                  <div class="input_text_wrap">
                    <?php $arr_certificates = array(1=>'CMND + Hộ Khẩu',2=>'CMND + Bằng lái xe',3=>'Giấy tờ chứng minh thu nhập',4=>'Sinh viên',5=>'Công chức - Giáo viên'); ?>
                    <select class="customer-option" name="instalment_certificate">
                        <?php foreach($arr_certificates as $key => $name){?>
                          <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
                        <?php } ?>                        
                    </select>
                   </div> 

                   <div class="input_text_wrap">
                    <textarea name="sender_comments" class="input_text"></textarea>
                   </div>

            <div class="btn_area">
              <button type="submit">Đặt mua trả góp</button>                    
            </div>
</div>            