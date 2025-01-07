@extends('layouts.master')
@section('content')

<style>
.cke_notification_message,
.cke_notifications_area,
.cke_button__about_icon,
.cke_button__about {
    display: none !important;
}
</style>
    

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <h4 class="py-2 m-4"><span class="text-muted fw-light">Property Home Types</span></h4>

    <div class="row mt-5">
        <!-- Modal -->
        <div class="modal fade" id="createHomeModal" tabindex="-1" aria-labelledby="createHomeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createHomeModalLabel">Add Home Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="createHomeForm">
                            @csrf
                            <div class="row">
                                <!-- Title -->
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label">Home Type Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter type name" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Home Type</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Project Modal -->
        <div class="modal fade" id="editHomeModal" tabindex="-1" aria-labelledby="editHomeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editHomeModalLabel">Edit Home Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editHomeForm" method="POST">
                            <input type="hidden" name="id" id="editId">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="editType">Home Type Name <span class="text-danger">*</span></label>
                                <input id="editType" name="name" type="text" required class="form-control" placeholder="Edit type name">
                                <span class="text-danger error-title"></span>
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card p-lg-4 p-2">
                {{-- <!-- Nav tabs -->
                <div class="container">
                    <div class="row justify-content-center">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#Pending"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">
                                    All Property 
                                    <span class="badge bg-primary"> 5</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#Incomplete"
                                    type="button" role="tab" aria-controls="profile" aria-selected="false">
                                    Buy Property
                                    <span class="badge bg-primary">1</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#Complete"
                                    type="button" role="tab" aria-controls="messages" aria-selected="false">
                                    Rent Property
                                    <span class="badge bg-primary">4</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div> --}}

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="Pending" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h5>Home Type</h5>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="float-end">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createHomeModal">
                                                <i class="bx bx-edit-alt me-1"></i> Create Home Type
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="table-responsive text-nowrap p-3">
                                <table id="datatable1" class="table">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Home Type</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <!-- Data will be dynamically populated here -->
                                    </tbody>
                                </table>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function () {
    // Function to fetch and populate data
    function fetchHomeTypes() {
    $.ajax({
        url: "{{ route('type.list') }}",
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.status) {
                const home = response.data.homeType;

                // Prepare data for DataTable
                const tableRows = home.map((homeType, index) => [
                    index + 1,
                    homeType.name || 'No name',
                    homeType.status == 1
                        ? '<span class="badge bg-label-success me-1">Active</span>'
                        : '<span class="badge bg-label-danger me-1">Inactive</span>',
                    `<div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item edit-button" href="javascript:void(0);" data-id="${homeType.id}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <a class="dropdown-item delete-button" href="javascript:void(0);" data-id="${homeType.id}">
                                <i class="bx bx-trash me-1"></i> Delete
                            </a>
                        </div>
                    </div>`
                ]);

                // Destroy existing DataTable (if initialized)
                if ($.fn.DataTable.isDataTable('#datatable1')) {
                    $('#datatable1').DataTable().clear().destroy();
                }

                // Initialize DataTable with new data
                $('#datatable1').DataTable({
                    data: tableRows,
                    columns: [
                        { title: "SL" },
                        { title: "Name" },
                        { title: "Status" },
                        { title: "Actions" }
                    ],
                    scrollX: true, // Enable horizontal scrolling
                    order: [[0, 'asc']], // Order by SL column descending
                    searching: true,
                    paging: true,
                    ordering: true,
                    pageLength: 10
                });
            } else {
                alert('Failed to retrieve property data.');
            }
        },
        error: function (xhr) {
            console.error("AJAX Error:", xhr);

            if (xhr.responseJSON && xhr.responseJSON.message) {
                alert("Error: " + xhr.responseJSON.message);
            } else if (xhr.responseText) {
                alert("Error: " + xhr.responseText);
            } else {
                alert("An unknown error occurred.");
            }
        }
    });
}

// Call the function to fetch and populate data on page load
fetchHomeTypes();


    $('#createHomeForm').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission behavior

        // Create a FormData object
        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('type.store') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            contentType: false, // Necessary for sending FormData
            processData: false, // Prevents jQuery from converting FormData into a query string
            success: function (response) {
                $('#createHomeModal').modal('hide');
                
                Swal.fire({
                    title: 'Home Type Created!',
                    text: 'Home type created successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#name').val('');
                        fetchHomeTypes();
                    }
                })
            },
            error: function (xhr) { 
                $('.text-danger').text(''); // Clear previous errors
                if (xhr.status === 422) {
                    // Display validation errors
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $('.error-' + key).text(value[0]); 
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong. Please try again later.',
                        icon: 'error',
                    });
                }
            }
        });
    });

    // Edit Home Type
    $(document).on('click', '.edit-button', function () {
        const id = $(this).data('id');
        $.ajax({
            url: "{{ route('type.edit', ':id') }}".replace(':id', id),
            type: 'GET',
            success: function (response) {
                $('#editType').val(response.data.homeType.name);
                $('#editId').val(response.data.homeType.id);
                $('#editHomeModal').modal('show');
            },
            error: function (xhr) {
                alert('Failed to fetch home type data. Please try again.');
                console.error(xhr.responseText);
            },
        });
    })

    // Update Home Type
    $('#editHomeForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission behavior

        // Create a FormData object
        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('type.update', ':id') }}".replace(':id', $('#editId').val()),
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            contentType: false, 
            processData: false, 
            success: function (response) {
                $('#editHomeModal').modal('hide');
                
                Swal.fire({
                    title: 'Home Type Updated!',
                    text: 'Home type updated successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetchHomeTypes();
                    }
                })
            },
            error: function (xhr) {
                $('.text-danger').text(''); // Clear previous errors
                if (xhr.status === 422) {
                    // Display validation errors
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $('.error-' + key).text(value[0]); 
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong. Please try again later.',
                        icon: 'error',
                    });
                }
            }
        });
    });

    // Delete Home Type
    $(document).on('click', '.delete-button', function () {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this element? You will get back any deleted Data",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('type.destroy', ':id') }}".replace(':id', id),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        fetchHomeTypes();
                    },
                    error: function (xhr) {
                        alert('Failed to delete home type. Please try again.');
                        console.error(xhr.responseText);

                    }
                });
            }
        })
    })
});


</script>
@endsection
