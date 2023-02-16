<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate(3);
        return view('admin.service.index', compact('services'));
    }

    public function edit($id)
    {
        $service = Service::find($id);
        return view('admin.service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'service_name' => 'required|max:255',
            ],
            [
                'service_name.required' => "กรุณาป้อมชื่อแผนกด้วยครับ",
                'service_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
            ]
        );
        $service_image = $request->file('service_image');

        //อัพเดทภาพและชื่อ
        if ($service_image) {
            //Generate ชื่อภาพ
            $name_gen = hexdec(uniqid());

            //ดึงนามสกุลไฟล์ภาพ
            $img_ext = strtolower($service_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;

            //อัพโหลดและอัพเดทข้อมูล
            $upload_location = 'image/services/';
            $full_path = $upload_location . $img_name;

            //อัพเดทข้อมูล
            Service::find($id)->update([
                'service_name' => $request->service_name,
                'service_image' => $full_path
            ]);

            //ลบภาพเก่าและอัพภาพใหม่แทน
            $old_image = $request->old_image;
            unlink($old_image);
            $service_image->move($upload_location, $img_name);
            return redirect()->route('services')->with('success', "อัพเดทภาพเรียบร้อย");
        }
        //อัพเดทชื่ออย่างเดียว
        else {
            Service::find($id)->update([
                'service_name' => $request->service_name
            ]);
            return redirect()->route('services')->with('success', "อัพเดทชิ่อบริการเรียบร้อย");
        }



        return redirect()->route('services')->with('success', "อัพเดทข้อมูลเรียบร้อย");
    }

    public function store(Request $request)
    {
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'service_name' => 'required|unique:services|max:255',
                'service_image' => 'required|mimes:jpg,jpeg,png'
            ],
            [
                'service_name.required' => "กรุณาป้อมชื่อแผนกด้วยครับ",
                'service_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
                'service_name.unique' => "มีข้อมูลชื่อแผนกนี้ในฐานข้อมูลแล้ว",
                'service_image.required' => "กรุณาใส่ภาพประกอบการบริการ",
                'service_image.mimes' => "นามสกุลไฟล์ภาพไม่ถูกต้อง (jpg,jpeg,png) "
            ]
        );

        //dd($request->service_name , $request->service_image);

        //ก่ารเข้ารหัสรูปภาพ
        $service_image = $request->file('service_image');

        //Generate ชื่อภาพ
        $name_gen = hexdec(uniqid());

        //ดึงนามสกุลไฟล์ภาพ
        $img_ext = strtolower($service_image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;

        //อัพโหลดและบันทึกข้อมูล
        $upload_location = 'image/services/';
        $full_path = $upload_location . $img_name;

        Service::insert([
            'service_name' => $request->service_name,
            'service_image' => $full_path,
            'created_at' => Carbon::now()
        ]);
        $service_image->move($upload_location, $img_name);
        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อย");
    }

    public function delete($id){
        //ลบภาพ
        $img = Service::find($id)->service_image;
        unlink($img);

        //ลบข้อมูลจากฐานข้อมูล
        $delete = Service::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
    }
}
