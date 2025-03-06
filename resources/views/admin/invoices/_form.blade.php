

@if (session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- row -->
<div class="row">
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.invoices.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                {{ csrf_field() }}

                {{-- رقم الفاتورة وتواريخ الفاتورة --}}
                <div class="row">
                    <div class="col">
                        <label for="invoice_number" class="control-label">رقم الفاتورة</label>
                        <input type="text" class="form-control" name="invoice_number" required>
                    </div>

                    <div class="col">
                        <label>تاريخ الفاتورة</label>
                        <input class="form-control fc-datepicker" name="invoice_date" type="text" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="col">
                        <label>تاريخ الاستحقاق</label>
                        <input class="form-control fc-datepicker" name="due_date" type="text" required>
                    </div>
                </div>

             <div class="row">
               <!-- المستخدم -->
                <div class="col">
                    <label for="user_id" class="control-label">المستخدم</label>
                    <input type="text" class="form-control" name="user_id" value="{{ $order->user->id }}-{{ $order->user->name }}" readonly>
                </div>
                {{-- الطلب والمستخدم --}}
                   <!-- رقم الطلب -->
                <div class="col">
                    <label for="order_id" class="control-label">رقم الطلب</label>
                    <input type="text" class="form-control" name="order_id" value="{{ $order->id }}" readonly>
                </div>

            </div>


                {{-- القيم المالية --}}
                <div class="row">
                    <div class="col">
                        <label for="amount_collection">مبلغ التحصيل</label>
                        <input type="text" class="form-control" name="amount_collection" value="{{ $order->total_price }}" readonly>

                    </div>

                    <div class="col">
                        <label for="amount_commission">مبلغ العمولة</label>
                        <input type="text" class="form-control" name="amount_commission" value="0" required>
                    </div>

                    <div class="col">
                        <label for="discount">الخصم</label>
                        <input type="text" class="form-control" name="discount" value="0" required>
                    </div>
                </div>

                {{-- الضريبة --}}
                <div class="row">
                    <div class="col">
                        <label for="rate_vat">نسبة ضريبة القيمة المضافة</label>
                        <select name="rate_vat" class="form-control" onchange="calculateVAT()">
                            {{-- <option value="0" selected disabled>حدد النسبة</option> --}}
                            <option value="0">0%</option>
                            <option value="5">5%</option>
                            <option value="10">10%</option>
                        </select>
                    </div>

                    <div class="col">
                        <label for="value_vat">قيمة الضريبة</label>
                        <input type="text" class="form-control" name="value_vat" readonly>
                    </div>

                    <div class="col">
                        <label for="total">الإجمالي شامل الضريبة</label>
                        <input type="text" class="form-control" name="total" readonly>
                    </div>
                </div>

                {{-- حالة الفاتورة --}}
                <div class="row">
                    <div class="col">
                        <label for="status">حالة الطلب</label>
                        <input type="text" class="form-control" name="status" value="{{ $order->status }}" readonly>
                    </div>

                    <div class="col">
                        <label for="payment_date">تاريخ الدفع</label>
                        <input class="form-control fc-datepicker" name="payment_date" type="text"
                               value="{{ $order->status == 'paid' ? $order->updated_at->format('Y-m-d') : '' }}">
                    </div>
                </div>


                {{-- الملاحظات والمرفقات --}}
                <div class="row">
                    <div class="col">
                        <label for="note">ملاحظات</label>
                        <textarea class="form-control" name="note" rows="3"></textarea>
                    </div>
                </div>
                
                <br>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@section('js')
<script>
    function calculateVAT() {
        var amount_commission = parseFloat(document.getElementsByName("amount_commission")[0].value) || 0;
        var discount = parseFloat(document.getElementsByName("discount")[0].value) || 0;
        var rate_vat = parseFloat(document.getElementsByName("rate_vat")[0].value) || 0;

        var taxableAmount = amount_commission - discount;
        var vatValue = (taxableAmount * rate_vat) / 100;
        var total = taxableAmount + vatValue;

        document.getElementsByName("value_vat")[0].value = vatValue.toFixed(2);
        document.getElementsByName("total")[0].value = total.toFixed(2);
    }
</script>
<script>
    $(document).ready(function() {
        $('#user_id').select2({
            placeholder: "حدد المستخدم",
            allowClear: true,
            minimumResultsForSearch: 1, // تمكين البحث
            dropdownAutoWidth: true,
            width: '100%' // الحفاظ على عرض العنصر
        });

        // عند الكتابة في البحث، يتم فتح القائمة بشكل منبثق تلقائي
        $('#user_id').on('select2:open', function() {
            var searchField = $('.select2-search__field'); // الوصول إلى حقل البحث
            searchField.focus(); // تركيز على حقل البحث
        });
    });
</script>
@endsection
