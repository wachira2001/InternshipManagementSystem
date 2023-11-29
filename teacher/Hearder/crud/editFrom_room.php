<?php
require_once '../../../config/conndb.php';
require_once '../../../config/show_data.php';
// ตรวจสอบ session
session_start();
echo '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

if (!isset($_SESSION['username']) || ($_SESSION['role'] !== 'H')) {
    echo '
            <script>
            setTimeout(function() {
            swal({
                title: "คุณไม่มีสิทธิ์ใช้งานหน้านี้",
                type: "error"
            }, function() {
                window.location = "../../../login.php"; // หน้าที่ต้องการให้กระโดดไป
            });
        }, 1000);
    </script>';
    exit();
}
$user = getuserT($conn,$_SESSION['username']);
$major = getmajor($conn);
$R_ID = $_GET['R_ID'];
$room = getroom($conn,$R_ID);
$teachers = getTeacher($conn);
// ปิดการเชื่อมต่อ
$conn = null;
//print_r($teachers);
//return;
?>




<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Best Bootstrap Admin Dashboards">
        <meta name="author" content="Bootstrap Gallery"/>
        <link rel="canonical" href="https://www.bootstrap.gallery/">
        <meta property="og:url" content="https://www.bootstrap.gallery">
        <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
        <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
        <meta property="og:type" content="Website">
        <meta property="og:site_name" content="Bootstrap Gallery">
        <title>แก้ไขข้อมูลแผนก</title>
        <link rel="icon" type="image/png" href="../../assets/icon/ic-home.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
        <style>
            #fonts{
                font-family: 'Mitr', sans-serif;
            }
            #fonts_b{
                font-family: 'Mitr', sans-serif;
                font-weight: bolder;
            }
        </style>

        <link rel="stylesheet" href="../../../assets/css/animate.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.3.4/sweetalert2.min.css">
        <link rel="stylesheet" href="../../../assets/fonts/bootstrap/bootstrap-icons.css">
        <link rel="stylesheet" href="../../../assets/css/main.min.css">
        <link rel="stylesheet" href="../../../assets/vendor/overlay-scroll/OverlayScrollbars.min.css">
    </head>

    <body id="fonts">

    <!-- ส่วนเริ่มต้นของการโหลด -->
    <div id="loading-wrapper">
        <div class="spinner">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
            <div class="line4"></div>
            <div class="line5"></div>
        </div>
    </div>
    <!-- ส่วนจบการโหลด -->

    <!-- ส่วนเริ่มต้นของหน้า -->
    <div class="page-wrapper">

        <!-- ส่วนเริ่มต้นของไซด์บาร์ -->
        <nav class="sidebar-wrapper">

            <!-- ส่วนเริ่มต้นของแบรนด์ในไซด์บาร์ -->
            <div class="sidebar-brand">
                <a href="../index.php" class="logo">
                <span class="avatar">
                    <img src="../../../upload_img/<?php echo $major['M_img'];?>" alt="Admin Dashboards" style="width: auto;height: 100px"/>
                </span>
                </a>
            </div>
            <!-- ส่วนเริ่มต้นของแบรนด์ในไซด์บาร์ -->

            <!-- ส่วนเริ่มต้นของเมนูในไซด์บาร์ -->
            <div class="sidebar-menu">
                <div class="sidebarMenuScroll">
                    <ul>
                        <li class="">
                            <a href="../../index.php">
                                <i class="bi bi-house"></i>
                                <span class="menu-text">หน้าแรก</span>
                            </a>
                        </li>
                        <li class="sidebar-dropdown active">
                            <a href="#">
                                <i class="bi bi-handbag"></i>
                                <span class="menu-text">ข้อมูลทั่วไป</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <?php
                                    if ($user['T_status'] == '1' ) {
                                        ?>

                                        <li>
                                            <a href="showdata_major.php" >ข้อมูลแผนก</a>
                                        </li>
                                        <li>
                                            <a href="showdata_teacher.php">ข้อมูลบุคลากร</a>
                                        </li>
                                        <li>
                                            <a href="showdata_student.php" >ข้อมูลนักศึกษา</a>
                                        </li>
                                        <li>
                                            <a href="showdata_room.php" class="current-page">ข้อมูลห้องเรียน</a>
                                        </li>
                                        <li>
                                            <a href="showdata_company.php" >ข้อมูลสถานประกอบการ</a>
                                        </li>

                                        <?php
                                    }else{

                                        ?>
                                        <li>
                                            <a href="showdata_student.php">ข้อมูลนักศึกษา</a>
                                        </li>
                                        <?php
                                    }
                                    ?>

                                </ul>
                            </div>
                        </li>
                    </ul>
                    <!-- สิ้นสุดรายการเมนู -->
                </div>
            </div>
        </nav>
        <!-- ส่วนจบของเมนูในไซด์บาร์ -->
        <!-- ส่วนจบของไซด์บาร์ -->

        <!-- ส่วนเริ่มต้นของคอนเทนเนอร์หลัก -->
        <div class="main-container">
            <div class="page-header">
                <div class="toggle-sidebar" id="toggle-sidebar"><i class="bi bi-list"></i></div>
                <!-- ส่วนเริ่มต้นของการหลีกเลี่ยงข้อผิดพลาด -->
                <ol class="breadcrumb d-md-flex d-none" >
                    <li class="breadcrumb-item">
                        <i class="bi bi-house"></i>
                        <a href="#">ข้อมูลทั่วไป</a>
                    </li>
                    <li class="breadcrumb-item breadcrumb-active" aria-current="page">
                        <a href="showdata_major.php">ข้อมูลห้องเรียน</a>

                    </li>
                    <li class="breadcrumb-item breadcrumb-active" aria-current="page">
                        <a href="#">ข้อมูลห้องเรียน</a>
                    </li>
                </ol>
                <div class="header-actions-container">
                    <!-- เริ่มต้นของการกระทำของส่วนหัวเรื่อง -->
                    <div>
                        <ul class="header-actions">
                            <!-- เริ่มต้นของดรอปดาวน์ -->
                            <li class="dropdown">
                                <!-- ลิงค์การตั้งค่าผู้ใช้ -->
                                <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                                    <!-- ชื่อผู้ใช้ -->
                                    <span class="user-name d-none d-md-block"><?php echo $user['T_fname']; ?></span>
                                    <!-- รูปประจำตัว -->
                                    <span class="avatar">
                                <img src="../../img/<?php echo $user['T_img']; ?>" alt="Admin Templates">
                                        <!-- สถานะออนไลน์ -->
                                <span class="status online"></span>
                            </span>
                                </a>
                                <!-- เริ่มต้นของเมนูดรอปดาวน์ -->
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
                                    <!-- คำสั่งการดำเนินการในโปรไฟล์ -->
                                    <div class="header-profile-actions">
                                        <a href="../../crud/editFrom_profile.php">โปรไฟล์</a>
                                        <a href="../../../config/logout.php">ออกจากระบบ</a>
                                    </div>
                                    <!-- ส่วนจบของคำสั่งการดำเนินการในโปรไฟล์ -->
                                </div>
                                <!-- ส่วนจบของเมนูดรอปดาวน์ -->
                            </li>
                            <!-- ส่วนจบของดรอปดาวน์ -->
                        </ul>
                    </div>
                    <!-- ส่วนจบของการกระทำของส่วนหัวเรื่อง -->
                </div>
                <!-- ส่วนจบของการกระทำของส่วนหัวเรื่อง -->
            </div>
            <!-- ส่วนจบของคอนเทนเนอร์หลัก -->

            <!-- ส่วนเริ่มต้นของการหลีกเลี่ยงข้อผิดพลาด -->
            <div class="content-wrapper-scroll">

                <!-- ส่วนเริ่มต้นของคอนเทนเนอร์ -->
                <div class="content-wrapper">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-12">

                                <!-- Card start -->
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">แก้ไขข้อมูล</div>
                                    </div>
                                    <form method="post">
                                        <div class="card-body">

                                            <!-- Row start -->
                                            <div class="row">
                                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="mb-3">
                                                        <label for="inputName" class="form-label">รหัสห้อง</label>
                                                        <input type="text" class="form-control" id="inputName" placeholder="Enter Name" name="R_ID"
                                                               value="<?php echo $room['R_ID'];?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="mb-3">
                                                        <label for="inputEmail" class="form-label">ระดับชั้น</label>
                                                        <input type="email" class="form-control" id="inputEmail" placeholder="Enter Email" name="R_level"
                                                               value="<?php echo $room['R_level'];?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="mb-3">
                                                        <label for="inputNumber" class="form-label">ปีการศึกษา</label>
                                                        <input type="text" class="form-control" id="inputNumber" placeholder="Enter Phone Number" name="R_year"
                                                               value="<?php echo $room['R_year'];?> " readonly>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="mb-3">
                                                        <label for="inputNumber" class="form-label">ชื่อนักเรียน</label>
                                                        <input type="text" class="form-control" id="inputNumber" placeholder="Enter Phone Number" name="S_fname"
                                                               value="<?php echo $room['S_fname'];?> <?php echo $room['S_lname'];?> "  readonly>
                                                        <input type="hidden" class="form-control" id="inputNumber" name="S_ID"
                                                               value="<?php echo $room['S_ID'];?> " readonly>
                                                    </div>
                                                </div>

                                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="mb-3">
                                                        <label for="inputNumber" class="form-label">แผนก</label>
                                                        <input type="text" class="form-control" id="inputNumber" placeholder="Enter Phone Number" name="S_major"
                                                               value="<?php echo $room['S_major'];?>"  readonly>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-sm-4 col-12">
                                                    <div class="mb-3">
                                                        <label for="T_ID" class="form-label">เลือกครู (T_ID):</label>
                                                        <select name="T_ID" id="T_ID" class="form-select" required>
                                                            <?php foreach ($teachers as $teacher) : ?>
                                                                <?php
                                                                // เช็คว่า T_ID ของครูนี้เท่ากับ T_ID ที่ต้องการให้เป็นค่าเริ่มต้นหรือไม่
                                                                $selected = ($teacher['T_ID'] == $room['T_ID']) ? 'selected' : '';
                                                                ?>
                                                                <option name="T_ID" value="<?php echo $teacher['T_ID']; ?>" <?php echo $selected; ?>>
                                                                    <?php echo $teacher['T_fname']; ?>  <?php echo $teacher['T_lname']; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Row end -->

                                                <!-- Form actions footer start -->
                                                <div class="form-actions-footer">
                                                    <button class="btn btn-light" type="button" onclick="showConfirmation()">ยกเลิก</button>
                                                    <button class="btn btn-success" type="button" onclick="saveData()">บันทึก</button>
                                                </div>
                                                <!-- Form actions footer end -->

                                            </div>
                                        </div>
                                    </form>

                                    <!-- Card end -->

                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <!-- ส่วนจบของคอนเทนเนอร์ -->

                <!-- เริ่มต้นของ App Footer -->
                <div class="app-footer">
                    <span>สาขาเทคโนโลยีธุรกิจดิจิทัล</span>
                </div>
                <!-- ส่วนจบของ App Footer -->
            </div>

        </div>

        <!-- ส่วนจบของคอนเทนเนอร์ -->

        <!-- ส่วนจบของหน้า -->

        <!-- เริ่มต้นของไฟล์ JavaScript ที่จำเป็น -->
        <script src="../../../assets/js/jquery.min.js"></script>
        <script src="../../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../../assets/js/modernizr.js"></script>
        <script src="../../../assets/js/moment.js"></script>

        <!-- เริ่มต้นของไฟล์ JavaScript ของ Vendor -->
        <script src="../../../assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js"></script>
        <script src="../../../assets/vendor/overlay-scroll/custom-scrollbar.js"></script>
        <script src="../../../assets/vendor/apex/apexcharts.min.js"></script>
        <script src="../../../assets/vendor/apex/custom/sales/salesGraph.js"></script>
        <script src="../../../assets/vendor/apex/custom/sales/revenueGraph.js"></script>
        <script src="../../../assets/vendor/apex/custom/sales/taskGraph.js"></script>

        <!-- ไฟล์ JavaScript หลัก -->
        <script src="../../../assets/js/main.js"></script>
        <script>
            document.getElementById('imageInput').addEventListener('change', function (e) {
                var preview = document.getElementById('previewImage');
                var file = e.target.files[0];
                var reader = new FileReader();

                reader.onloadend = function () {
                    preview.src = reader.result;
                };

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    preview.src = "#";
                }
            });

            // เมื่อกดปุ่ม "บันทึก" หรือ "อัพโหลดใหม่"
            function saveImage() {
                // ส่งข้อมูลรูปภาพไปยังเซิร์ฟเวอร์
                // ทำการอัพเดทในฐานข้อมูล
                // หลังจากอัพเดทสำเร็จ, ทำการแทนที่รูปภาพเก่าด้วยรูปภาพใหม่
                document.getElementById('currentImage').src = document.getElementById('previewImage').src;
            }
            function showConfirmation() {
                // แสดง SweetAlert หรือโค้ดที่ใช้ในการยืนยันก่อนที่จะยกเลิก
                Swal.fire({
                    title: 'คุณแน่ใจหรือไม่?',
                    text: 'การกระทำนี้จะยกเลิกขั้นตอนที่คุณทำ',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'ใช่, ยกเลิก!',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // กระทำเมื่อยืนยัน
                        window.location.href = 'showdata_room.php';
                    }
                });
            }
            function saveData() {
                Swal.fire({
                    title: 'คุณแน่ใจหรือไม่?',
                    text: 'ที่จะบันทึกการแก้ไขข้อมูล',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่, บันทึก!',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.querySelector('form').submit();
                    }
                });
            }

        </script>
    </body>
    </html>
<?php
require_once '../../services_teacher/update_room.php';
?>