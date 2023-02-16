<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## เกี่ยวกับโปรเจค

เป็นโปรเจคตัวอย่างที่ทำจากคลิป Youtube ของช่อง [KongRuksiam](https://www.youtube.com/@KongRuksiamOfficial).
- แรกเริ่มการสร้างโปรเจค Laravel และ การติดตั้ง Laravel Jetstream.
- สร้างข้อมูลหลังบ้าน หน้า Dashboard โดยมีหมวด Uesr , Departments และ Service
- ประกอบด้วย ดู/ลบ/แก้ไข ฐานข้อมูล อัพโหลดรูปภาพและเก็บ ระบบถังขยะกู้คืนข้อมูล ปุ่มยืนยันลบข้อมูล เป็นต้น
- example = ชื่อไฟล์


## เริ่มต้นการใช้งาน

- ติดตั้ง Xampp , Composser , Node.js(อาจจะต้องติ้กติดตั้งส่วนเสริมหรือส่วนขยายที่จำเป็นด้วย) 
- ติดตั้ง Laravel ที่ htdocs ในโฟลเดอร์ xampp CMD
- ติดตั้ง Laravel Jetstream ในโฟลเดอร์โปรเจค CMD (อาจจะไม่จำเป็นต้องติดตั้งหากไม่ใช้หลังบ้าน)
- หากมี Error ทำให้ไม่สามารถติดตั้ง Laravel เกิดปัญหาเกี่ยวกับการแตกไฟล์ zip ให้ติดตั้ง 7zip ตั้งแต่เริ่มต้น (ลบติดตั้งอื่นทั้งหมดแล้วเริ่มติดตั้ง 7zip ก่อน)


## รวมคำสั่งติดตั้ง

ทุกคำสั่งจะใช้ CMD ภายในตัวโปรเจค ยกเว้นการติดตั้ง Laravel จะใช้ CMD ที่ xampp/htdocs

### Laravel Jetstream

- คำสั่งติดตั้ง Laravel Jetstream :composer require laravel/jetstream
- คำสั่งติดตั้ง Jetstream livewire :php artisan jetstream:install livewire

### Laravel

- คำสั่งติดตั้ง Laravel :composer global require laravel/installer
- คำสั่งสร้างโปรเจค Laravel :laravel new example-app
- คำสั่งอัพเดท ข้อมูลตารางโปรเจคไปยัง ฐานข้อมูล :php artisan migrate
- คำสั่งสร้างคอลโทรเลอร์ :php artisan make:controller exampleController
- คำสั่งสร้างโมเดลพร้อมตารางข้อมูล :php artisan make:model example -m
- คำสั่งสร้างตัวกรอกข้อมูลระบบ :php artisan make:middleware example
- คำสั่งเริ่มต้นเซิร์ฟเวอร์ :php artisan serve


## สิ่งที่มีในโปรเจค
- หน้าต้อนรับเข้าสู่ Website welcome.blade.php ได้รับเมื่อสร้าง โปรเจค Laravel

### ระบบหลังบ้าน Laravel Jetstream

- Reister: ชื่อ อิเมล รหัสผ่าน ยืนยันรหัสผ่าน
- Login: อิเมล รหัสผ่าน ปุ่มจดจำ ลืมรหัสผ่าน(ส่งรีเซ็ตรหัสผ่านเช้าเมล)
- Dashboard: แสดงหน้าแรกเข้า
- Navigation-menu: แถบเมนูด้านบนของ Website
- Profile: แก้ไข/ชื่อ อิเมล || เปลี่ยนรหัสผ่าน || ยืนยัน 2 ขั้นตอนโดย Google Authentication || แสดงการเข้าสู่ระบบในคอมแต่ละสถานที่ ปุ่มลบการเข้าสู่ระบบบนคอมเครื่องอื่น(ยกเว้นเครื่องที่เข้าใช้งาน)

### สิ่งที่มีการแก้ไข/เพิ่มเติม

- .env ไฟล์แก้ไข ชื่อโปรเจค ชื่อฐานข้อมูล ตั้งค่าอื่นๆ
- routes/web.php ใช้นำทางไฟล์ต่างๆ
- public ลงไฟล์ภายนอกเพื่อใช้งาน bootstrap,jquery และ ใช้เก็บไฟล์ที่บันทึกเข้าฐานข้อมูล(รูปภาพหรืออื่นๆ)
- app/Models เก็บข้อมูลจากแบบฟอร์มและในฐานข้อมูลเพื่อนำมาใช้งาน
- app/Http/Controllers ตัวควบคุม หรือ ใช้ฟังก์ชันในการทำงานเบื้องหลังเช่น การคำนวณ การจัดเก็บข้อมูลลงฐานข้อมูล เก็บตัวแปรเพื่อใช้ในการแสดงบนหน้า Website
- database/migrations ออกแบบตารางเพื่อเก็บข้อมูลต่างๆในฐานข้อมูล
- view สร้างทั้งโฟลเดอร์และไฟล์ในการอออกแบบหน้าเว็บ แสดงหน้าเว็บต่างๆที่ผู้ใช้เห็น (ทุกไฟล์ต้องมี example.blade.php)
- view/layouts/app.blade.php ใช้เพื่อเส้นทางการใช้งานไฟล์จาก public เช่น bootstrap,jquery,sweetalert2

### รายละเอียดคร่าวๆ ที่ถูกเพิ่มนอกจากที่ติดตั้ง

- หน้า User(Dashboard) แสดงผู้ใช้หรือสมาชิกที่ทำการสมัครสมาชิก แสดงชื่อ อิเมล และวันที่สมัคร
- หน้า Department เพิ่มรายชื่อแผนก ลบ/แก้ไข ขยะกู้คืนข้อมูล แสดงจำนวนรายการจำกัดต่อหน้าเช่น 4 รายการต่อ 1 หน้า
- หน้า Service เพิ่มบริการ ชื่อและภาพ ลบ/แก้ไข ปุ่มยืนยันลบข้อมูล


## เว็บไซต์ที่เกี่ยวข้อง

- **[Laravel-v10.x](https://laravel.com/docs/10.x)**
- **[Laravel Jetstream-v3.x](https://jetstream.laravel.com/3.x/introduction.html)**
- **[พัฒนาเว็บด้วย Laravel Framework 8.x](https://youtu.be/nswjmJBTvZo)**


## ใบอนุญาต

Laravel framework เป็นซอฟต์แวร์โอเพ่นซอร์สที่ได้รับอนุญาตภายใต้ [MIT license](https://opensource.org/licenses/MIT).
