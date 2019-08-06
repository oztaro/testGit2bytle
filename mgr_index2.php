<?php
session_start();
$user_id=$_SESSION['user_id'];
$level_id=$_SESSION['level_id'];
include '../include/connectdb.php';
include '../include/permission.php';
require("../include/PHPMailer_v5.0.2/class.phpmailer.php");
if($_SESSION['user_id'] == ""){
  echo "Please Login!";
  header('refresh:2;url=../index.php');
  exit();  
}
    $around=$_GET[around];
    $year=$_GET[year];
    //select data user
    $s_eva="SELECT tb_user.user_name, tb_user.user_id,tb_user.full_name,position.position_name,department.department_id,department.department_name FROM tb_user,position,department WHERE tb_user.department_id=department.department_id AND tb_user.position_id=position.position_id AND tb_user.user_id=$user_id";
    $q_eva=mysqli_query($connect,$s_eva);
    $d_eva=mysqli_fetch_assoc($q_eva);

    //select assignpm project
    $s_asspd="SELECT * FROM assignpm,project WHERE assignpm.project_id=project.project_id AND assignpm.user_id=$user_id AND project.project_id!=79 AND project.project_id!=80 AND project.project_id!=81 AND project.project_id!=153 AND project.project_id!=74 AND project.project_id!=76 AND project.project_id!=139 AND project.project_id!=142 AND project.project_id!=143 ORDER BY assignpm.project_id ASC";
    $q_asspd=mysqli_query($connect,$s_asspd);
    $r_assignpm=mysqli_num_rows($q_asspd);

    $date_add = date("d-m-Y");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $d_title['title']; ?></title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
<!-- Side Menu -->
<?php include '../include/user_menu.php'; ?>
<!-- End Side Menu -->
        </div>

<!-- Top Menu -->
<?php include '../include/top_menu.php'; ?>
<!-- End Top Menu -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><small>ใบสรุปการประเมินผลงานพนักงาน</small></small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php if(isset($msg)){echo "$msg";} ?>        
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                  <!-- content here --> 
                  <form action="mgr_index3.php" method="POST" role="form">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <table width="100%" border="0">
                                    <tr>
                                        <td width="95%" align="center">
                                            <h2>ใบสรุปการประเมินผลงานพนักงาน</h2>
                                            <h2>(ระดับ : ผู้จัดการแผนก-สำนักงาน) </h2>
                                        </td>
                                        <td>
                                            <img src="../images/<?=$d_title['images']?>" width="50">
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" border="0" style="margin-top: 20px;">
                                  <tr>
                                    <td width="90%" align="right">วันที่ประเมิน</td>
                                    <td style="border:0px;border-bottom:1px dashed #000;">&nbsp;<?php echo $date_add; ?></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>ปี <?php echo $year; ?></td>
                                  </tr>
                                </table>
                                <table width="100%" border="0">
                                    <?php 
                                    if($around==1){
                                        $ack1='<img src="../images/circle_check.png" width="15">';
                                    }else{
                                        $ack1='<img src="../images/circle.png" width="15">';
                                    }
                                    
                                    if($around==2){
                                        $ack2='<img src="../images/circle_check.png" width="15">';
                                    }else{
                                        $ack2='<img src="../images/circle.png" width="15">';
                                    }

                                    if($around==3){
                                        $ack3='<img src="../images/circle_check.png" width="15">';
                                    }else{
                                        $ack3='<img src="../images/circle.png" width="15">';
                                    }

                                    if($around==4){
                                        $ack4='<img src="../images/circle_check.png" width="15">';
                                    }else{
                                        $ack4='<img src="../images/circle.png" width="15">';
                                    }
                                    ?>

                                    <tr>
                                        <td width="27">ฝ่าย</td>
                                        <td width="350" style="border:0px;border-bottom:1px dashed #000;"><?php echo $d_eva[department_name]; ?></td>
                                        <td width="200" align="right">ช่วงเวลา&nbsp;</td>
                                        <td width="15">
                                          <?php echo $ack1; ?>
                                        <td width="150">ม.ค. - มี.ค.</td>
                                        <td width="15">
                                          <?php echo $ack2; ?>
                                        </td>
                                        <td width="150">เม.ย. - มิ.ย.</td>
                                    </tr>
                                </table>
                                <table width="100%" border="0">
                                    <tr>
                                        <td width="577">ข้อมูลพนักงานที่ถูกประเมิน</td>
                                        <td width="15">
                                          <?php echo $ack3; ?>                                          
                                        </td>
                                        <td width="150">ก.ค. - ก.ย.</td>
                                        <td width="15">
                                          <?php echo $ack4; ?>                                          
                                        </td>
                                        <td width="150">ต.ค. - ธ.ค.</td>
                                    </tr>
                                </table>
                                <table width="100%" border="0">
                                    <tr>
                                        <td width="60">
                                            ชื่อ - สกุล
                                        </td>
                                        <td width="200" style="border:0px;border-bottom:1px dashed #000;">
                                            &nbsp;<?php echo $d_eva[full_name]; ?>
                                        </td>
                                        <td width="50">
                                            ตำแหน่ง
                                        </td>
                                        <td width="350" style="border:0px;border-bottom:1px dashed #000;">
                                            &nbsp;<?php echo $d_eva[position_name]; ?>
                                        </td>
                                        <td width="30">
                                            รหัส
                                        </td>
                                        <td style="border:0px;border-bottom:1px dashed #000;">
                                            &nbsp;<?php echo $d_eva[user_name]; ?>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" border="0">
                                    <tr>
                                        <td width="70">
                                            วันที่เริ่มงาน
                                        </td>
                                        <td width="150" style="border:0px;border-bottom:1px dashed #000;">
                                            &nbsp;
                                        </td>
                                        <td width="60">
                                            วันที่บรรจุ
                                        </td>
                                        <td width="150" style="border:0px;border-bottom:1px dashed #000;">
                                            &nbsp;
                                        </td>
                                        <td width="90">
                                            ตำแหน่งปัจจุบัน
                                        </td>
                                        <td style="border:0px;border-bottom:1px dashed #000;">
                                            &nbsp;<?php echo $d_eva[position_name]; ?>
                                        </td>
                                    </tr>
                                </table>
