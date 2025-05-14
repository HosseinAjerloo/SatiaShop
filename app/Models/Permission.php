<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable=['name','persian_name'];
    const permission=[

        // category
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
        [
            'name'=>'admin.category.destroy',
            'persian_name'=>'حذف دسته بندی'
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
        [
            'name'=>'admin.product.destroy',
            'persian_name'=>'حذف محصولات '
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
        [
            'name'=>'admin.invoice.service.edit',
            'persian_name'=>' ویرایش فاکتور  سرویس'
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
        [
            'name'=>'admin.menu.destroy',
            'persian_name'=>'حذف منو'
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
        [
            'name'=>'admin.invoice.product.edit',
            'persian_name'=>'ویرایش فاکتور کالا'
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
        [
            'name'=>'admin.chargingTheCapsule.index',
            'persian_name'=>'پذیرش کپسول'
        ],
        [
            'name'=>'admin.chargingTheCapsule.edit',
            'persian_name'=>'ویرایش پذیرش کپسول'
        ],
        [
            'name'=>'admin.sale.index',
            'persian_name'=>'فروش کپسول'
        ],
        [
            'name'=>'admin.resideCapsule.index',
            'persian_name'=>'صفحه رسید های کپسول'
        ],
        [
            'name'=>'admin.invoice.issuance.index',
            'persian_name'=>'صفحه صدور فاکتور'
        ],
        [
            'name'=>'admin.invoice.issuance.operation',
            'persian_name'=>'صفحه سرویس های کپسول'
        ],




    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'permission_roles','permission_id','role_id')->withTimestamps();
    }
}
