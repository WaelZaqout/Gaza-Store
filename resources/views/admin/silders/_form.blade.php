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
            <label>English Title</label>
            <input type="text" name="name_en" class="form-control @error('name_en')
             is-invalid  @enderror"
                placeholder="English Title" value="{{ old('name_en', $silder->name_en) }}" />

            @error('name_en')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror

        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label>Arabic Title</label>
            <input type="text" name="name_ar"
                class="form-control @error('name_ar')
             is-invalid  @enderror" placeholder="Arabic Title"
                value="{{ old('name_ar', $silder->name_ar) }}" />

            @error('name_ar')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror

        </div>
    </div>



    <div class="col-md-6">
        <div class="mb-3">
            <label>English SubTitle</label>

            <textarea name="description_en" class="form-control @error('description_en')
            is-invalid  @enderror"
                placeholder="English SubTitle" rows="4">{{ old('description_en', $silder->description_en) }}</textarea>

            @error('description')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror

        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label>Arabic SubTitle</label>

            <textarea name="description_ar" class="form-control @error('description_ar')
            is-invalid  @enderror"
                placeholder="Arabic SubTitle" rows="4">{{ old('description_ar', $silder->description_ar) }}</textarea>

            @error('description_ar')
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
                if ($silder->image) {
                    $url = $silder->img_path;
                }
            @endphp

            <img width="80" class="prev-img" id="preview" src="{{ $url }}" >

        </div>

    </div>



</div>


