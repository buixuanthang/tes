<?php 
$str_order = '[';
$i = 0;
if(count($order_detail)){
  foreach($order_detail as $item){
    if($i > 2)
      break;
    if($i)
      $str_order .= ',';
    $total = $item -> total;
    if(!$total){
      $product = @$products[$item -> product_id];
      $total = $product -> price;
    }
    $str_order .= '{ id: "'.$item -> product_id.'", price: '. $total.', quantity: '.$item -> count.' } ';    
    $i ++;
  }
}
$str_order .= ']';
?>

<script type="text/javascript">
  var cr_layout_type = 'trackTransaction';
  var cr_order = <?php echo $order -> id; ?>;
  var cr_items = <?php echo $str_order; ?>;

</script>
