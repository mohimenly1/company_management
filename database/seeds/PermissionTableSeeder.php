<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{

    
$permissions = [
'المستخدمين',
'قائمة المستخدمين',
'صلاحيات المستخدمين',
'اضافة مستخدم',
'تعديل مستخدم',
'حذف مستخدم',

'عرض صلاحية',
'اضافة صلاحية',
'تعديل صلاحية',
'حذف صلاحية',

'الشركات',
'اضافة شركة',
'قائمة الشركات',
'تعديل الشركة',
'حذف الشركة',

'المشاريع',
'قائمة المشاريع',
'المشاريع قيد التنفيذ',
'المشاريع المكتملة',
'المشاريع المتوقفة',
'ارشيف المشاريع',

'اضافة المشروع',
'حذف المشروع',
'تغير حالة المشروع',
'تعديل المشروع',
'ارشفة المشروع',

];
foreach ($permissions as $permission) {
Permission::create(['name' => $permission]);
}
}
}