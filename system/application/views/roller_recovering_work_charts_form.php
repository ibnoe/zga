<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>roller recovering work charts</title>

<style>
<!-- 
select {font-size:12px;}
A:link {text-decoration: none; color: blue}
A:visited {text-decoration: none; color: purple}
A:active {text-decoration: red}
A:hover {text-decoration: underline; color:red}
-->
</style>
<style type="text/css">
<!--
.ft0{font-style:normal;font-weight:bold;font-size:11px;font-family:Arial;color:#000000;}
.ft1{font-style:normal;font-weight:normal;font-size:11px;font-family:Times New Roman;color:#000000;}
.ft2{font-style:normal;font-weight:normal;font-size:11px;font-family:Arial;color:#000000;}
.ft3{font-style:normal;font-weight:normal;font-size:13px;font-family:Arial;color:#000000;}
-->
</style>
</head>
<body vlink="#FFFFFF" link="#FFFFFF" bgcolor="#ffffff">


<div style="position:absolute;top:31;left:22"><span class="ft0">RECOVERING WORK CHART</span></div>
<div style="position:absolute;top:30;left:523"><span class="ft1"> This work chart has to stay with the rollers</span></div>
<div style="position:absolute;top:56;left:22"><span class="ft2">Order No.</span></div>
<div style="position:absolute;top:56;left:154"><span class="ft2"> : <?=$norcn;?></span></div>
<div style="position:absolute;top:56;left:293"><span class="ft2"> Roller Incoming Date</span></div>
<div style="position:absolute;top:56;left:408"><span class="ft2"> : <?=$incomingrolldate;?></span></div>
<div style="position:absolute;top:56;left:646"><span class="ft0"> Date Of Delivery :</span></div>
<div style="position:absolute;top:79;left:22"><span class="ft2">Date</span></div>
<div style="position:absolute;top:79;left:154"><span class="ft2"> :  <?=$datercn;?></span></div>
<div style="position:absolute;top:79;left:293"><span class="ft2"> C.N. Incoming Date : </span></div>
<div style="position:absolute;top:75;left:666"><span class="ft0"> </span></div>
<div style="position:absolute;top:101;left:22"><span class="ft2">Customer</span></div>
<div style="position:absolute;top:101;left:154"><span class="ft2"> : <?=$customer_firstname;?></span></div>
<div style="position:absolute;top:101;left:293"><span class="ft2"> Total Quantity : <?=$totalrollerscollected;?> Roll </span></div>
<div style="position:absolute;top:101;left:646"><span class="ft0"> Status : <?=$status;?></span></div>
<div style="position:absolute;top:107;left:169"><span class="ft2"> </span></div>
<div style="position:absolute;top:129;left:22"><span class="ft2">Roller No.</span></div>
<div style="position:absolute;top:129;left:154"><span class="ft2"> : </span></div>
<div style="position:absolute;top:129;left:293"><span class="ft2"> Press</span></div>
<div style="position:absolute;top:129;left:408"><span class="ft2"> : <?=$press;?></span></div>
<div style="position:absolute;top:151;left:22"><span class="ft2">Dimensions (in mm)</span></div>
<div style="position:absolute;top:151;left:293"><span class="ft2"> Roller Type</span></div>
<div style="position:absolute;top:151;left:408"><span class="ft2"> : </span></div>
<div style="position:absolute;top:174;left:22"><span class="ft2">RD</span></div>
<div style="position:absolute;top:174;left:154"><span class="ft2"> : </span></div>
<div style="position:absolute;top:174;left:293"><span class="ft2"> Core Type</span></div>
<div style="position:absolute;top:174;left:408"><span class="ft2"> : </span></div>
<div style="position:absolute;top:174;left:529"><span class="ft2"> Accessories : </span></div>
<div style="position:absolute;top:196;left:22"><span class="ft2">CD</span></div>
<div style="position:absolute;top:196;left:154"><span class="ft2"> : </span></div>
<div style="position:absolute;top:196;left:293"><span class="ft2"> Core Material : </span></div>
<div style="position:absolute;top:196;left:529"><span class="ft2"> Assembly Request : </span></div>
<div style="position:absolute;top:218;left:22"><span class="ft2"></span></div>
<div style="position:absolute;top:218;left:154"><span class="ft2"> : </span></div>
<div style="position:absolute;top:218;left:293"><span class="ft2"> Drawing No.</span></div>
<div style="position:absolute;top:218;left:408"><span class="ft2"> : -</span></div>
<div style="position:absolute;top:241;left:22"><span class="ft2">WL</span></div>
<div style="position:absolute;top:241;left:154"><span class="ft2"> : </span></div>
<div style="position:absolute;top:241;left:293"><span class="ft2"> Compound</span></div>
<div style="position:absolute;top:241;left:408"><span class="ft2"> : </span></div>
<div style="position:absolute;top:241;left:529"><span class="ft2"> Under Cover :</span></div>
<div style="position:absolute;top:263;left:22"><span class="ft2">TL</span></div>
<div style="position:absolute;top:263;left:154"><span class="ft2"> : </span></div>
<div style="position:absolute;top:263;left:293"><span class="ft2"> Quantity</span></div>
<div style="position:absolute;top:263;left:408"><span class="ft2"> :  Roll</span></div>
<div style="position:absolute;top:263;left:529"><span class="ft2"> Top Layer</span></div>
<div style="position:absolute;top:263;left:635"><span class="ft2"> : </span></div>
<div style="position:absolute;top:291;left:22"><span class="ft2">GENERAL INFORMATION :</span></div>
<div style="position:absolute;top:312;left:22"><span class="ft3"></span></div>
<div style="position:absolute;top:314;left:169"><span class="ft2"> </span></div>
<div style="position:absolute;top:314;left:406"><span class="ft2"> </span></div>
<div style="position:absolute;top:328;left:359"><span class="ft2"></span></div>
<div style="position:absolute;top:348;left:22"><span class="ft2">DISASSEMBLING</span></div>
<div style="position:absolute;top:365;left:22"><span class="ft2">Date</span></div>
<div style="position:absolute;top:365;left:154"><span class="ft2"> : </span></div>
<div style="position:absolute;top:365;left:293"><span class="ft2"> Diss. No :  Name : </span></div>
<div style="position:absolute;top:365;left:655"><span class="ft2"> Working Time : </span></div>
<div style="position:absolute;top:391;left:22"><span class="ft2">CORE &amp; ACCESSORIES CHECK</span></div>
<div style="position:absolute;top:410;left:22"><span class="ft2">Repair Required</span></div>
<div style="position:absolute;top:410;left:154"><span class="ft2"> : (  ) Yes    (  ) No</span></div>
<div style="position:absolute;top:410;left:305"><span class="ft2"> Date Out : ........</span></div>
<div style="position:absolute;top:432;left:22"><span class="ft2">Quantity</span></div>
<div style="position:absolute;top:432;left:154"><span class="ft2"> : ....... roll</span></div>
<div style="position:absolute;top:432;left:305"><span class="ft2"> Date In : ........ Name :</span></div>
<div style="position:absolute;top:432;left:655"><span class="ft2"> Working Time :</span></div>
<div style="position:absolute;top:475;left:22"><span class="ft2">Glueing batch no.</span></div>
<div style="position:absolute;top:475;left:169"><span class="ft2">         Date</span></div>
<div style="position:absolute;top:475;left:293"><span class="ft2">         Qty</span></div>
<div style="position:absolute;top:497;left:21"><span class="ft2">.........</span></div>
<div style="position:absolute;top:497;left:168"><span class="ft2"> .........</span></div>
<div style="position:absolute;top:497;left:293"><span class="ft2"> ........</span></div>
<div style="position:absolute;top:497;left:646"><span class="ft2"> ........</span></div>
<div style="position:absolute;top:518;left:21"><span class="ft2">.........</span></div>
<div style="position:absolute;top:518;left:168"><span class="ft2"> .........</span></div>
<div style="position:absolute;top:518;left:293"><span class="ft2"> ........</span></div>
<div style="position:absolute;top:518;left:646"><span class="ft2"> ........</span></div>
<div style="position:absolute;top:540;left:21"><span class="ft2">.........</span></div>
<div style="position:absolute;top:540;left:168"><span class="ft2"> .........</span></div>
<div style="position:absolute;top:540;left:293"><span class="ft2"> ........</span></div>
<div style="position:absolute;top:540;left:646"><span class="ft2"> ........</span></div>
<div style="position:absolute;top:570;left:22"><span class="ft2">WRAPPING</span></div>
<div style="position:absolute;top:587;left:22"><span class="ft2">Compound</span></div>
<div style="position:absolute;top:587;left:154"><span class="ft2"> : ......... Batch No. :   ....... Used      :</span></div>
<div style="position:absolute;top:586;left:646"><span class="ft2"> ........Kg</span></div>
<div style="position:absolute;top:609;left:22"><span class="ft2">Under cover</span></div>
<div style="position:absolute;top:609;left:154"><span class="ft2"> : (  ) Yes    (  ) No Compound :   ....... Used      :</span></div>
<div style="position:absolute;top:609;left:646"><span class="ft2"> .......Kg</span></div>
<div style="position:absolute;top:631;left:22"><span class="ft2">Wrapping Diameter         Date</span></div>
<div style="position:absolute;top:631;left:293"><span class="ft2">         Qty</span></div>
<div style="position:absolute;top:652;left:21"><span class="ft2">.......</span></div>
<div style="position:absolute;top:652;left:168"><span class="ft2"> .......</span></div>
<div style="position:absolute;top:652;left:293"><span class="ft2"> .......</span></div>
<div style="position:absolute;top:652;left:646"><span class="ft2"> .......</span></div>
<div style="position:absolute;top:674;left:21"><span class="ft2">.......</span></div>
<div style="position:absolute;top:674;left:168"><span class="ft2"> .......</span></div>
<div style="position:absolute;top:674;left:293"><span class="ft2"> .......</span></div>
<div style="position:absolute;top:674;left:646"><span class="ft2"> .......</span></div>
<div style="position:absolute;top:697;left:21"><span class="ft2">.......</span></div>
<div style="position:absolute;top:697;left:168"><span class="ft2"> ........</span></div>
<div style="position:absolute;top:697;left:293"><span class="ft2"> .......</span></div>
<div style="position:absolute;top:697;left:646"><span class="ft2"> .......</span></div>
<div style="position:absolute;top:723;left:22"><span class="ft2">VULCANIZATION</span></div>
<div style="position:absolute;top:739;left:22"><span class="ft2">Date</span></div>
<div style="position:absolute;top:739;left:154"><span class="ft2"> : .......     Qty         : ....... Name : .......</span></div>
<div style="position:absolute;top:739;left:655"><span class="ft2"> Working Time : .......</span></div>
<div style="position:absolute;top:765;left:22"><span class="ft2">GRINDING</span></div>
<div style="position:absolute;top:783;left:22"><span class="ft2">Date</span></div>
<div style="position:absolute;top:783;left:188"><span class="ft2"> Step of Process</span></div>
<div style="position:absolute;top:783;left:316"><span class="ft2"> Qty</span></div>
<div style="position:absolute;top:783;left:428"><span class="ft2"> Failure Name</span></div>
<div style="position:absolute;top:808;left:21"><span class="ft2">.......</span></div>
<div style="position:absolute;top:809;left:200"><span class="ft2"> FACE OFF</span></div>
<div style="position:absolute;top:808;left:307"><span class="ft2"> .......</span></div>
<div style="position:absolute;top:808;left:434"><span class="ft2"> .......</span></div>
<div style="position:absolute;top:809;left:655"><span class="ft2"> Working Time : .......</span></div>
<div style="position:absolute;top:830;left:21"><span class="ft2">.......</span></div>
<div style="position:absolute;top:831;left:200"><span class="ft2"> GRINDING</span></div>
<div style="position:absolute;top:830;left:307"><span class="ft2"> .......</span></div>
<div style="position:absolute;top:830;left:434"><span class="ft2"> .......</span></div>
<div style="position:absolute;top:831;left:655"><span class="ft2"> Working Time : .......</span></div>
<div style="position:absolute;top:853;left:21"><span class="ft2">.......</span></div>
<div style="position:absolute;top:853;left:197"><span class="ft2"> POLISHING</span></div>
<div style="position:absolute;top:853;left:307"><span class="ft2"> .......</span></div>
<div style="position:absolute;top:853;left:434"><span class="ft2"> .......</span></div>
<div style="position:absolute;top:853;left:655"><span class="ft2"> Working Time : .......</span></div>
<div style="position:absolute;top:879;left:22"><span class="ft2">QUALITY CONTROL</span></div>
<div style="position:absolute;top:901;left:22"><span class="ft2">Certificate Required : (  ) Yes    (  ) No</span></div>
<div style="position:absolute;top:901;left:305"><span class="ft2"> Date</span></div>
<div style="position:absolute;top:901;left:379"><span class="ft2"> : ....... Name : .......</span></div>
<div style="position:absolute;top:901;left:655"><span class="ft2"> Working Time : .......</span></div>
<div style="position:absolute;top:927;left:22"><span class="ft2">ASSEMBLING</span></div>
<div style="position:absolute;top:943;left:22"><span class="ft2">Accessories</span></div>
<div style="position:absolute;top:943;left:154"><span class="ft2"> : (  ) New    (  ) Customer Date</span></div>
<div style="position:absolute;top:943;left:379"><span class="ft2"> : ....... Name : .......</span></div>
<div style="position:absolute;top:943;left:655"><span class="ft2"> Working Time : .......</span></div>
<div style="position:absolute;top:969;left:22"><span class="ft2">PACKING</span></div>
<div style="position:absolute;top:986;left:22"><span class="ft2">Date</span></div>
<div style="position:absolute;top:986;left:154"><span class="ft2"> : .......     Qty              :....... Name : .......</span></div>
<div style="position:absolute;top:986;left:655"><span class="ft2"> Working Time : .......</span></div>
<div style="position:absolute;top:1012;left:22"><span class="ft2">Note :</span></div>
<div style="position:absolute;top:1087;left:57"><span class="ft2"> Made by :</span></div>
<div style="position:absolute;top:458;left:22"><span class="ft2">STRIPPING / CLEANING / DEGREASING</span></div>
<div style="position:absolute;top:1086;left:383"><span class="ft2"> Checked by :</span></div>
<div style="position:absolute;top:1086;left:653"><span class="ft2"> Approved by :</span></div>
<div style="position:absolute;top:540;left:435"><span class="ft2">.......</span></div>
<div style="position:absolute;top:475;left:457"><span class="ft2">Name</span></div>
<div style="position:absolute;top:475;left:646"><span class="ft2"> Working Time :</span></div>
<div style="position:absolute;top:497;left:435"><span class="ft2">.......</span></div>
<div style="position:absolute;top:518;left:435"><span class="ft2">.......</span></div>
<div style="position:absolute;top:697;left:435"><span class="ft2">.......</span></div>
<div style="position:absolute;top:631;left:457"><span class="ft2">Name</span></div>
<div style="position:absolute;top:631;left:646"><span class="ft2"> Working Time :</span></div>
<div style="position:absolute;top:652;left:435"><span class="ft2">.......</span></div>
<div style="position:absolute;top:674;left:435"><span class="ft2">.......</span></div>

</body>
</html>