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
    <!-- English Name -->
    <div class="col-md-6">
        <div class="mb-3">
            <label>ID </label>
            <input type="text" name="id" class="form-control @error('id') is-invalid @enderror"
                placeholder="id" value="{{ old('id', $order->id) }}" />
            @error('id')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <!-- English Name -->
    <div class="col-md-6">
        <div class="mb-3">
            <label>user_id </label>
            <input type="text" name="user_id" class="form-control @error('user_id') is-invalid @enderror"
                placeholder="user_id" value="{{ old('user_id', $order->user_id) }}" />
            @error('user_id')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>





    <!-- Price -->
    <div class="col-md-4">
        <div class="mb-3">
            <label>total_price</label>
            <input type="number" name="price" class="form-control @error('total_price') is-invalid @enderror"
                placeholder="total_price" value="{{ old('total_price',$order->total_price) }}" />
            @error('total_price')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>


    <div class="col-md-6">
        <div class="mb-3">
            <label>status </label>
            <input type="text" name="status" class="form-control @error('status') is-invalid @enderror"
                placeholder="status" value="{{ old('status',$order->payment ? $order->payment->status : 'pending') }}" />
            @error('status')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>



    <div class="col-md-6">
        <div class="mb-3">
            <label>created_at </label>
            <input type="text" name="created_at" class="form-control @error('created_at') is-invalid @enderror"
                placeholder="created_at" value="{{ old('created_at',$order->created_at->format('Y-m-d H:i')) }}" />
            @error('created_at')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>updated_at </label>
            <input type="text" name="updated_at" class="form-control @error('updated_at') is-invalid @enderror"
                placeholder="updated_at" value="{{ old('updated_at',$order->updated_at->format('Y-m-d H:i')) }}" />
            @error('updated_at')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
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
