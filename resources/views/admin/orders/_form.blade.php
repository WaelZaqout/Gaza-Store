<style>
    .prev-img {
        width: 80px;
        height: 120px;
        object-fit: cover;
        display: block;
    }

    .gallery-wrapper {
        display: flex;
        gap: 5px;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .gallery-wrapper div {
        position: relative;
        display: inline-block;
        width: 80px;
        height: 120px;
    }

    .gallery-wrapper div span {
        position: absolute;
        background: #ff8282;
        color: #fff;
        width: 15px;
        height: 15px;
        top: 5px;
        right: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 12px;
        border-radius: 50%;
        opacity: 0;
        cursor: pointer;
        visibility: hidden;
        transition: all .3s ease;
    }

    .gallery-wrapper div:hover span {
        opacity: 1;
        visibility: visible;
    }

    .gallery-wrapper div span:hover {
        background: #f00;
    }
</style>
<div class="row">

    <!-- رقم الطلب (عرض فقط) -->
    <div class="col-md-6">
        <div class="mb-3">
            <label>رقم الطلب</label>
            <input type="text" class="form-control" value="{{ $order->id }}" readonly />
        </div>
    </div>

    <!-- المستخدم (عرض فقط) -->
    <div class="col-md-6">
        <div class="mb-3">
            <label>اسم المستخدم</label>
            <input type="text" class="form-control" value="{{ $order->user->name ?? 'Non ' }}" readonly />
        </div>
    </div>

    <!-- السعر الإجمالي (عرض فقط) -->
    <div class="col-md-6">
        <div class="mb-3">
            <label>السعر الإجمالي</label>
            <input type="text" class="form-control" value="${{ number_format($order->total_price, 2) }}" readonly />
        </div>
    </div>

    <!-- الحالة (قابلة للتعديل) -->
    <div class="col-md-6">
        <div class="mb-3">
            <label>حالة الدفع</label>
            <select name="status" class="form-control @error('status') is-invalid @enderror">
                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}> pending</option>
                <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>paid</option>

            </select>
            @error('status')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <!-- تاريخ الإنشاء (عرض فقط) -->
    <div class="col-md-6">
        <div class="mb-3">
            <label>تاريخ الإنشاء</label>
            <input type="text" class="form-control" value="{{ $order->created_at->format('Y-m-d H:i') }}" readonly />
        </div>
    </div>

    <!-- آخر تحديث (عرض فقط) -->
    <div class="col-md-6">
        <div class="mb-3">
            <label>آخر تحديث</label>
            <input type="text" class="form-control" value="{{ $order->updated_at->format('Y-m-d H:i') }}" readonly />
        </div>
    </div>

</div>

<script>
    function showImage(event) {
        const preview = document.getElementById("preview");
        preview.src = URL.createObjectURL(event.target.files[0]);
    }

    function delImg(event, id) {
        if (confirm("هل أنت متأكد من حذف هذه الصورة؟")) {
            fetch(`/delete-gallery-image/${id}`, { method: 'DELETE' })
                .then(response => location.reload());
        }
    }
</script>
