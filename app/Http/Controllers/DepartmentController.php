<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DepartmentController extends Controller
{
    public function index()
    {
        //ดึงข้อมูลแบบดั้งเดิม
        $departments = Department::paginate(3);
        $trashDepartments = Department::onlyTrashed()->paginate(2);
        //จำกัดข้อมูลที่แสดงในหน้า
        //$departments = Department::paginate(3);
///////////////////////////////////////////////////////////////////////////////
        //ดึงข้อมูลแบบ Query Builder
        // $departments = DB::table('departments')->get();
        //$departments = DB::table('departments')->join('users','departments.user_id','users.id')->select('departments.*','users.name')->paginate(3);
        //จำกัดข้อมูลที่แสดงในหน้าแบบ Query Builder
        //$departments = DB::table('departments')->paginate(3);
        return view('admin.department.index',compact('departments','trashDepartments'));
    }

    public function store(Request $request){
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'department_name' => 'required|unique:departments|max:255'
            ],
            [
                'department_name.required' => "กรุณาป้อมชื่อแผนกด้วยครับ",
                'department_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
                'department_name.unique' => "มีข้อมูลชื่อแผนกนี้ในฐานข้อมูลแล้ว"
            ]
        );
        //บันทึกข้อมูล แบบดั้งเดิม
        // $department = new Department;
        // $department->Department_name = $request->department_name;
        // $department->user_id = Auth::user()->id;
        // $department->save();

        //บันทึกข้อมูลแบบ Query Builder
        $data = array();
        $data["department_name"] = $request->department_name;
        $data["user_id"] = Auth::user()->id;
        $data["created_at"] = Carbon::now();
        DB::table('departments')->insert($data);

        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }

    public function edit($id){
        $department = Department::find($id);
        return view('admin.department.edit',compact('department'));
    }

    public function update(Request $request , $id){
        $request->validate(
            [
                'department_name' => 'required|unique:departments|max:255'
            ],
            [
                'department_name.required' => "กรุณาป้อมชื่อแผนกด้วยครับ",
                'department_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
                'department_name.unique' => "มีข้อมูลชื่อแผนกนี้ในฐานข้อมูลแล้ว"
            ]
        );
        $department = Department::find($id)->update([
            'department_name' =>$request->department_name,
            'user_id'=>Auth::user()->id
        ]);
        return redirect()->route('department')->with('success',"อัพเดทข้อมูลเรียบร้อย");
    }

    public function softdelete($id){
        $delete = Department::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
    }

    public function restore($id){
        $restore = Department::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success',"กู้คืนข้อมูลเรียบร้อย");
    }

    public function delete($id){
        $delete = Department::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success',"ลบข้อมูลถาวรเรียบร้อย");
    }

}
