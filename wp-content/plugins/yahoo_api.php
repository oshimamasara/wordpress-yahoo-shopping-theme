<?php
    $data = array();
    $nogiblog_xml = simplexml_load_file('http://shopping.yahooapis.jp/ShoppingWebService/V1/itemSearch?appid=dj0zaiZpPXNaeTRZVDBjaXNsciZzPWNvbnN1bWVyc2VjcmV0Jng9MzI-&store_id=belsus');
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

        print $item_link.'<br>';
        print $item_img.'<br>';
        print $item_title.'<br>';
        print $item_price.'<br>';
        print $item_review.'<br>';
        print $i.'回目おわり<hr>';
        $i++;
    }
?>