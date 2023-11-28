<?php
// ฟังก์ชั่นเพื่อดึงข้อมูลครูจากฐานข้อมูล
function getTeacher($conn) {
    try {
        $teacherQuery = $conn->prepare("SELECT T_ID, T_fname FROM teacher");
        $teacherQuery->execute();
        // ดึงข้อมูลทั้งหมดแบบ associative array
        $result = $teacherQuery->fetchAll(PDO::FETCH_ASSOC);

        // คืนค่าข้อมูลครู
        return $result;
    } catch (PDOException $e) {
        // จัดการข้อผิดพลาด (ถ้ามี)
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function getuserS($conn, $username) {
    try {
        // กำหนดคำสั่ง SQL
        $sql = "SELECT * FROM student WHERE S_username = :S_username ";

        // ใช้ PDO statement เพื่อประมวลผลคำสั่ง SQL
        $stmt = $conn->prepare($sql);
        // กำหนดค่า parameter
        $stmt->bindParam(':S_username', $username);

        // ประมวลผลคำสั่ง SQL
        $stmt->execute();

        // ดึงข้อมูลแบบ associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // ส่งข้อมูลกลับ
        return $result;
    } catch (PDOException $e) {
        // จัดการข้อผิดพลาด (ถ้ามี)
        echo "Error: " . $e->getMessage();
        return false;
    }

}
function getuserT($conn, $username) {
    try {
        // กำหนดคำสั่ง SQL
        $sql = "SELECT * FROM teacher WHERE T_username = :T_username ";

        // ใช้ PDO statement เพื่อประมวลผลคำสั่ง SQL
        $stmt = $conn->prepare($sql);
        // กำหนดค่า parameter
        $stmt->bindParam(':T_username', $username);

        // ประมวลผลคำสั่ง SQL
        $stmt->execute();

        // ดึงข้อมูลแบบ associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // ส่งข้อมูลกลับ
        return $result;
    } catch (PDOException $e) {
        // จัดการข้อผิดพลาด (ถ้ามี)
        echo "Error: " . $e->getMessage();
        return false;
    }

}
function getmajor($conn) {
    try {
        // กำหนดคำสั่ง SQL
        $sql = "SELECT * FROM major ";

        // ใช้ PDO statement เพื่อประมวลผลคำสั่ง SQL
        $stmt = $conn->prepare($sql);
        // กำหนดค่า parameter
//        $stmt->bindParam(':S_username', $username);

        // ประมวลผลคำสั่ง SQL
        $stmt->execute();

        // ดึงข้อมูลแบบ associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // ส่งข้อมูลกลับ
        return $result;
    } catch (PDOException $e) {
        // จัดการข้อผิดพลาด (ถ้ามี)
        echo "Error: " . $e->getMessage();
        return false;
    }

}
function getstudenall($conn) {
    try {
        $sqlS = "SELECT student.*, teacher.T_fname, teacher.T_lname 
         FROM student
         INNER JOIN teacher ON student.T_ID = teacher.T_ID";
        $stmtS = $conn->prepare($sqlS);
        $stmtS->execute();
        $result = $stmtS->fetchAll(PDO::FETCH_ASSOC);
        // ส่งข้อมูลกลับ
        return $result;
    } catch (PDOException $e) {
        // จัดการข้อผิดพลาด (ถ้ามี)
        echo "Error: " . $e->getMessage();
        return false;
    }

}
function getteacherall($conn) {
    try {
        $sqlT = "SELECT * FROM teacher WHERE T_status = 0";
        $stmtT = $conn->prepare($sqlT);
        $stmtT->execute();
        $result = $stmtT->fetchAll(PDO::FETCH_ASSOC);
        // ส่งข้อมูลกลับ
        return $result;
    } catch (PDOException $e) {
        // จัดการข้อผิดพลาด (ถ้ามี)
        echo "Error: " . $e->getMessage();
        return false;
    }

}
function getroomall($conn) {
    try {
        $sqlRoom = "SELECT room.*, student.S_fname, student.S_major, teacher.T_fname 
                FROM room
                LEFT JOIN student ON room.S_ID = student.S_ID
                LEFT JOIN teacher ON room.T_ID = teacher.T_ID
                WHERE student.S_ID = room.S_ID AND teacher.T_ID = room.T_ID;";

        $stmtRoom = $conn->prepare($sqlRoom);
        $stmtRoom->execute();

        // เก็บผลลัพธ์ในตัวแปร $result
        $result = $stmtRoom->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        // จัดการข้อผิดพลาด (ถ้ามี)
        echo "Error: " . $e->getMessage();
        return false;
    }

}
function getroom($conn,$R_ID) {
    try {
        $sql = "SELECT room.*, student.S_fname,student.S_major, teacher.T_fname
            FROM room
            LEFT JOIN student ON room.S_ID = student.S_ID
            LEFT JOIN teacher ON room.T_ID = teacher.T_ID
            WHERE room.R_ID = $R_ID";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        // จัดการข้อผิดพลาด (ถ้ามี)
        echo "Error: " . $e->getMessage();
        return false;
    }

}
function getcompanyall($conn) {
    try {
        $sql = "SELECT * FROM company";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // ส่งข้อมูลกลับ
        return $result;
    } catch (PDOException $e) {
        // จัดการข้อผิดพลาด (ถ้ามี)
        echo "Error: " . $e->getMessage();
        return false;
    }

}
function getcompany($conn,$company_ID) {
    try {
        $sql = "SELECT * FROM company WHERE company_ID = $company_ID ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // ส่งข้อมูลกลับ
        return $result;
    } catch (PDOException $e) {
        // จัดการข้อผิดพลาด (ถ้ามี)
        echo "Error: " . $e->getMessage();
        return false;
    }

}
function getstudent($conn,$S_ID) {
    try {
        $sqlS = "SELECT student.*, teacher.T_fname, teacher.T_lname 
         FROM student
         INNER JOIN teacher ON student.T_ID = teacher.T_ID
         WHERE S_ID = $S_ID";
        $stmtS = $conn->prepare($sqlS);
        $stmtS->execute();
        $result = $stmtS->fetch(PDO::FETCH_ASSOC);
        // ส่งข้อมูลกลับ
        return $result;
    } catch (PDOException $e) {
        // จัดการข้อผิดพลาด (ถ้ามี)
        echo "Error: " . $e->getMessage();
        return false;
    }

}
function getTeachers($conn,$T_ID) {
    try {
        $sql = "SELECT * FROM teacher
            WHERE teacher.T_ID = $T_ID";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        // จัดการข้อผิดพลาด (ถ้ามี)
        echo "Error: " . $e->getMessage();
        return false;
    }

}
?>

