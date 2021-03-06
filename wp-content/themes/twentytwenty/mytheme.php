<?php
/**
 * Template Name: mytheme
 * Template Post Type: page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header(1);
?>

<style>
.item-button{
  font-size:medium;
  padding:10px;
}
.price-label{
  font-size:medium;
}
</style>

<h1 style="font-size: 3.6rem;font-weight: 800;line-height: 1.138888889;text-align:center;padding-bottom: 30px"><?php the_title(); ?></h1>

<div class="container">

<?php
    $data = array();
    $nogiblog_xml = simplexml_load_file('http://shopping.yahooapis.jp/ShoppingWebService/V1/itemSearch?appid=ご自身のYahoo!API-Client-ID（https://e.developer.yahoo.co.jp/dashboard/）&store_id=belsus');
    $json = json_encode($nogiblog_xml);
    $items = json_decode($json,TRUE);
    $y_shop_items = $items['Result']['Hit'];

    $i = 0;
    foreach ($y_shop_items as $items) {
        $item_title = $items['Name'];
        $item_title = mb_substr($item_title, 0, 47);
        $item_img = $items['Image']['Medium'];
        $item_link = $items['Url'];
        $item_price = $items['Price'];
        $item_review = $items['Review']['Rate'];

        if ($i ==0){
            print '<div class="row">';
        }
        // Bootstrap
        print '<div class="col-sm-3">';
        print '<div class="card mt-3">';
        print '<div class="img"><a href="'. $item_link .' "data-toggle="modal" data-target="#myModal" onclick="myFunction()"><img class="rouded img-thumbnail" src="'.$item_img.'" alt="Card image cap"></a></div>';
        print '<div class="card-body">';
        print '<h5 class="card-title">'.$item_title.'</h5>';
        print '<p class="card-text price-label">価格：'.$item_price.'円　<br>(評価：'.$item_review.')</p>';
        print '<button type="button" data-toggle="modal" data-target="#myModal" onclick="myFunction()" class="item-button">商品詳細</button> </div>';
        print "<script>function myFunction(){setInterval(function(){ window.location.href = '".$item_link."'; }, 2000);}</script>";
        print '</div></div>';
        $i++;

        if ($i ==4){
            print '</div>';
            $i = 0;
        }
    }
?>
</div>

<hr>

<!-- jump Yahoo shop popup function -->
<!-- The Modal -->
<style>
.modal-dialog {
    margin: 20vh auto 0px auto;
}
</style>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div id='hideMe'>
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header  bg-danger ">
          <div style="text-align:left; ">
          <h1 class="modal-title p-3 mb-2 text-white ">当店のYahooショップに移動中...</h1>
          </div>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <h3>＜＜ NEWS ＞＞ 当店Yahooショップは、ポイント割増中！</h3>
        </div>
        
      </div>
    </div>
  </div>
</div>
<!-- end jump Yahoo shop popup function  -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
