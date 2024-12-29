<style>
    .prev-img {
        width: 80px;
        height: 120px;
        object-fit: cover;
        display: block; /* للتأكد من عدم وجود فراغ حول الصورة */
    }

    .gallery-wrapper {
        display: flex;
        gap: 5px;
        align-items: flex-start; /* لجعل الصور تصطف من الأعلى */
    }

    .gallery-wrapper div {
        position: relative;
        display: inline-block; /* لاحتواء الصورة والمحتوى بشكل محكم */
        width: 80px; /* مطابقة عرض الصورة */
        height: 120px; /* مطابقة ارتفاع الصورة */
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
    .prev{
        display: none;
    }
</style>



<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label>English Name</label>
            <input type="text" name="name_en" class="form-control @error('name_en')
             is-invalid  @enderror"
                placeholder="English Name" value="{{ old('name_en', $product->name_en) }}" />

            @error('name_en')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror

        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label>Arabic Name</label>
            <input type="text" name="name_ar"
                class="form-control @error('name_ar')
             is-invalid  @enderror" placeholder="Arabic Name"
                value="{{ old('name_ar', $product->name_ar) }}" />

            @error('name_ar')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror

        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Image</label>
            <input type="file" onchange="showImage(event)" name="image"
                class="form-control @error('image')
             is-invalid  @enderror" />

            @error('image')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
            @php
                $url = '';
                if ($product->image) {
                    $url = $product->img_path;
                }
            @endphp

            <img width="80" class="prev-img" id="preview" src="{{ $url }}" >

        </div>

    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label>Gallery</label>
            <input type="file" name="gallery[]" multiple
                class="form-control @error('gallery') is-invalid @enderror" />

            @error('gallery')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror

            <!-- عرض صور الـ Gallery إذا كانت موجودة -->
            @if ($product->gallery)
            <div class="gallery-wrapper">

                @foreach ($product->gallery as $item)
                <div>
                    <img width="80" class="prev-img" src="{{ asset('images/' . $item->path) }}">

                    <span onclick="delImg(event, {{ $item->id }})" >x</span>
                </div>
                @endforeach

            </div>

            @endif

            <!-- عرض الصورة الرئيسية إذا كانت موجودة -->
            @php
                $url = '';
                if ($product->img_path) {
                    $url = asset('images/' . $product->img_path);
                }
            @endphp
            @if($url)
                <img width="80" class="prev" id="preview" src="{{ $url }}" >
            @endif
        </div>
    </div>



    <div class="col-md-6">
        <div class="mb-3">
            <label>English Description</label>

            <textarea name="description_en" class="form-control @error('description_en')
            is-invalid  @enderror"
                placeholder="English Description" rows="4">{{ old('description_en', $product->description_en) }}</textarea>

            @error('description')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror

        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Arabic Description</label>

            <textarea name="description_ar" class="form-control @error('description_ar')
            is-invalid  @enderror"
                placeholder="Arabic Description" rows="4">{{ old('description_ar', $product->description_ar) }}</textarea>

            @error('description_ar')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror

        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control @error('price')
             is-invalid  @enderror"
                placeholder="Price" value="{{ old('price', $product->price) }}" />

            @error('price')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror

        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity"
                class="form-control @error('quantity')
             is-invalid  @enderror" placeholder="Quantity"
                value="{{ old('quantity', $product->quantity) }}" />

            @error('quantity')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id"
                class="form-control @error('category_id') is-invalid @enderror">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->trans_name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>

</div>


