<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Permission;

class InsertPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {
        $permissions = [

            [
                "identifier" => "admin.home.index",
                "active" => true,
                "ar" => ["name" => "الرئيسية"],
                "en" => ["name" => "home"],
            ],
            [
                "identifier" => "admin.agencies.index",
                "active" => true,
                "ar" => ["name" => "عرض مكاتب العمل"],
                "en" => ["name" => "list of agencies"],
            ],
            [
                "identifier" => "admin.agencies.create",
                "active" => true,
                "ar" => ["name" => "انشاء مكتب عمل جديد"],
                "en" => ["name" => "create new agency"],
            ],
            [
                "identifier" => "admin.agencies.update",
                "active" => true,
                "ar" => ["name" => "تعديل مكتب العمل"],
                "en" => ["name" => "update of agency"],
            ],
            [
                "identifier" => "admin.agencies.destroy",
                "active" => true,
                "ar" => ["name" => "حذف النشاط"],
                "en" => ["name" => "delete of agency"],
            ],
            [
                "identifier" => "admin.cities.index",
                "active" => true,
                "ar" => ["name" => "عرض المدن"],
                "en" => ["name" => "list of cities"],
            ],
            [
                "identifier" => "admin.cities.create",
                "active" => true,
                "ar" => ["name" => "انشاء مدينه جديد"],
                "en" => ["name" => "create new city"],
            ],
            [
                "identifier" => "admin.cities.update",
                "active" => true,
                "ar" => ["name" => "تعديل مدينة"],
                "en" => ["name" => "update of city"],
            ],
            [
                "identifier" => "admin.cities.destroy",
                "active" => true,
                "ar" => ["name" => "حذف المدينة"],
                "en" => ["name" => "delete of city"],
            ],
            [
                "identifier" => "admin.employers.index",
                "active" => true,
                "ar" => ["name" => "عرض أصحاب العمل"],
                "en" => ["name" => "list of employers"],
            ],
            [
                "identifier" => "admin.employers.create",
                "active" => true,
                "ar" => ["name" => "انشاء صاحب عمل جديد"],
                "en" => ["name" => "create new employer"],
            ],
            [
                "identifier" => "admin.employers.update",
                "active" => true,
                "ar" => ["name" => "تعديل صاحب العمل"],
                "en" => ["name" => "update of employer"],
            ],
            [
                "identifier" => "admin.employers.destroy",
                "active" => true,
                "ar" => ["name" => "حذف صاحب العمل"],
                "en" => ["name" => "delete of employer"],
            ],
            [
                "identifier" => "admin.groups.index",
                "active" => true,
                "ar" => ["name" => "عرض المجموعات"],
                "en" => ["name" => "list of groups"],
            ],
            [
                "identifier" => "admin.groups.create",
                "active" => true,
                "ar" => ["name" => "انشاء مجموعة جديده"],
                "en" => ["name" => "create new group"],
            ],
            [
                "identifier" => "admin.groups.update",
                "active" => true,
                "ar" => ["name" => "تعديل المجموعة"],
                "en" => ["name" => "update of group"],
            ],
            [
                "identifier" => "admin.groups.destroy",
                "active" => true,
                "ar" => ["name" => "حذف المجموعة"],
                "en" => ["name" => "delete of group"],
            ],
            [
                "identifier" => "admin.group.permissions.index",
                "active" => true,
                "ar" => ["name" => "عرض مجموعة الصلاحيات"],
                "en" => ["name" => "list of group permissions"],
            ],
            [
                "identifier" => "admin.group.permissions.create",
                "active" => true,
                "ar" => ["name" => "انشاء مجموعة الصلاحيات جديده"],
                "en" => ["name" => "create new group permissions"],
            ],
            [
                "identifier" => "admin.group.permissions.update",
                "active" => true,
                "ar" => ["name" => "تعديل مجموعة الصلاحيات"],
                "en" => ["name" => "update of group permissions"],
            ],
            [
                "identifier" => "admin.group.permissions.destroy",
                "active" => true,
                "ar" => ["name" => "حذف مجموعة الصلاحيات"],
                "en" => ["name" => "delete of group permissions"],
            ],

            [
                "identifier" => "admin.industries.index",
                "active" => true,
                "ar" => ["name" => "عرض المهن"],
                "en" => ["name" => "list of industries"],
            ],
            [
                "identifier" => "admin.industries.create",
                "active" => true,
                "ar" => ["name" => "انشاء مهنة جديد"],
                "en" => ["name" => "create new industry"],
            ],
            [
                "identifier" => "admin.industries.update",
                "active" => true,
                "ar" => ["name" => "تعديل المهنة"],
                "en" => ["name" => "update of industry"],
            ],
            [
                "identifier" => "admin.industries.destroy",
                "active" => true,
                "ar" => ["name" => "حذف المهنة"],
                "en" => ["name" => "delete of industry"],
            ],
            [
                "identifier" => "admin.industry.roles.index",
                "active" => true,
                "ar" => ["name" => "عرض التخصصات الفرعية"],
                "en" => ["name" => "list of industry roles"],
            ],
            [
                "identifier" => "admin.industry.roles.create",
                "active" => true,
                "ar" => ["name" => "انشاء تخصص فرعى جديد"],
                "en" => ["name" => "create new industry roles"],
            ],
            [
                "identifier" => "admin.industry.roles.update",
                "active" => true,
                "ar" => ["name" => "تعديل تخصص فرعى"],
                "en" => ["name" => "update of industry roles"],
            ],
            [
                "identifier" => "admin.industry.roles.destroy",
                "active" => true,
                "ar" => ["name" => "حذف تخصص فرعى"],
                "en" => ["name" => "delete of industry roles"],
            ],
            [
                "identifier" => "admin.locations.index",
                "active" => true,
                "ar" => ["name" => "عرض اﻷماكن"],
                "en" => ["name" => "list of locations"],
            ],
            [
                "identifier" => "admin.locations.show",
                "active" => true,
                "ar" => ["name" => "عرض اﻷماكن"],
                "en" => ["name" => "show cities of  location"],
            ],
            [
                "identifier" => "admin.locations.create",
                "active" => true,
                "ar" => ["name" => "انشاء مكان جديد"],
                "en" => ["name" => "create new location"],
            ],
            [
                "identifier" => "admin.locations.update",
                "active" => true,
                "ar" => ["name" => "تعديل المكان"],
                "en" => ["name" => "update of location"],
            ],
            [
                "identifier" => "admin.locations.destroy",
                "active" => true,
                "ar" => ["name" => "حذف المكان"],
                "en" => ["name" => "delete of location"],
            ],
            [
                "identifier" => "admin.logs.index",
                "active" => true,
                "ar" => [ "name" => "عرض سجلات" ],
                "en" => [ "name" => "list of logs" ],
            ],
            [
                "identifier" => "admin.permissions.index",
                "active" => true,
                "ar" => ["name" => "عرض الصلحيات"],
                "en" => ["name" => "list of permissions"],
            ],
            [
                "identifier" => "admin.permissions.update",
                "active" => true,
                "ar" => ["name" => "تعديل الصالحية"],
                "en" => ["name" => "update of permission"],
            ],
            [
                "identifier" => "admin.seekers.index",
                "active" => true,
                "ar" => ["name" => "عرض باحثين العمل"],
                "en" => ["name" => "list of seekers"],
            ],
            [
                "identifier" => "admin.seekers.create",
                "active" => true,
                "ar" => ["name" => "انشاء باحث عمل جديد"],
                "en" => ["name" => "create new seeker"],
            ],
            [
                "identifier" => "admin.seekers.update",
                "active" => true,
                "ar" => ["name" => "تعديل باحث عمل"],
                "en" => ["name" => "update of seeker"],
            ],
            [
                "identifier" => "admin.seekers.destroy",
                "active" => true,
                "ar" => ["name" => "حذف باحث عمل"],
                "en" => ["name" => "delete of seeker"],
            ],
            [
                "identifier" => "admin.users.index",
                "active" => true,
                "ar" => ["name" => "عرض المستخدمين"],
                "en" => ["name" => "list of users"],
            ],
            [
                "identifier" => "admin.users.create",
                "active" => true,
                "ar" => ["name" => "انشاء مستخدم جديد"],
                "en" => ["name" => "create new user"],
            ],
            [
                "identifier" => "admin.users.update",
                "active" => true,
                "ar" => ["name" => "تعديل المستخدم"],
                "en" => ["name" => "update of user"],
            ],
            [
                "identifier" => "admin.users.destroy",
                "active" => true,
                "ar" => ["name" => "حذف المستخدم"],
                "en" => ["name" => "delete of user"],
            ],
            [
                "identifier" => "admin.users.group.index",
                "active" => true,
                "ar" => ["name" => "رؤية مجموعات المستخدم"],
                "en" => ["name" => "user's groups"],
            ],
            [
                "identifier" => "admin.blog.index",
                "active" => true,
                "ar" => ["name" => "عرض المدونة"],
                "en" => ["name" => "list of blog"],
            ],
            [
                "identifier" => "admin.blog.create",
                "active" => true,
                "ar" => ["name" => "انشاء المدونة جديد"],
                "en" => ["name" => "create new blog"],
            ],
            [
                "identifier" => "admin.blog.update",
                "active" => true,
                "ar" => ["name" => "تعديل المدونة"],
                "en" => ["name" => "update of blog"],
            ],
            [
                "identifier" => "admin.blog.destroy",
                "active" => true,
                "ar" => ["name" => "حذف المدونة"],
                "en" => ["name" => "delete of blog"],
            ],
    ];

        foreach ($permissions as $permission) {
            $permissionObj = new Permission($permission);
            $permissionObj->identifier = $permission['identifier'];
            $permissionObj->save();
        }
    }

}
