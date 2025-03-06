<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number', 50)->unique(); // رقم الفاتورة
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // ربط الفاتورة بالطلب
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ربط الفاتورة بالمستخدم
            $table->date('invoice_date')->nullable(); // تاريخ الفاتورة
            $table->date('due_date')->nullable(); // تاريخ الاستحقاق
            $table->decimal('amount_collection', 8, 2)->nullable(); // المبلغ المحصل
            $table->decimal('amount_commission', 8, 2); // العمولة
            $table->decimal('discount', 8, 2)->nullable(); // الخصم
            $table->decimal('value_vat', 8, 2); // قيمة ضريبة القيمة المضافة
            $table->string('rate_vat', 50); // معدل ضريبة القيمة المضافة
            $table->decimal('total', 8, 2); // الإجمالي
            $table->enum('status', ['pending', 'paid'])->default('pending'); // حالة الطلب
            $table->integer('value_status'); // قيمة الحالة (قد تكون 0 غير مدفوعة، 1 مدفوعة، إلخ)
            $table->text('note')->nullable(); // ملاحظات إضافية
            $table->date('payment_date')->nullable(); // تاريخ الدفع
            $table->softDeletes(); // الحذف الناعم (في حال أردت حذف الفاتورة دون مسحها بالكامل)
            $table->timestamps(); // تواريخ الإنشاء والتحديث
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
