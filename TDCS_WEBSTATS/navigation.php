
<div  style="position: fixed;" class="w3-top w3-bar w3-display-topleft w3-dark-grey w3-center w3-wide w3-card w3-hover-shadow">
  <!--<a href="<?php $TAC->GetLink('home'); ?>" class="w3-bar-item w3-button w3-big w3-teal"><?php echo $TAC->title_tag; ?></a>-->
  <a href="<?php $TAC->GetLink('home'); ?>" class="w3-bar-item w3-button w3-hide-small <?php $TAC->Active('home'); ?>">Home</a>
  <a href="<?php $TAC->GetLink('accounts'); ?>" class="w3-bar-item w3-button w3-hide-small <?php $TAC->Active('accounts'); ?>">Accounts</a>
  <a href="<?php $TAC->GetLink('bans'); ?>" class="w3-bar-item w3-button w3-hide-small <?php $TAC->Active('bans'); ?>">Bans</a>
  <a href="<?php $TAC->GetLink('body_stats'); ?>" class="w3-bar-item w3-button w3-hide-small <?php $TAC->Active('body_stats'); ?>">Body Stats</a>
  <a href="<?php $TAC->GetLink('weapon_stats'); ?>" class="w3-bar-item w3-button w3-hide-small <?php $TAC->Active('weapon_stats'); ?>">Weapon Stats</a>
  <a href="<?php $TAC->GetLink('properties'); ?>" class="w3-bar-item w3-button w3-hide-small <?php $TAC->Active('properties'); ?>">Properties</a>
  <a href="<?php $TAC->GetLink('cars'); ?>" class="w3-bar-item w3-button w3-hide-small <?php $TAC->Active('cars'); ?>">Cars</a>
  <a href="<?php $TAC->GetLink('generate_signature'); ?>" class="w3-bar-item w3-button w3-hide-small <?php $TAC->Active('generate_signature'); ?>">Signature</a>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
</div>

<div id="demo"  style="margin-top: 39px!important; position: fixed;" class="w3-top w3-bar w3-bar-block w3-display-topleft w3-dark-grey w3-hide w3-hide-large w3-hide-medium w3-wide">
  <a href="<?php $TAC->GetLink('home'); ?>" class="w3-bar-item w3-button <?php $TAC->Active('home'); ?>">Home</a>
  <a href="<?php $TAC->GetLink('accounts'); ?>" class="w3-bar-item w3-button <?php $TAC->Active('accounts'); ?>">Accounts</a>
  <a href="<?php $TAC->GetLink('bans'); ?>" class="w3-bar-item w3-button <?php $TAC->Active('bans'); ?>">Bans</a>
  <a href="<?php $TAC->GetLink('weapon_stats'); ?>" class="w3-bar-item w3-button <?php $TAC->Active('body_stats'); ?>">Body Stats</a>
  <a href="<?php $TAC->GetLink('weapon_stats'); ?>" class="w3-bar-item w3-button <?php $TAC->Active('weapon_stats'); ?>">Weapon Stats</a>
  <a href="<?php $TAC->GetLink('properties'); ?>" class="w3-bar-item w3-button <?php $TAC->Active('properties'); ?>">Properties</a>
  <a href="<?php $TAC->GetLink('cars'); ?>" class="w3-bar-item w3-button <?php $TAC->Active('cars'); ?>">Cars</a>
  <a href="<?php $TAC->GetLink('generate_signature'); ?>" class="w3-bar-item w3-button <?php $TAC->Active('generate_signature'); ?>">Signature</a>
</div>

<script>
function myFunction() {
    var x = document.getElementById("demo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
