<div class="card mt-4">
    <div class="card-header bg-secondary text-white d-flex align-items-center">
        <button class="btn btn-light me-2" id="toggleFilter">
            <i class="fas fa-filter"></i> فلترة الطلبات
        </button>
        <input type="text" id="searchOrder" class="form-control w-auto ms-2" placeholder="Search by ID or User" style="max-width: 220px;">
    </div>
</div>

    <div class="card-body" id="filterSection" style="display: none;">
        <div class="row">
            <div class="col-md-3">
                <input type="text" id="searchOrder" class="form-control" placeholder="Search by ID or User">
            </div>
            <div class="col-md-3">
                <select id="filterStatus" class="form-control">
                    <option value="">All Status</option>
                    <option value="Paid">Paid</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" id="startDate" class="form-control">
            </div>
            <div class="col-md-3">
                <input type="date" id="endDate" class="form-control">
            </div>
        </div>
    </div>
