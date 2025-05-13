<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable=['name','persian_name'];
    const permission=[
        [
            'name'=>'charging-the-capsule',
            'persian_name'=>'پذیرش کپسول'
        ],
        [
            'name'=>'sale',
            'persian_name'=>'فروش کپسول'
        ],
        // category
        [
            'name'=>'reside-capsule',
            'persian_name'=>'لیست رسید ها'
        ],
        [
            'name'=>'admin.category.index',
            'persian_name'=>'صفحه دسته بندی ها'
        ],
        [
            'name'=>'admin.category.create',
            'persian_name'=>'افزودن دسته بندی جدید'
        ],
        [
            'name'=>'admin.category.edit',
            'persian_name'=>'ویرایش دسته بندی'
        ],
        //product
        [
            'name'=>'admin.product.index',
            'persian_name'=>'صفحه محصولات'
        ],
        [
            'name'=>'admin.product.create',
            'persian_name'=>'ایجاد محصولات جدید'
        ],
        [
            'name'=>'admin.product.edit',
            'persian_name'=>'ویرایش محصولات '
        ],
        //invoice Service Product
        [
            'name'=>'admin.invoice.service.index',
            'persian_name'=>'صفحه لیست فاکتور سرویس'
        ],
        [
            'name'=>'admin.invoice.service.create',
            'persian_name'=>' ثبت فاکتور جدید سرویس'
        ],
        ///menu
        [
            'name'=>'admin.menu.index',
            'persian_name'=>'صفحه منو ها'
        ],
        [
            'name'=>'admin.menu.create',
            'persian_name'=>'ایجاد منوی جدید'
        ],
        [
            'name'=>'admin.menu.edit',
            'persian_name'=>'ویرایش منو'
        ],
        /// applicationSetting
        [
            'name'=>'admin.setting.index',
            'persian_name'=>'صفحه تنظیمات نرم افزار'
        ],
        [
            'name'=>'admin.setting.edit',
            'persian_name'=>'ویرایش تنظیمات نرم افزار'
        ],
        // finalOrder
        [
            'name'=>'admin.order.index',
            'persian_name'=>'صفحه سفارشات نهایی شده'
        ],
        [
            'name'=>'admin.order.invoiceDetails',
            'persian_name'=>'صفحه لیست جزئیات سفارشات کاربر'
        ],
        //factorList
        [
            'name'=>'admin.order.invoice',
            'persian_name'=>'صفحه لیست تمامی سفارشات'
        ],

        ///invoice goods product
        [
            'name'=>'admin.invoice.product.index',
            'persian_name'=>'صفحه لیست فاکتور کالا'
        ],
        [
            'name'=>'admin.invoice.product.create',
            'persian_name'=>'افزودن کالا به انبار'
        ],
        ///user
        [
            'name'=>'admin.user.index',
            'persian_name'=>'صفحه کاربران'
        ],

        //product transaction
        [
            'name'=>'admin.product.transaction.index',
            'persian_name'=>'صفحه گردش کالا'
        ],
        [
            'name'=>'admin.product.transaction.details',
            'persian_name'=>'جزئیات انبار هر محصول'
        ],

        //brand
        [
            'name'=>'admin.brand.index',
            'persian_name'=>'صفحه برند ها'
        ],
        [
            'name'=>'admin.brand.create',
            'persian_name'=>'ایجاد برند جدید'
        ],
        [
            'name'=>'admin.brand.edit',
            'persian_name'=>'ویرایش برند'
        ],

        //supplier
        [
            'name'=>'admin.supplier.index',
            'persian_name'=>'صفحه تامین کنندگان'
        ],
        [
            'name'=>'admin.supplier.create',
            'persian_name'=>'ایجاد تامین کننده جدید'
        ],
        [
            'name'=>'admin.supplier.edit',
            'persian_name'=>'ویرایش تامین کننده'
        ],

        //user finance transaction
        [
            'name'=>'admin.finance.transaction.index',
            'persian_name'=>'صفحه معین اشخاص'
        ],
        [
            'name'=>'admin.finance.transaction.details',
            'persian_name'=>'صفحه معین اشخاص کاربر خاص'
        ],
        // supplier category
        [
            'name'=>'admin.supplier.category.index',
            'persian_name'=>'صفحه دسته بندی تامین کنندگان'
        ],
        [
            'name'=>'admin.supplier.category.create',
            'persian_name'=>'ایجاد دسته بندی تامین کنندگان'
        ],
        [
            'name'=>'admin.supplier.category.edit',
            'persian_name'=>'ویرایش دسته بندی تامین کنندگان'
        ],

        //role
        [
            'name'=>'admin.role.index',
            'persian_name'=>'صفحه نقش ها'
        ],
        [
            'name'=>'admin.role.edit',
            'persian_name'=>'ویرایش نقش ها'
        ],
        [
            'name'=>'admin.role.create',
            'persian_name'=>'افزودن نقش جدید'
        ],
        [
            'name'=>'admin.role.destroy',
            'persian_name'=>'حذف نقش'
        ],



    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'permission_roles','permission_id','role_id')->withTimestamps();
    }
}
