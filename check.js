
function validateForm() {
    var T_ID = document.getElementById('T_ID').value;
    var T_fname = document.getElementById('T_fname').value;
    var T_lname = document.getElementById('T_lname').value;
    var T_gender = document.getElementById('T_gender').value;
    var T_birthday = document.getElementById('T_birthday').value;
    var T_position = document.getElementById('T_position').value;
    var T_phone = document.getElementById('T_phone').value;
    var T_email = document.getElementById('T_email').value;
    var T_address = document.getElementById('T_address').value;
    var T_img = document.getElementById('T_img').value;
    var T_username = document.getElementById('T_username').value;
    var T_password = document.getElementById('T_password').value;

    // ทำตรวจสอบข้อมูลตามที่ต้องการ
    if (T_ID === '' || T_fname === '' || T_lname === '' || T_gender === 'Choose...' || T_birthday === '' || T_position === '' || T_phone === '' || T_email === '' || T_address === '' || T_img === '' || T_username === '' || T_password === '') {
        Swal.fire({
            icon: 'error',
            title: 'กรุณากรอกข้อมูลให้ครบทุกช่อง',
            text: '',
        });
        return false;
    }

    // ตรวจสอบรูปแบบ email ต่อไปนี้
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!T_email.match(emailPattern)) {
        Swal.fire({
            icon: 'error',
            title: 'รูปแบบ E-gmail ไม่ถูกต้อง',
            text: '',
        });
        return false;
    }

    // ตรวจสอบรูปแบบเบอร์โทรศัพท์ต่อไปนี้
    var phonePattern = /^\d{10}$/;
    if (!T_phone.match(phonePattern)) {
        Swal.fire({
            icon: 'error',
            title: 'รูปแบบเบอร์โทรศัพท์ไม่ถูกต้อง',
            text: '',
        });
        return false;
    }

    // อื่น ๆ ตรวจสอบตามที่ต้องการ

    // ถ้าผ่านการตรวจสอบทั้งหมด
    return true;
}



