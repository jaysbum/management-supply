<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \kartik\widgets\Select2;
?>
<?php
if(isset($_GET['id'])){
$niin = \app\models\CatalogItem::findOne($_GET['id'])->niin;
$sgroup = \app\models\CatalogGroup::find()->where("start_niin < ".$niin." AND end_niin > ".$niin)->one()->id;
}else{
  $sgroup = 0;
}
$init = array(0=>'********** เป็นพัสดุหลัก **********');
$parent = ArrayHelper::map(app\models\CatalogItem::find(['parent_nsn' => 0])->where('niin >= 7310000')->all(),'nsn','name');
$parent_nsn = array_merge($init,$parent);
$cat = (isset($model->nsn))?substr($model->nsn,0,4):0;
$country = (isset($model->nsn))?substr($model->nsn,4,2):0;
$listCategory = array(
 '1080' => '1080 บริภัณฑ์การพรางและการลวงข้าศึก  (ทุกคลังใหญ่)',
 '3010' => '3010 เครื่องแปลงผันแรงบิดและเครื่องเปลี่ยนอัตราเร็ว  (ทุกคลังใหญ่)',
 '3020' => '3020 เฟือง ลูกรอก ล้อซี่เฟืองและโซ่ส่งกำลังงาน  (ทุกคลังใหญ่)',
 '3030' => '3030 เครื่องสายพาน สายพานขบ สายพานพัดลมและเครื่องประกอบ  (ทุกคลังใหญ่)',
 '3040' => '3040 บริภัณฑ์เบ็ดเตล็ดสำหรับการส่งกำลังงาน  (ทุกคลังใหญ่)',
 '3110' => '3110 รองเพลากำจัดความเสียดทาน (ชนิดใช้ลูกลื่น) ยังมิได้ประกอบตุ๊กตา  (ทุกคลังใหญ่)',
 '3120' => '3120 รองเพลาแบบธรรมดา (ชนิดไม่ใช้ลูกลื่น) ยังมิได้ประกอบตุ๊กตา  (ทุกคลังใหญ่)',
 '3130' => '3130 รองเพลาที่ประกอบตุ๊กตา  (ทุกคลังใหญ่)',
 '3405' => '3405 เครื่องเลื่อยและเครื่องสับฟันเลื่อย  (ทุกคลังใหญ่)',
'3408' => '3408 เครื่องกลแบบศูนย์รวมและเครื่องกลแบบรายทาง   (ทุกคลังใหญ่)',
'3410' => '3410 เครื่องกัดกร่อนด้วยไฟฟ้าและเครื่องกัดกร่อนด้วยอุลตราโซนิกส์  (ทุกคลังใหญ่)',
'3411' => '3411 เครื่องคว้าน  (ทุกคลังใหญ่)',
'3412' => '3412 เครื่องครูด  (ทุกคลังใหญ่)',
'3413' => '3413 เครื่องเจาะและเครื่องทำเกลียว  (ทุกคลังใหญ่)',
'3414' => '3414 เครื่องกัดและตบแต่งเฟือง (ทุกคลังใหญ่)',
'3414' => '3414 เครื่องกัดและตบแต่งเฟือง (ทุกคลังใหญ่)',
'3416' => '3416 เครื่องกลึง (ทุกคลังใหญ่)',
'3417' => '3417 เครื่องกัด (ทุกคลังใหญ่)',
'3418' => '3418 เครื่องไสเรียบและไสขึ้นรูป  (ทุกคลังใหญ่)',
'3419' => '3419 เครื่องมือกลเบ็ดเตล็ด (ทุกคลังใหญ่)',
'3422' => '3422 เครื่องรีดโลหะ (ทุกคลังใหญ่)',
'3424' => '3424 บริภัณฑ์อบชุบโลหะด้วยความร้อนและไม่ใช้ความร้อน  (ทุกคลังใหญ่)',
'3426' => '3426 บริภัณฑ์ตบแต่งผิวโลหะ (ทุกคลังใหญ่)',
'3431' => '3431 บริภัณฑ์เชื่อมด้วยไฟฟ้าแบบอาร์ค (ทุกคลังใหญ่)',
'3432' => '3432  บริภัณฑ์เชื่อมแบบใช้ความต้านทานไฟฟ้า (ทุกคลังใหญ่)',
'3433' => '3433 บริภัณฑ์เชื่อมด้วยก๊าซ ตัดด้วยความร้อนและเครื่องฉาบโลหะ (ทุกคลังใหญ่)',
'3436' => '3436 เครื่องจัดวางและใช้ในการทำงานเกี่ยวกับการเชื่อม   (ทุกคลังใหญ่)',
'3438' => '3438 บริภัณฑ์เบ็ดเตล็ดสำหรับการเชื่อม  (ทุกคลังใหญ่)',
'3439' => '3439 พัสดุและเครื่องประกอบเบ็ดเตล็ดที่ใช้ในการเชื่อม การบัดกรี  (ทุกคลังใหญ่)',
'3441' => '3441 เครื่องดัดและขึ้นรูป (ทุกคลังใหญ่)',
'3442' => '3442 เครื่องกดด้วยไฮโดรริกและเครื่องกดด้วยลมแบบใช้กำลังขับ  (ทุกคลังใหญ่)',
'3443' => '3443 เครื่องกลกดแบบใช้กำลังขับ  (ทุกคลังใหญ่)',
'3444' => '3444 เครื่องกดแบบใช้กำลังคน (ทุกคลังใหญ่)',
'3445' => '3445 เครื่องกดอัดเจาะและเครื่องกลตัดเฉือน (ทุกคลังใหญ่)',
'3446' => '3446 เครื่องกลตีขึ้นรูปและค้อน (ทุกคลังใหญ่)',
'3447' => '3447 เครื่องขึ้นรูปเป็นเส้นลวด และแถบโลหะ (ทุกคลังใหญ่)',
'3448' => '3448 เครื่องย้ำสลัก  (ทุกคลังใหญ่)',
'3449' => '3449 เครื่องกลเบ็ดเตล็ดใช้การขึ้นรูปและตัดโลหะขั้นที่สอง  (ทุกคลังใหญ่)',
'3450' => '3450 เครื่องมือกลชนิดนำเคลื่อนที่ไปได้  (ทุกคลังใหญ่)',
'3455' => '3455 เครื่องมือตัดสำหรับเครื่องมือกล  (ทุกคลังใหญ่)',
'3456' => '3456 เครื่องมือตัดและขึ้นรูปสำหรับเครื่องจักรกลงานโลหะขั้นที่สอง  (ทุกคลังใหญ่)',
'3456' => '3456 เครื่องมือตัดและขึ้นรูปสำหรับเครื่องจักรกลงานโลหะขั้นที่สอง  (ทุกคลังใหญ่)',
'3461' => '3461 เครื่องประกอบสำหรับเครื่องจักรกลงานโลหะขั้นที่สอง  (ทุกคลังใหญ่)',
'3465' => '3465 โครงยึด สิ่งติดตั้งและแผ่นแบบสำหรับการผลิต   (ทุกคลังใหญ่)',
'3470' => '3470 เครื่องชุด ของเป็นชุดและเครื่องมือเครื่องใช้ประจำโรงเครื่องกล  (ทุกคลังใหญ่)',
'3510' => '3510 บริภัณฑ์ซักรีดและซักแห้งพธ.ทอ.',
'3520' => '3520 บริภัณฑ์ซ่อมรองเท้าพธ.ทอ.',
'3530' => '3530 จักรเย็บผ้าแบบอุตสาหกรรมและโรงซ่อมสิ่งทอเคลื่อนที่พธ.ทอ.',
'3540' => '3540 เครื่องกลห่อพัสดุและบรรจุหีบห่อ  พธ.ทอ.',
'3550' => '3550 เครื่องกลขายของและเครื่องกลที่ทำงานโดยวิธีหยอดเหรียญพธ.ทอ.',
'3590' => '3590 บริภัณฑ์เบ็ดเตล็ดสำหรับการบริการและการค้า พธ.ทอ.',
'3605' => '3605 เครื่องจักรกลและบริภัณฑ์เกี่ยวกับผลิตภัณฑ์อาหาร พธ.ทอ.',
'3610' => '3610 บริภัณฑ์การพิมพ์ การอัดสำเนาและการเย็บเข้าเล่ม พธ.ทอ.',
'3611' => '3611 เครื่องกลสำหรับทำเครื่องหมายแบบอุตสาหกรรม  (ทุกคลังใหญ่)',
'3620' => '3620 เครื่องจักรกลงานพลาสติกและยาง  ชอ., พธ.ทอ.',
'3625' => '3625 เครื่องจักรกลอุตสาหกรรม  พธ.ทอ.',
'3693' => '3693 เครื่องกลการประกอบทางอุตสาหกรรม (ทุกคลังใหญ่)',
'3694' => '3694 ชุดห้องซึ่งต้องการความสะอาดเป็นพิเศษที่มีการควบคุมสภาพแวดล้อม และบริภัณฑ์ที่เกี่ยวข้อง  (ทุกคลังใหญ่)',
'3695' => '3695 เครื่องจักรกลเบ็ดเตล็ดสำหรับอุตสาหกรรมพิเศษ (ทุกคลังใหญ่)',
'3720' => '3720 บริภัณฑ์การเก็บเกี่ยว  พธ.ทอ., ชย.ทอ.',
'3730' => '3730 บริภัณฑ์การรีดนม การเลี้ยงสัตว์ปีกและปศุสัตว์ พธ.ทอ.',
'3740' => '3740 บริภัณฑ์ควบคุมแมลงและเชื้อโรคพธ.ทอ.,ชย.ทอ.,พอ.',
'3770' => '3770 เครื่องอ่าน เครื่องบังเหียนและเทียมลาก แส้และเครื่องตกแต่งที่เกี่ยวข้องที่ใช้กับสัตว์ พธ.ทอ.',
'3920' => '3920 บริภัณฑ์ยกย้ายพัสดุที่ขับเคลื่อนไม่ได้ในตัว (ทุกคลังใหญ่)',
'3990' => '3990 บริภัณฑ์เบ็ดเตล็ดสำหรับยกย้ายวัสดุ (ทุกคลังใหญ่)',
'4010' => '4010 โซ่และลวดเกลียว (ทุกคลังใหญ่)',
'4020' => '4020 เชือกไฟเบอร์ เครื่องเชือกและเชือกฟั่น (ทุกคลังใหญ่)',
'4030' => '4030 ชิ้นต่อสำหรับเชือก สายเคเบิลและโซ่ (ทุกคลังใหญ่)',
'4110' => '4110 บริภัณฑ์การทำความเย็น พธ.ทอ., ชย.ทอ.',
'4130' => '4130 ส่วนประกอบการทำความเย็นและการปรับสภาพอากาศ พธ.ทอ., ชย.ทอ.',
'4140' => '4140 พัดลมเครื่องถ่ายเทอากาศไหลเวียนและบริภัณฑ์เครื่องเป่าลม พัดลมและกลอุปกรณ์อัดดันซึ่งแผนแบบสำหรับใช้กับบริภัณฑ์พธ.ทอ., ชย.ทอ.สอ.ทอ.',
'4220' => '4220 บริภัณฑ์ช่วยชีวิตทางเรือและบริภัณฑ์ประดาน้ำ  พธ.ทอ.',
'4240' => '4240 บริภัณฑ์นิรภัยและกู้ภัย ชอ., สพ.ทอ.,พธ.ทอ., ชย.ทอ.',
'4310' => '4310 เครื่องอัดและสูบสุญญากาศ  (ทุกคลังใหญ่)',
'4320' => '4320 สูบใช้กำลังขับและสูบใช้มือ  (ทุกคลังใหญ่)',
'4330' => '4330 เครื่องกรองแบบใช้แรงหนีศูนย์กลาง แบบกรองแยกแบบใช้ความดัน  (ทุกคลังใหญ่)',
'4410' => '4410 หม้อน้ำใช้งานอุตสาหกรรม  (ทุกคลังใหญ่)',
'4420' => '4420 เครื่องถ่ายเทความร้อนและเครื่องควบแน่นไอน้ำ (ทุกคลังใหญ่)',
'4430' => '4430 เตาหลอม เตาเผาและเตาอบที่ใช้งานอุตสาหกรรม  (ทุกคลังใหญ่)',
'4440' => '4440 เครื่องทำให้แห้ง เครื่องและสารดูดความชื้น (ทุกคลังใหญ่)',
'4460' => '4460 บริภัณฑ์ทำให้อากาศบริสุทธิ์  (ทุกคลังใหญ่)',
'4530' => '4530 เครื่องเผาเชื้อเพลิง  (ทุกคลังใหญ่)',
'4610' => '4610 บริภัณฑ์ทำให้น้ำบริสุทธิ์ (ทุกคลังใหญ่)',
'4710' => '4710 ท่อทาง  (ทุกคลังใหญ่)',
'4720' => '4720 ท่อยางและเครื่องหลอดที่อ่อนตัวได้ (ท่ออ่อน) ท่อยางและเครื่องหลอดที่อ่อนตัวได้ซึ่งไม่มีหัวต่อ ที่มิได้กำหนดไว้ในประเภทอื่น ได้จัดอยู่ในประเภทนี้ แม้ว่าจะได้แผนแบบเป็นพิเศษก็ตาม  (ทุกคลังใหญ่)',
'4730' => '4730 ชิ้นต่อและชิ้นส่วนพิเศษสำหรับท่อทางและท่อยาง   (ทุกคลังใหญ่)',
'4940' => '4940 บริภัณฑ์พิเศษเบ็ดเตล็ดที่ใช้ในโรงงานซ่อมบำรุงและโรงซ่อม  (ทุกคลังใหญ่)',
'5110' => '5110 เครื่องมือชนิดถือมีคม ไม่มีกำลังขับ (ทุกคลังใหญ่)',
'5120' => '5120 เครื่องมือชนิดถือไม่มีคม ไม่มีกำลังขับ (ทุกคลังใหญ่)',
'5130' => '5130 เครื่องมือชนิดถือที่มีกำลังขับ  (ทุกคลังใหญ่)',
'5130' => '5130 เครื่องมือชนิดถือที่มีกำลังขับ  (ทุกคลังใหญ่)',
'5136' => '5136 แป้นทำเกลียวนอก ดอกทำเกลียวในและจำปาสำหรับเครื่องมือชนิดถือ  (ทุกคลังใหญ่)',
'5140' => '5140 หีบใส่เครื่องมือและฮาร์ดแวร์  (ทุกคลังใหญ่)',
'5180' => '5180 Sets, Kits, and Outfits of Hand Tools  (ทุกคลังใหญ่)',
'5182' => '5182 เครื่องชุด ของเป็นชุดและเครื่องมือเครื่องใช้ของเครื่องมือชนิดถือ (ทุกคลังใหญ่)',
'5210' => '5210 เครื่องมือวัดของช่าง  (ทุกคลังใหญ่)',
'5220' => '5220 เครื่องวัดสำหรับการตรวจและเครื่องมือตั้งศูนย์แบบประณีต  (ทุกคลังใหญ่)',
'5280' => '5280 เครื่องชุด ของเป็นชุดและเครื่องมือเครื่องใช้ของเครื่องวัด  (ทุกคลังใหญ่)',
'5305' => '5305 ตะปูเกลียว  (ทุกคลังใหญ่)',
'5306' => '5306 สลักเกลียว  (ทุกคลังใหญ่)',
'5307' => '5307 สลักเกลียวปล่อย  (ทุกคลังใหญ่)',
'5310' => '5310 แป้นเกลียวและแหวนรอง (ทุกคลังใหญ่)',
'5315' => '5315 ตะปู ลิ้มและสลักหรือหมุด  (ทุกคลังใหญ่)',
'5320' => '5320 สลักย้ำ  (ทุกคลังใหญ่)',
'5325' => '5325 กลอุปกรณ์สำหรับยึดและเจาะ  (ทุกคลังใหญ่)',
'5330' => '5330 วัสดุที่ใช้ทำปะเก็น (ทุกคลังใหญ่)',
'5331' => '5331 O – Ring (ทุกคลังใหญ่)',
'5335' => '5335 ตะแกรงโลหะ  (ทุกคลังใหญ่)',
'5340' => '5340 ฮาร์ดแวร์เบ็ดเตล็ด (ทุกคลังใหญ่)',
'5341' => '5341 Brackets (ทุกคลังใหญ่)',
'5345' => '5345 จานขัดและหินขัด (ทุกคลังใหญ่)',
'5350' => '5350 วัสดุสำหรับขัด  (ทุกคลังใหญ่)',
'5355' => '5355 ปุ่มลูกปัดและเข็มชี้ (ทุกคลังใหญ่)',
'5360' => '5360 แหนบแบบขด แบบแผ่นและแบบเส้นลวด แหนบที่ได้แผนแบบพิเศษสำหรับใช้เฉพาะหรือใช้กับบริภัณฑ์เฉพาะแบบ (ทุกคลังใหญ่)',
'5365' => '5365 แหวน แผ่นรองและแผ่นกัน  (ทุกคลังใหญ่)',
'5510' => '5510 ไม้แปรรูปและวัสดุจำพวกไม้  (ทุกคลังใหญ่)',
'5530' => '5530 ไม้อัดและไม่แผ่นบาง  (ทุกคลังใหญ่)',
'5905' => '5905 รีซิสเตอร์  (ทุกคลังใหญ่)',
'5910' => '5910 คาปาซิสเตอร์  (ทุกคลังใหญ่)',
'5915' => '5915 เครื่องกรองความถี่และเน็ทเวิร์ค  (ทุกคลังใหญ่)',
'5920' => '5920 ฟิวส์และเครื่องล่อฟ้า  (ทุกคลังใหญ่)',
'5925' => '5925 สวิตช์ตัดวงจร  (ทุกคลังใหญ่)',
'5930' => '5930 สวิตซ์  (ทุกคลังใหญ่)',
'5935' => '5935 ขั้วต่อไฟฟ้า  (ทุกคลังใหญ่)',
'5940' => '5940 ห่วง ขั้วปลายสายไฟฟ้าและขั้วแถบแยกสายไฟฟ้า  (ทุกคลังใหญ่)',
'5945' => '5945 รีเลย์และโซลินอยด์ (ทุกคลังใหญ่)',
'5950' => '5950 คอยล์และเครื่องแปลงไฟฟ้า  (ทุกคลังใหญ่)',
'5960' => '5960 หลอดอิเล็กตรอนและฮาร์ดแวร์สมทบ (ทุกคลังใหญ่)',
'5961' => '5961 กลอุปกรณ์กึ่งตัวนำและฮาร์ดแวร์สมทบ (ทุกคลังใหญ่)',
'5962' => '5962 กลอุปกรณ์วงจรไมโครอิเล็กทรอนิกส์ (ทุกคลังใหญ่)',
'5970' => '5970 ฉนวนไฟฟ้าและวัสดุที่เป็นฉนวน  (ทุกคลังใหญ่)',
'5975' => '5975 ฮาร์ดแวร์และพัสดุที่เกี่ยวกับไฟฟ้า  (ทุกคลังใหญ่)',
'5977' => '5977 แปรงถ่านและอิเล็กโตรด (ทุกคลังใหญ่)',
'5990' => '5990 ซินโครและรีโซลเวอร์ (ทุกคลังใหญ่)',
'5999' => '5999 ส่วนประกอบเบ็ดเตล็ดเกี่ยวกับไฟฟ้า และอิเล็กทรอนิกส์ (ทุกคลังใหญ่)',
'6105' => '6105 มอเตอร์ไฟฟ้า (ทุกคลังใหญ่)',
'6110' => '6110 บริภัณฑ์ควบคุมเกี่ยวกับไฟฟ้า  (ทุกคลังใหญ่)',
'6130' => '6130 เครื่องแปลงผันกระแสไฟฟ้าชนิดไม่หมุน   (ทุกคลังใหญ่)',
'6135' => '6135 แบตเตอรี่ไพรมารี่ (ทุกคลังใหญ่)',
'6140' => '6140 แบตเตอรี่เซกันดารี่  (ทุกคลังใหญ่)',
'6150' => '6150 บริภัณฑ์เบ็ดเตล็ดเกี่ยวกับการกำลังไฟฟ้าและการจ่ายกระแสไฟฟ้า  (ทุกคลังใหญ่)',
'6230' => '6230 บริภัณฑ์ให้แสงสว่างไฟฟ้าชนิดยกเคลื่อนที่ได้และชนิดมือถือ  (ชย.ทอ., พธ.ทอ.)',
'6240' => '6240 หลอดและโคมไฟฟ้าชนิดต่างๆ  (ทุกหน่วย)',
'6250' => '6250 บัลลาสต์ ที่ยึดหลอดไฟฟ้าและสตาร์ทเตอร์ (ทุกหน่วย)',
'6260' => '6260 สิ่งติดตั้งให้แสงสว่างที่ไม่ใช้ไฟฟ้า  (พธ.ทอ.)',
'6350' => '6350 ระบบให้สัญญาณและแจ้งภัยเบ็ดเตล็ด (ทุกคลังใหญ่)',
'6508' => '6508 เครื่องสำอางและของใช้ในห้องสุขาที่มีตัวยา (พอ., พธ.ทอ.)',
'6532' => '6532 เสื้อผ้าสำหรับรับศัลยกรรมและโรงพยาบาลและสิ่งที่มุ่งประสงค์พิเศษ (พธ.ทอ.)',
'6630' => '6630 เครื่องวิเคราะห์ทางเคมี  (ทุกคลังใหญ่)',
'6636' => '6636  ห้องปรับสภาพแวดล้อมและบริภัณฑ์ที่เกี่ยวข้อง (ทุกคลังใหญ่)',
'6640' => '6640 พัสดุและบริภัณฑ์ห้องวิทยาศาสตร์ (ทุกคลังใหญ่)',
'6645' => '6645 เครื่องวัดบอกเวลา (ชอ., พธ.ทอ.,พอ.)',
'6650' => '6650 กลอุปกรณ์ทางทัศนะ  (สอ.ทอ., พอ., พธ.ทอ.)',
'6670' => '6670 เครื่องชั่ง  (ชอ., พธ.ทอ.)',
'6675' => '6675 เครื่องมือที่ใช้ในการเขียนแบบ การสำรวจและการทำแผนที่ (พธ.ทอ.,ชย.ทอ., สอ.ทอ.)',
'6680' => '6680 เครื่องวัดการไหลของของเหลวและก๊าซ วัดระดับของของเหลว  (ทุกคลังใหญ่)',
'6685' => '6685 เครื่องวัดและควบคุมความกด อุณหภูมิและความชื้น  (ทุกคลังใหญ่)',
'6695' => '6695 เครื่องวัดร่วมและเครื่องวัดเบ็ดเตล็ด (ทุกคลังใหญ่)',
'6810' => '6810 เคมีภัณฑ์  (ทุกคลังใหญ่)',
'6820' => '6820 สีสำหรับย้อมผ้า (พธ.ทอ.)',
'6830' => '6830 ก๊าซอัดและก๊าซเหลว (ชอ., พธ.ทอ.)',
'6840' => '6840 ยากำจัดแมลงและยาฆ่าเชื้อโรค  (ทุกหน่วย)',
'6850' => '6850 สารเคมีพิเศษเบ็ดเตล็ด (ทุกคลังใหญ่)',
'6910' => '6910 เครื่องช่วยฝึก (ทุกคลังใหญ่)',
'6930' => '6930 กลอุปกรณ์ในการฝึกปฏิบัติการ  (ทุกคลังใหญ่)',
'7105' => '7105 เฟอร์นิเจอร์ที่ใช้ในบ้าน (พธ.ทอ.)',
'7110' => '7110 เฟอร์นิเจอร์ที่ใช้ในสำนักงาน  (พธ.ทอ.)',
'7125' => '7125 ตู้เก็บของ ตู้เก็บเสื้อผ้า ที่เก็บของและชั้นเก็บของ  (พธ.ทอ.)',
'7195' => '7195 เฟอร์นิเจอร์เบ็ดเตล็ดและเฟอร์นิเจอร์ติดตั้งประจำที่  (พธ.ทอ.)',
'7210' => '7210 เครื่องตบแต่งที่ใช้ในบ้าน (พธ.ทอ.)',
'7220' => '7220 เครื่องปูพื้น (ชย.ทอ., พธ.ทอ.)',
'7230' => '7230 ผ้าระบาย ผ้าบังแดดและที่กันแดด (พธ.ทอ.)',
'7240' => '7240 ภาชนะใส่ของที่ใช้ในบ้านและร้านค้า (พธ.ทอ.)',
'7290' => '7290 เครื่องใช้และเครื่องตบแต่งเบ็ดเตล็ดที่ใช้ในบ้านและร้านค้า (พธ.ทอ.)',
'7310' => '7310 บริภัณฑ์ประกอบอาหาร อบอาหารและเสิร์ฟอาหาร (พธ.ทอ.)',
'7320' => '7320 เครื่องใช้และบริภัณฑ์การครัว  (พธ.ทอ.)',
'7330' => '7330 เครื่องมือและเครื่องประกอบอาหาร (พธ.ทอ.)',
'7340' => '7340 เครื่องตัดและเครื่องใช้ประกอบจานอาหาร (พธ.ทอ.)',
'7350' => '7350 เครื่องใช้สำหรับโต๊ะอาหาร  (พธ.ทอ.)',
'7360' => '7360 ชุดเครื่องมือเครื่องประกอบอาหาร การเตรียมและการเสิร์ฟอาหาร (พธ.ทอ.)',
'7420' => '7420 เครื่องจักรคำนวณและเครื่องจักรทำบัญชี (พธ.ทอ.)',
'7430' => '7430 เครื่องพิมพ์ดีดและเครื่องจักรเรียงพิมพ์ที่ใช้ในสำนักงาน (พธ.ทอ.)',
'7460' => '7460 บริภัณฑ์บันทึกชนิดที่มองเห็นได้  (พธ.ทอ.)',
'7490' => '7490 เครื่องจักรเบ็ดเตล็ดที่ใช้ในสำนักงาน (พธ.ทอ.)',
'7510' => '7510 พัสดุที่ใช้ในสำนักงาน (พธ.ทอ.)',
'7520' => '7520 เครื่องประกอบและกลอุปกรณ์ที่ใช้ในสำนักงาน (พธ.ทอ.)',
'7530' => '7530 กระดาษที่ใช้เขียนหรือพิมพ์และแบบพิมพ์ระเบียน (พธ.ทอ.)',
'7540' => '7540 แบบพิมพ์มาตรฐาน (พธ.ทอ.)',
'7610' => '7610 หนังสือและจุลสาร (ทุกหน่วย)',
'7630' => '7630 หนังสือพิมพ์และวารสาร (ทุกหน่วย)',
'7650' => '7650 แบบรูปและคุณลักษณะเฉพาะ  (ทุกหน่วย)',
'7660' => '7660 หนังสือและแผ่นพิมพ์เกี่ยวกับดนตรี (พธ.ทอ.)',
'7670' => '7670 ไมโครฟิล์มที่ผ่านกรรมวิธีแล้ว  (ทุกหน่วย)',
'7690' => '7690 สิ่งพิมพ์เบ็ดเตล็ด  (ทุกหน่วย)',
'7710' => '7710 เครื่องดนตรี พธ.ทอ.',
'7720' => '7720 ชิ้นส่วนและอุปกรณ์เครื่องดนตรี  (พธ.ทอ.)',
'7740' => '7740 แผ่นเสียง  (ทุกหน่วย)',
'7810' => '7810 บริภัณฑ์การกีฬา  (ทุกหน่วย)',
'7820' => '7820 เครื่องเล่นเกม ของเล่น และเครื่องเล่นที่มีล้อ   (ทุกหน่วย)',
'7830' => '7830 บริภัณฑ์ยิมนาสติก และสันทนาการ (ทุกหน่วย) ',
'7910' => '7910 บริภัณฑ์ขัดพื้นและบริภัณฑ์ดูดฝุ่น  (ทุกคลังใหญ่)',
'7920' => '7920 ไม้กวาด แปรง ไม้ถูพื้น และฟองน้ำ (ทุกหน่วย)',
'7930' => '7930 สารประกอบและตัวยาทำความสะอาดและขัดมัน (ทุกหน่วย)',
'8010' => '8010 สี โด๊ป น้ำมันวานิช และผลิตภัณฑ์ที่เกี่ยวข้อง   (ทุกคลังใหญ่)',
'8020' => '8020 แปรงทาสีและพู่กัน (ทุกหน่วย)',
'8030' => '8030 สารประกอบที่ใช้ในการป้องกันรักษาและกันการรั่วซึม  (ทุกคลังใหญ่)',
'8040' => '8040 วัสดุสำหรับติดแน่น (ทุกคลังใหญ่)',
'8105' => '8105 ถุงและกระสอบ  (ทุกคลังใหญ่)',
'8110' => '8110 ถังและกระป๋อง  (ทุกคลังใหญ่)',
'8115' => '8115 หีบ กล่อง และลังโปร่ง (ทุกคลังใหญ่)',
'8120' => '8120 ท่อก๊าซที่ใช้ในทางอุตสาหกรรม และทางการค้า   (ทุกคลังใหญ่)',
'8125' => '8125 ขวดและโอ่งไห  (ทุกหน่วย)',
'8130' => '8130 ล้อม้วนและหลอดม้วน (ทุกหน่วย)',
'8135' => '8135 วัสดุที่ใช้ในการบรรจุหีบห่อ  (ทุกหน่วย)',
'8145' => '8145 ภาชนะบรรจุชนิดพิเศษที่ใช้ในการส่งและการเก็บรักษา  (ทุกคลังใหญ่)',
'8305' => '8305 ผ้า (พธ.ทอ., ชอ., ขส.ทอ.)',
'8310' => '8310 เส้นใยและด้าย (ขส.ทอ., พธ.ทอ., ชอ.)',
'8315' => '8315 วัสดุประกอบเครื่องแต่งกาย  (พธ.ทอ.)',
'8320' => '8320 วัสดุสำหรับยัดเบาะและยัดไส้  (พธ.ทอ.)',
'8325' => '8325 วัสดุขนสัตว์ (พธ.ทอ.)',
'8330' => '8330 หนังสัตว์ (พธ.ทอ.)',
'8335' => '8335 วัสดุประกอบรองเท้าและพื้นรองเท้า (พธ.ทอ.)',
'8340' => '8340 เต็นท์และผ้าคลุมอาบน้ำมัน (พธ.ทอ.)',
'8345' => '8345 ธงต่างๆ (พธ.ทอ.)',
'8405' => '8405 เครื่องแต่งกายชั้นนอกชาย  (พธ.ทอ.)',
'8410' => '8410 เครื่องแต่งกายชั้นนอกหญิง  (พธ.ทอ.)',
'8415' => '8415 อาภรณ์ภัณฑ์ที่มีความมุ่งประสงค์พิเศษ  (พธ.ทอ., ชอ., ชย.ทอ.)',
'8420' => '8420 เครื่องแต่งกายชั้นในและชุดนอนชาย (พธ.ทอ.)',
'8425' => '8425 เครื่องแต่งกายชั้นในและชุดนอนหญิง (พธ.ทอ)',
'8430' => '8430 รองเท้าชาย (พธ.ทอ.)',
'8435' => '8435 รองเท้าหญิง (พธ.ทอ.)',
'8440' => '8440 ถุงเท้า ถุงมือและเครื่องประกอบเครื่องแต่งกายชาย (พธ.ทอ.)',
'8445' => '8445 ถุงเท้า ถุงมือและเครื่องประกอบเครื่องแต่งกายหญิง (พธ.ทอ.)',
'8450' => '8450 เครื่องแต่งกายเด็กและทารกและเครื่องประกอบ (พธ.ทอ.)',
'8450' => '8450 เครื่องแต่งกายเด็กและทารกและเครื่องประกอบ (พธ.ทอ.)',
'8460' => '8460 กระเป๋าเดินทาง (พธ.ทอ.)',
'8465' => '8465 บริภัณฑ์ประจำกาย (พธ.ทอ.)',
'8510' => '8510 น้ำหอม เครื่องประเทืองผิว และแป้งฝุ่น (ทุกหน่วย)',
'8520' => '8520 สบู่หอม เครื่องสำอางที่ใช้ในการโกนหนวดและทำความสะอาดฟัน   (ทุกหน่วย)',
'8530' => '8530 ของใช้เกี่ยวกับการสุขาสำหรับบุคคล (ทุกหน่วย)',
'8540' => '8540 ผลิตภัณฑ์กระดาษที่ใช้เกี่ยวกับการสุขา (ทุกหน่วย)',
'8710' => '8710  อาหารสัตว์  (ทุกหน่วย)',
'8720' => '8720 ปุ๋ย  (ทุกหน่วย)',
'8730' => '8730 เมล็ดพืชและไม้เพาะ ไม้ชำ  (ทุกหน่วย)',
'8810' => '8810 สัตว์มีชีวิตที่เลี้ยงเป็นอาหาร  (ทุกหน่วย)',
'8820' => '8820 สัตว์ที่มีชีวิตที่มิได้เลี้ยงเป็นอาหาร  (ทุกหน่วย)',
'8905' => '8905 เนื้อ เป็ด ไก่ และปลา (ทุกหน่วย)',
'8910' => '8910 อาหารนมและไข่ (ทุกหน่วย)',
'8915' => '8915 ผลไม้และผัก  (ทุกหน่วย)',
'8920' => '8920 ผลิตภัณฑ์ธัญญาหารและขนม  (ทุกหน่วย)',
'8925' => '8925 น้ำตาล ของกินที่ทำด้วยน้ำตาลและลูกนัท   (ทุกหน่วย)',
'8930' => '8930 แฮม เยลลี่และอาหารถนอม  (ทุกหน่วย)',
'8935' => '8935 ซุปและบูยอง  (ทุกหน่วย)',
'8940' => '8940 อาหารพิเศษลดความอ้วนและอาหารปรุงพิเศษ (ทุกหน่วย)',
'8945' => '8945 อาหารจำพวกน้ำมันและไขมัน (ทุกหน่วย)',
'8950' => '8950 เครื่องปรุงรสประจำโต๊ะและผลิตภัณฑ์ที่เกี่ยวข้อง (ทุกหน่วย)',
'8955' => '8955 กาแฟ ชา และโกโก้  (ทุกหน่วย)',
'8960' => '8960 เครื่องดื่มชนิดไม่มีแอลกอฮอล์  (ทุกหน่วย)',
'8965' => '8965 เครื่องดื่มชนิดมีแอลกอฮอล์ (ทุกหน่วย)',
'8970' => '8970 อาหารกล่อง  (ทุกหน่วย)',
'8975' => '8975 ผลิตภัณฑ์ยาสูบ  (ทุกหน่วย)',
'9110' => '9110 เชื้อเพลิงที่เป็นของแข็ง (ทุกหน่วย)',
'9160' => '9160 ไขมัน น้ำมันหรือน้ำมันสัตว์และขี้ผึ้งเบ็ดเตล็ด (ทุกหน่วย)',
'9310' => '9310 กระดาษและกระดาษแข็ง (พธ.ทอ.)',
'9320' => '9320 วัสดุที่ทำด้วยยาง (ทุกคลังใหญ่)',
'9330' => '9330 วัสดุที่ทำด้วยพลาสติก  (ทุกคลังใหญ่)',
'9340' => '9340 วัสดุที่ทำด้วยแก้ว (ทุกคลังใหญ่)',
'9350' => '9350 วัสดุทนไฟและวัสดุฉาบผิวทนไฟ  (ทุกคลังใหญ่)',
'9390' => '9390 วัสดุที่ไม่ใช่โลหะทำด้วยของเบ็ดเตล็ด  (ทุกคลังใหญ่)',
'9410' => '9410 วัตถุดิบที่ได้จากพฤกษชาติ (ทุกหน่วย)',
'9420' => '9420 เส้นใยที่ได้จากพืชผัก สัตว์และการสังเคราะห์ (ทุกหน่วย)',
'9430' => '9430 ผลิตภัณฑ์ดิบเบ็ดเตล็ดที่ได้จากสัตว์ที่ไม่ใช้เป็นอาหาร  (ทุกหน่วย)',
'9440' => '9440 ผลิตภัณฑ์ดิบเบ็ดเตล็ดที่ได้จากป่าไม้และเกษตรกรรม  (ทุกหน่วย)',
'9450' => '9450 เศษวัตถุที่มิใช่โลหะเว้นสิ่งทอ  (ทุกหน่วย)',
'9505' => '9505 ลวดเหล็กและลวดเหล็กกล้าที่ไม่ใช้ทางด้านไฟฟ้า   (ทุกหน่วย)',
'9510' => '9510 เหล็กและเหล็กกล้าที่เป็นท่อนและแท่งกลม  (ทุกหน่วย)',
'9515' => '9515 เหล็กและเหล็กกล้าที่เป็นแผ่นและแถบ (ทุกคลังใหญ่)',
'9520' => '9520 เหล็กและเหล็กกล้าที่เป็นรูปโครงสร้าง (ทุกคลังใหญ่)',
'9525' => '9525 ลวดโลหะที่ไม่ใช่เหล็กและไม่ใช้ทางด้านไฟฟ้า   (ทุกหน่วย)',
'9530' => '9530 โลหะท่อนที่ไม่ใช่เหล็ก (ทุกคลังใหญ่)',
'9535' => '9535 โลหะแผ่น แถบและแผ่นกระดาษโลหะที่ไม่ใช่เหล็ก   (ทุกหน่วย)',
'9540' => '9540 โลหะรูปโครงสร้างที่ไม่ใช่เหล็ก  (ทุกคลังใหญ่)',
'9545' => '9545 โลหะแผ่น แถบ แผ่นกระดาษโลหะและลวดที่เป็นโลหะมีค่า  (ทุกคลังใหญ่)',
'9610' => '9610 สินแร่ (ทุกคลังใหญ่)',
'9620' => '9620 แร่ธรรมชาติและสังเคราะห์   (ทุกคลังใหญ่)',
'9630' => '9630 วัสดุที่เป็นเชื้อเติมโลหะและโลหะผสมหลัก  (ทุกคลังใหญ่)',
'9640' => '9640 ผลิตภัณฑ์ปฐมภูมิและกึ่งสำเร็จของเหล็กและเหล็กกล้า  (ทุกคลังใหญ่)',
'9650' => '9650 โลหะไม่ใช่เหล็กแบบถลุงแล้ว และแบบผสมแล้ว   (ทุกคลังใหญ่)',
'9660' => '9660 โลหะมีค่าในรูปปฐมภูมิ (ทุกคลังใหญ่)',
'9670' => '9670 เศษเหล็กและเศษเหล็กกล้า  (ทุกคลังใหญ่)',
'9680' => '9680 เศษโลหะที่ไม่ใช่เหล็ก (ทุกคลังใหญ่)',
'9905' => '9905 แผ่นป้ายเครื่องหมายแสดง แผ่นป้ายโฆษณาและแผ่นป้ายแสดงเอกลักษณ์  (ทุกคลังใหญ่)',
'9920' => '9920 เครื่องใช้สำหรับการสูบบุหรี่และไม้ขีดไฟ (ทุกหน่วย)',
'9925' => '9925 พัสดุ เครื่องตกแต่งและบริภัณฑ์เกี่ยวกับพิธีศาสนา (พธ.ทอ.)',
'9930' => '9930 พัสดุและบริภัณฑ์เกี่ยวกับอนุสรณ์สุสาน (พธ.ทอ.)',
'9999' => '9999 รายการเบ็ดเตล็ด  (ทุกคลังใหญ่)',
);
$listCountry = array(
'35'=>'35 Thailand',
'00'=>'00 United  States',
'01'=>'01 United  States',
'11'=>'11 NATO-standard items',
'12'=>'12 West Germany/Germany',
'13'=>'13 Belgium',
'14'=>'14 France',
'15'=>'15 Italy',
'16'=>'16 Czech Republic',
'17'=>'17 Netherland',
'18'=>'18 South Africa',
'19'=>'19 Brazil',
'20'=>'20 Canada',
'21'=>'21 Canada',
'22'=>'22 Denmark',
'23'=>'23 Greece',
'24'=>'24 Iceland',
'25'=>'25 Norway',
'26'=>'26 Portugal',
'27'=>'27 Turkey',
'28'=>'28 Luxembourg',
'29'=>'29 Argentine',
'30'=>'30 Japan ',
'31'=>'31 Israel',
'32'=>'32 Singapore',
'33'=>'33 Spain',
'34'=>'34 Malaysia',
'36'=>'36 Egypt',
'37'=>'37 Republic of Korea',
'38'=>'38 Estonia',
'39'=>'39 Romania',
'40'=>'40 Slovakia',
'41'=>'41 Austria',
'42'=>'42 Slovenia',
'43'=>'43 Poland',
'44'=>'44 United Nations-standard  items',
'45'=>'45 Indonesia',
'46'=>'46 Philippines',
'47'=>'47 Lithuania',
'48'=>'48 Fiji',
'49'=>'49 Tonga',
'50'=>'50 Bulgaria',
'51'=>'51 Hungary',
'52'=>'52 Chile',
'53'=>'53 Croatia',
'54'=>'54 Republic of Macedonia',
'55'=>'55 Latvia',
'56'=>'56 Oman',
'57'=>'57 Russian Federation',
'58'=>'58 Finland',
'59'=>'59 Albania',
'60'=>'60 Kuwait',
'61'=>'61 Ukraine',
'63'=>'63 Morocco',
'64'=>'64 Sweden',
'65'=>'65 Papua New Guinea',
'66'=>'66 Australia',
'67'=>'67 Afghanistan',
'68'=>'68 Georgia',
'70'=>'70 Saudi Arabia',
'71'=>'71 United Arab Emirates',
'72'=>'72 India',
'73'=>'73 Serbia',
'74'=>'74 Pakistan',
'75'=>'75 Bosnia-Herzegovina',
'76'=>'76 Brunei',
'77'=>'77 Montenegro',
'78'=>'78 Jordan',
'79'=>'79 Peru',
'98'=>'98 New Zealand',
'99'=>'99 United Kingdom',
);
$gpsc = yii\helpers\ArrayHelper::map(app\models\CatalogGpsc::find()->all(),'gpsc',
function($data){
  return $data['gpsc']." : ".$data['desc'];
});
$group = yii\helpers\ArrayHelper::map(app\models\CatalogGroup::find()->all(),'id','name');
?>
<div class="catalog-item-form">

    <?php $form = ActiveForm::begin(); ?>
      <div class="row">
        <div class="col-md-6">
          <label>ประเภทพัสดุ</label>
          <?= Select2::widget([
                  'name' => 'category',
                  'data' => $listCategory,
                  'options' => [
                      'placeholder' => 'เลือกประเภทพัสดุ ...',
                      'options' => [
                          $cat => ['selected' => true],
                      ]
                  ],
              ])
          ?>
        </div>
        <div class="col-md-2">
          <label>ประเทศผู้ผลิต</label>
          <?= Select2::widget([
                  'name' => 'country',
                  'data' => $listCountry,
                  'options' => [
                      'placeholder' => 'เลือกประเทศผู้ผลิต ...',
                      'options' => [
                          $country => ['selected' => true],
                      ]
                  ],
              ]);
          ?>
        </div>
        <div class="col-md-4">
          <?= $form->field($model, 'gpsc')->widget(Select2::classname(), [
                  'name' => 'country',
                  'data' => $gpsc,
                  'options' => [
                      'placeholder' => 'ค้นรหัส GPSC ...',
                      //'multiple' => true
                  ],
              ])->label('รหัส GPSC');
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <label>กลุ่มพัสดุ</label>
          <?= Select2::widget([
                  'name' => 'group',
                  'data' => $group,
                  'options' => [
                      'placeholder' => 'เลือกกลุ่มพัสดุ ...',
                      'options' => [
                          $sgroup => ['selected' => true],
                      ]
                  ],
              ])
          ?>
        </div>
        <div class="col-md-8">
          <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('ชื่อพัสดุ') ?>
        </div>
      </div>
    <div class="row">
      <div class="col-md-12">
        <?= $form->field($model, 'parent_nsn')->widget(Select2::classname(), [
                'name' => 'parent_nsn',
                'data' => $parent_nsn,
                'options' => [
                    'placeholder' => 'เลือกพัสดุหลัก ...',
                ],
            ])->label('พัสดุหลัก') ?>
      </div>
    </div>
      <div class="row">
        <div class="col-md-6">
          <?= $form->field($model, 'nsn')->textInput(['maxlength' => true,'readonly'=>true]) ?>
        </div>
        <div class="col-md-3">
          <?= $form->field($model, 'unit_issue')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
          <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>
      </div>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->beginBlock('script') ?>
<script>
  var num1,num2,num3;
  $(document).ready(function() {
    if (window.location.href.indexOf("update") != -1){
      $('#w1').attr('disabled',true);
      $('#w2').attr('disabled',true);
      $('#w3').attr('disabled',true);
      $('#catalogitem-gpsc').attr('disabled',true);
      $('#catalogitem-parent_nsn').attr('disabled',true);
      //$('#catalogitem-nsn').attr('readonly',true);
    }
  });
  $('#w1').change(function(event) {
      num1 = $(this).val();
      displayNsn();
  });
  $('#w2').change(function(event) {
      num2 = $(this).val();
      displayNsn();
  });
  $('#w3').change(function(event) {
    $.get( "limit-niin?id=" + $(this).val(), function(data){
      num3 = data;
      displayNsn();
    });
  });
  function displayNsn(){
    if (window.location.href.indexOf("create") != -1){
      if(num1 && num2 && num3){
        $('#catalogitem-nsn').val(num1 + num2 + num3);
      }
    }
  }
</script>
<?php $this->endBlock() ?>