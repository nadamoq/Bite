<?php
return
    [
        'statuses' => [
            'pending'   => 'قيد الانتظار',
            'preparing' => 'جاري التحضير',
            'ready'     => 'جاهز للتسليم',
            'served'    => 'تم التقديم',
            'completed' => 'مكتمل',
        ],
        'order_type_options' => [
            'dine-in'  => 'داخل المطعم',
            'takeaway' => 'سفري',
            'delivery' => 'توصيل',
        ],
        'single' => 'الطلب',
        'plural' => 'الطلبات',
        'item' => 'الصنف',
        'order_number' => 'رقم الطلب',
        'table_number' => 'رقم الطاولة',
        'order_type'   => 'نوع الطلب',
        'user_id'      => 'العميل',
        'user'         => 'المسؤول عن الطلب',
        'status'       => 'حالة الطلب',
        'total_price'  => 'الإجمالي الكلي',

        // تفاصيل عناصر الطلب (Order Items)
        'items'                => 'محتويات الطلب',
        'menuitem_id'          => 'الصنف / الوجبة',
        'quantity'             => 'الكمية',
        'unit_price'           => 'سعر الوحدة',
        'item_total_price'     => 'إجمالي الوجبة',
        'special_instructions' => 'ملاحظات خاصة',

        // إضافات الوجبة (Addons)
        'addons'      => 'الإضافات والمكونات',
        'addon'    => 'الإضافة',
        'addon_price' => 'سعر الإضافة',

        'sections' => [
            'order_info'  => 'تفاصيل الطلب الأساسية',
            'items_info'  => 'الأصناف والوجبة',
            'summary'     => 'الحساب',
        ],
        'instructions.placeholder' => 'مثال: بدون مخلل، زيادة صوص',
        'description' => 'اختر الوجبات والإضافات المطلوبة',
        'labels' => [
            'new_item' => 'صنف جديد',
        ],
    ];
