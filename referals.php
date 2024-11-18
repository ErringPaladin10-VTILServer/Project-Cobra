<?php
require('connect.php');

if (!isset($_COOKIE['RoPlaySecurity'])) {
  die(require('auth.php'));
}

require('header.php');
?>

<div class="row"><br /><br /></div>
<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-lg-4">
    <iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=US&source=ss&ref=as_ss_li_til&ad_type=product_link&tracking_id=dannyftm-20&marketplace=amazon&region=US&placement=B016CKPYIY&asins=B016CKPYIY&linkId=27f57858710e712483c039c4def19477&show_border=true&link_opens_in_new_window=true"></iframe>
    <iframe style="width:120px;height:240px;" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" src="//ws-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&OneJS=1&Operation=GetAdHtml&MarketPlace=US&source=ss&ref=as_ss_li_til&ad_type=product_link&tracking_id=dannyftm-20&marketplace=amazon&region=US&placement=B073V5DCW9&asins=B073V5DCW9&linkId=bdb10b40008337394657db85a1ea01a5&show_border=true&link_opens_in_new_window=true"></iframe>
  </div>
  <div class="col-sm-4"></div>
</div>

<?php
require('footer.php');
?>