<?php 
if($r_assignpm>0){
?>
                                <table width="100%" border="0">
                                    <tr>
                                        <td width="115">โครงการที่รับผิดชอบ</td>
                                        <td style="border:0px;border-bottom:1px dashed #000;">
                                            <?php 
                                            $i=1;
                                            while($d_assignpm=mysqli_fetch_assoc($q_asspd)){
                                                echo $i.". ".$d_assignpm[project_name]." ";
                                                $i++;
                                            }
                                            ?>
                                        </td>
                                        <td style="border:0px;border-bottom:1px dashed #000;"></td>
                                        <td style="border:0px;border-bottom:1px dashed #000;"></td>
                                    </tr>
                                </table>
<?php 
}else{
?>
                                <table width="100%" border="0">
                                    <tr>
                                        <td width="115">โครงการที่รับผิดชอบ</td>
                                        <td style="border:0px;border-bottom:1px dashed #000;">
                                            <?php echo $d_eva[department_name]; ?>
                                        </td>
                                        <td style="border:0px;border-bottom:1px dashed #000;"></td>
                                        <td style="border:0px;border-bottom:1px dashed #000;"></td>
                                    </tr>
                                </table>
<?php 
}
?>                              
   
                                <table class="table table-bordered table-hover" style="margin-top: 20px;">
                                    <tdead>
                                        <tr>
                                            <td colspan="2" rowspan="4" align="center" valign="top"><b>หัวข้อประเมิน</b></td>
                                            <td align="center" colspan="10"><b>ระดับคะแนน</b></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="2"><b>ดีมาก</b></td>
                                            <td align="center" colspan="2"><b>ดี</b></td>
                                            <td align="center" colspan="2"><b>พอใช้</b></td>
                                            <td align="center" colspan="4"><b>ควรปรับปรุง</b></td>
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="2"><b>Excellent</b></td>
                                            <td align="center" colspan="2"><b>Good</b></td>
                                            <td align="center" colspan="2"><b>Fair</b></td>
                                            <td align="center" colspan="4"><b>To be improve</b></td>
                                        </tr>
                                        <tr>
                                            <td width="25" align="center"><b>10</b></td>
                                            <td width="25" align="center"><b>9</b></td>
                                            <td width="25" align="center"><b>8</b></td>
                                            <td width="25" align="center"><b>7</b></td>
                                            <td width="25" align="center"><b>6</b></td>
                                            <td width="25" align="center"><b>5</b></td>
                                            <td width="25" align="center"><b>4</b></td>
                                            <td width="25" align="center"><b>3</b></td>
                                            <td width="25" align="center"><b>2</b></td>
                                            <td width="25" align="center"><b>1</b></td>
                                        </tr>
                                    </tdead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2"><b>ส่วนที่ 1 : การรักษาระเบียบวินัย</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">1</td>
                                            <td>
                                                การแต่งกาย<br/>
                                                <u>พิจารณาจาก :</u> การแต่งกายถูกต้องตามกฎระเบียบของบริษัท เช่น ใส่แบบฟอร์มบริษัท, เสื้อผ้าทรงสุภาพตามกาลเทศะ สะอาด รองเท้าหุ้มส้นหรือหุ้มข้อ ไม่นุ่งกางเกงยีนส์ ไม่ใส่รองเท้าแตะ ไม่เอาเสื้ออกนอกชายกางเกง กรณีใส่เสื้อยืดให้ใส่เสื้อฟอร์มทับและกลัดกระดุมทุกเม็ด ทรงผมเรียบร้อย ไม่ไว้ผมยามรุงรัง สำหรับเสื้อยืดแบบฟอร์มบริษัทให้ใส่เฉพาะวันเสาร์ หรือวันที่บริษัทแจ้งเพิ่มไว้เท่านั้น
                                            </td>
                                            <td align="center"><input data-pick10="10" required=""  type="radio" name="caption1" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9"  type="radio" name="caption1" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8"  type="radio" name="caption1" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7"  type="radio" name="caption1" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6"  type="radio" name="caption1" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5"  type="radio" name="caption1" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4"  type="radio" name="caption1" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3"  type="radio" name="caption1" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2"  type="radio" name="caption1" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1"  type="radio" name="caption1" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">2</td>
                                            <td>
                                                การส่งใบลาตามกฎระเบียบ (ไม่นับรวมจำนวนวันลา)<br/>
                                                <u>พิจารณาจาก :</u> การเขียนใบลาล่วงหน้าเพื่อขออนุมัติถูกต้องตามกฎระเบียบของบริษัท หรือโทรแจ้งในกรณีที่มีเหตุจำเป็นต้องลาหยุดกระทันหัน
                                            </td>
                                            <td align="center"><input data-pick10="10" required=""  type="radio" name="caption2" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9"  type="radio" name="caption2" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8"  type="radio" name="caption2" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7"  type="radio" name="caption2" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6"  type="radio" name="caption2" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5"  type="radio" name="caption2" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4"  type="radio" name="caption2" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption2" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2"  type="radio" name="caption2" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1"  type="radio" name="caption2" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">3</td>
                                            <td>
                                               การสแกนนิ้วมือ, ลงเวลาทำงาน ตามกฎระเบียบ<br/>
                                               <u>พิจารณาจาก :</u> การสแกนลายนิ้วมือลงเวลาทำงานอย่าสม่ำเสมอ เมื่อเข้างาน /เลิกงาน, ไม่ลืมสแกนลายนิ้วมือ
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption3" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption3" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption3" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption3" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption3" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption3" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption3" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption3" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption3" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption3" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">4</td>
                                            <td>
                                                ความซื่อสัตย์และจรรยาบรรณ<br/>
                                                <u>พิจารณาจาก :</u> ความมีคุณธรรม จริยธรรม ซื่อสัตย์สุจริต ปฎิบัติงานด้วยความโปร่งใส มีวินัยในตนเอง ยึดมั่นในหลักคุณธรรม จริยธรรมในวิชาชีพ รักษาวาจา เชื่อถือและไว้วางใจได้เสมอ ไม่เอาเปรียบบริษัท การไม่รับอามิสสินจ้าง,คอมมิสชั่น จากผู้รับเหมา หรือ Supplier
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption4" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption4" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption4" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption4" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption4" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption4" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption4" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption4" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption4" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption4" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">5</td>
                                            <td>
                                                กริยามารยาท การพูดจา<br/>
                                                <u>พิจารณาจาก :</u> การใช้คำพูดที่สุภาพและเหมาะสมต่อผู้ร่วมงานการมีกริยามารยาทต่อลูกค้า,ผู้บังคับบัญชา
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption5" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption5" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption5" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption5" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption5" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption5" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption5" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption5" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption5" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption5" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="2"><b>ส่วนที่ 2 : ผลงานและคุณภาพ</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">6</td>
                                            <td>
                                                ความรู้ความชำนาญในการปฏิบัติงาน<br/>
                                                <u>พิจารณาจาก :</u> การเรียนรู้งานที่ได้รับมอบหมาย และปฏิบัติได้ถูกต้อง
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption6" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption6" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption6" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption6" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption6" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption6" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption6" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption6" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption6" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption6" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">7</td>
                                            <td>
                                                ความอุสาหะพากเพียร และความพยายามในการปฏิบัติหน้าที่<br/>
                                                <u>พิจารณาจาก :</u> ความเอาใจใส่ในการปฎิบัติงาน ตั้งใจเรียนรู้ติดตามการแก้ไขข้อบกพร่อง
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption7" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption7" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption7" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption7" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption7" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption7" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption7" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption7" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption7" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption7" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">8</td>
                                            <td>
                                                ความรับผิดชอบในการปฏิบัติงาน<br/>
                                                <u>พิจารณาจาก :</u> ความทุ่มเทรับผิดชอบดูแลบังคับบัญชางานที่ได้รับมอบหมายให้มีประสิทธิภาพตามกำหนดเวลา
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption8" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption8" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption8" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption8" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption8" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption8" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption8" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption8" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption8" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption8" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">9</td>
                                            <td>
                                                ความระเอียดรอบคอบ<br/>
                                                <u>พิจารณาจาก :</u> ความละเอียดและถูกต้องของผลงาน
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption9" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption9" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption9" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption9" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption9" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption9" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption9" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption9" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption9" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption9" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">10</td>
                                            <td>
                                                คุณภาพของงานที่ปฏิบัติตามนโยบายของบริษัท<br/>
                                                <u>พิจารณาจาก :</u> ผลงานเป็นที่น่าพอใจ งานได้มาตรฐาน และมีประสิทธิผลในการทำงาน
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption10" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption10" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption10" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption10" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption10" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption10" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption10" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption10" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption10" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption10" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="2"><b>ส่วนที่ 3 : การพัฒนาตนเองและส่วนรวม</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">11</td>
                                            <td>
                                                สติปัญญาในการเรียนรู้<br/>
                                                <u>พิจารณาจาก :</u> : ความสามารถในการเรียนรู้งานได้ในระยะเวลาอันสั้น, การเรียนรู้งานในตำแหน่งงานที่สูงขึ้น
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption11" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption11" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption11" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption11" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption11" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption11" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption11" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption11" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption11" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption11" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">12</td>
                                            <td>
                                                ไหวพริบ<br/>
                                                <u>พิจารณาจาก :</u> ความฉลาด ว่องไว ในการแก้ไขปัญหาเฉพาะหน้าได้รวดเร็ว และถูกต้อง
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption12" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption12" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption12" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption12" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption12" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption12" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption12" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption12" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption12" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption12" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">13</td>
                                            <td>
                                                การวางตัวในสังคม<br/>
                                                <u>พิจารณาจาก :</u> การวางตัวต่อผู้บริหาร ผู้บังคับบัญชา ผู้ร่วมงาน ให้ผู้เกี่ยวข้องพึงพอใจ เลื่อมใส เคารพนับถือ
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption13" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption13" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption13" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption13" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption13" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption13" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption13" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption13" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption13" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption13" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">14</td>
                                            <td>
                                                มนุษย์สัมพันธ์กับเพื่อนร่วมงาน<br/>
                                                <u>พิจารณาจาก :</u> ความสัมพันธ์อันดีต่อกันกับผู้ใต้บังคับบัญชา ตลอดจนผู้บังคับบัญชา และบุคคลอื่นๆ ที่เกี่ยวข้อง
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption14" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption14" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption14" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption14" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption14" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption14" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption14" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption14" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption14" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption14" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">15</td>
                                            <td>
                                                การทำงานเป็นทีม<br/>
                                                <u>พิจารณาจาก :</u> ให้ความร่วมมือ ช่วยเหลือกับผู้ร่วมงานในการทำงานร่วมกันอย่างสมัครสมาน สามัคคี
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption15" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption15" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption15" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption15" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption15" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption15" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption15" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption15" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption15" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption15" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">16</td>
                                            <td>
                                                ความยืดหยุ่นและความสามารถในการปรับตัว<br/>
                                                <u>พิจารณาจาก :</u> : ปรับปรุงตนเองให้เข้ากับสภาพแวดล้อม และสถานการณ์ต่างๆ กัน และรับฟังความคิดเห็นของผู้ร่วมงาน
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption16" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption16" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption16" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption16" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption16" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption16" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption16" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption16" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption16" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption16" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">17</td>
                                            <td>
                                                ภาวะความเป็นผู้นำ<br/>
                                                <u>พิจารณาจาก :</u> ความสามาถในการสั่งงาน และการบังคับบัญชาผู้อยู่ใต้บังคับบัญชา
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption17" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption17" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption17" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption17" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption17" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption17" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption17" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption17" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption17" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption17" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">18</td>
                                            <td>
                                                การเจรจาต่อรองในทางธุรกิจกับผู้เกี่ยวข้อง<br/>
                                                <u>พิจารณาจาก :</u> ความสามารถในการเจรจาต่อรองธุรกิจ เพื่อปกป้องรักษาผลประโยชน์ของบริษัทที่ดีขึ้น
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption18" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption18" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption18" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption18" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption18" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption18" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption18" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption18" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption18" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption18" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">19</td>
                                            <td>
                                                ความรู้ความสามารถในการบริหาร<br/>
                                                <u>พิจารณาจาก :</u> ความสามารถในการใช้ประสบการณ์การสังเกต ข้อมูลข่าวสาร มากำหนดนโยบาย, กลยุทธ์ หรือ เป้าหมาย
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption19" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption19" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption19" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption19" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption19" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption19" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption19" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption19" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption19" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption19" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td align="center" width="50">20</td>
                                            <td>
                                                ความเสียสละต่อส่วนรวม<br/>
                                                <u>พิจารณาจาก :</u> ความเสียสละในการทำงาน, ดูแลช่วยเหลือ, ให้คำแนะนำผู้ใต้บังคับบัญชา
                                            </td>
                                            <td align="center"><input data-pick10="10" required="" type="radio" name="caption20" id="input " value="10" ></td>
                                            <td align="center"><input data-pick9="9" type="radio" name="caption20" id="input " value="9" ></td>
                                            <td align="center"><input data-pick8="8" type="radio" name="caption20" id="input " value="8" ></td>
                                            <td align="center"><input data-pick7="7" type="radio" name="caption20" id="input " value="7" ></td>
                                            <td align="center"><input data-pick6="6" type="radio" name="caption20" id="input " value="6" ></td>
                                            <td align="center"><input data-pick5="5" type="radio" name="caption20" id="input " value="5" ></td>
                                            <td align="center"><input data-pick4="4" type="radio" name="caption20" id="input " value="4" ></td>
                                            <td align="center"><input data-pick3="3" type="radio" name="caption20" id="input " value="3" ></td>
                                            <td align="center"><input data-pick2="2" type="radio" name="caption20" id="input " value="2" ></td>
                                            <td align="center"><input data-pick1="1" type="radio" name="caption20" id="input " value="1" ></td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="2">คะแนนรวม</td>
                                            <td><p><span id="pick10"></span></p></td>
                                            <td><p><span id="pick9"></span></p></td>
                                            <td><p><span id="pick8"></span></p></td>
                                            <td><p><span id="pick7"></span></p></td>
                                            <td><p><span id="pick6"></span></p></td>
                                            <td><p><span id="pick5"></span></p></td>
                                            <td><p><span id="pick4"></span></p></td>
                                            <td><p><span id="pick3"></span></p></td>
                                            <td><p><span id="pick2"></span></p></td>
                                            <td><p><span id="pick1"></span></p></td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="2">รวมทั้งสิ้น</td>
                                            <td colspan="10"><span id="sumTotal"></span></td>
                                            
                                        </tr>
                                        <tr>
                                            <td colspan="2">คิดเป็นร้อยละ </td>
                                            <td colspan="10"></td>
                                            
                                        </tr>
                                    </tbody>
                                </table>                                
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label>ความเห็น</label>
                                    <textarea name="comment1" id="inputComment1" class="form-control" rows="3" required="required"></textarea>
                                </div>
                            </div>
                        </div> 


                        <br/>  
                        <input  type='hidden' class='form-control' name='user_id'  value='<?php echo $user_id; ?>'>                    
                        <input  type='hidden' class='form-control' name='around'  value='<?php echo $around; ?>'>
                        <input  type='hidden' class='form-control' name='year2'  value='<?php echo $year; ?>'>
                        <input  type="submit" name="submit" value="บันทึก" class="btn btn-primary">
                  </form>                             
                  <!-- content here -->
                  </div>
                </div>
              </div>
            </div>



          </div>
        </div>
        <!-- /page content -->

<!-- footer content -->
<?php include '../include/footer_menu.php'; ?>
<!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>


  </body>
</html>
