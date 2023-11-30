<?php
require_once 'conndb.php';
try {
    if (
        isset(

            $_POST['T_ID'],
            $_POST['S_ID']

        )
    ) {

        $T_ID = $_POST['T_ID'];
        $S_ID = $_POST['S_ID'];
        $R_ID = $_POST['R_ID'];


        // คำสั่ง SQL UPDATE สำหรับตาราง room
        $updateRoomStmt = $conn->prepare("UPDATE room
                                          SET 
                                               T_ID = :T_ID
                                          WHERE R_ID = :R_ID");

        $updateRoomStmt->bindParam(':T_ID', $T_ID, PDO::PARAM_STR);
        $updateRoomStmt->bindParam(':R_ID', $R_ID, PDO::PARAM_STR);

        // คำสั่ง SQL UPDATE สำหรับตาราง student
        $updateStudentStmt = $conn->prepare("UPDATE student
                                            SET 
                                                 T_ID = :T_ID
                                            WHERE S_ID = :S_ID");

        $updateStudentStmt->bindParam(':T_ID', $T_ID, PDO::PARAM_STR);
        $updateStudentStmt->bindParam(':S_ID', $S_ID, PDO::PARAM_STR);

        // ทำการ execute คำสั่ง SQL
        $updateRoomSuccess = $updateRoomStmt->execute();
        $updateStudentSuccess = $updateStudentStmt->execute();

        if ($updateRoomSuccess && $updateStudentSuccess) {
            // แสดง SweetAlert2 แจ้งว่าปรับปรุงข้อมูลสำเร็จ
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    title: 'สำเร็จ',
                    text: 'ปรับปรุงข้อมูลแผนกเรียบร้อยแล้ว',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 5000
                }).then(function () {
                    window.location.href = '../CRUD/showdata_room.php';
                });
            </script>";
        } else {
            // แสดง SweetAlert2 กรณีเกิดข้อผิดพลาดในการปรับปรุงข้อมูล
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    title: 'ผิดพลาด',
                    text: 'เกิดข้อผิดพลาดในการปรับปรุงข้อมูล',
                    icon: 'error',
                    showConfirmButton: true
                });
            </script>";
        }
    }
} catch (PDOException $e) {
    // แสดง SweetAlert2 กรณีเกิด Exception
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            title: 'ผิดพลาด',
            text: 'เกิดข้อผิดพลาด: {$e->getMessage()}',
            icon: 'error',
            showConfirmButton: true
        });
    </script>";
}
?>
