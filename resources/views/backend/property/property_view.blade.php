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
    <h4 class="py-2 m-4"><span class="text-muted fw-light">Project Details</span></h4>

    <div class="row mt-5">
        <!-- Modal -->
        <div class="modal fade" id="createPropertyModal" tabindex="-1" aria-labelledby="createPropertyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPropertyModalLabel">Add New Property</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="createPropertyForm">
                            @csrf
                            <div class="row">
                                <!-- Title -->
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                                </div>
                                <!-- Price -->
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" required>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Beds -->
                                <div class="col-md-6 mb-3">
                                    <label for="beds" class="form-label">Beds</label>
                                    <input type="number" class="form-control" id="beds" name="beds" placeholder="Enter number of beds" required>
                                </div>
                                <!-- Baths -->
                                <div class="col-md-6 mb-3">
                                    <label for="baths" class="form-label">Baths</label>
                                    <input type="number" class="form-control" id="baths" name="baths" placeholder="Enter number of baths" required>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Square Feet -->
                                <div class="col-md-6 mb-3">
                                    <label for="sq_ft" class="form-label">Square Feet</label>
                                    <input type="number" class="form-control" id="sq_ft" name="sq_ft" placeholder="Enter square feet" required>
                                </div>
                                <!-- Build Year -->
                                <div class="col-md-6 mb-3">
                                    <label for="year_build" class="form-label">Build Year</label>
                                    <input type="number" class="form-control" id="year_build" name="year_build" placeholder="Enter build year" required>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Price Per Square Feet -->
                                <div class="col-md-6 mb-3">
                                    <label for="price_sq_ft" class="form-label">Price Per Square Feet</label>
                                    <input type="number" class="form-control" id="price_sq_ft" name="price_sq_ft" placeholder="Enter price per square feet" required>
                                </div>
                                <!-- city -->
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" required>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Location -->
                                <div class="col-md-6 mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" required>
                                </div>
                                <!-- Home Type -->
                                <div class="col-md-6 mb-3">
                                    <label for="home_type" class="form-label">Home Type</label>
                                    <input type="text" class="form-control" id="home_type" name="home_type" placeholder="Enter home type" required>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Buy Type -->
                                <div class="col-md-6 mb-3">
                                    <label for="buy_type" class="form-label">Buy Type</label>
                                    <input type="text" class="form-control" id="buy_type" name="buy_type" placeholder="Enter buy type" required>
                                </div>
                                <!-- Agent Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="agent_name" class="form-label">Agent Name</label>
                                    <input type="text" class="form-control" id="agent_name" name="agent_name" placeholder="Enter agent name" required>
                                </div>
                            </div>
                            <div class="row">
                                <!-- more info -->
                                <div class="col-md-12 mb-3">
                                    <label for="more_info" class="form-label">More Info</label>
                                    <input type="text" class="form-control" id="more_info" name="more_info" placeholder="Enter more info" required>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Property Image -->
                                <div class="col-md-12 mb-3">
                                    <label for="property_image" class="form-label">Property Image</label>
                                    <input type="file" class="form-control" id="property_image" name="property_image" accept="image/*" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Property</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

            <!-- Edit Project Modal -->
            {{-- <div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editProjectForm" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="editTitle">Project Name <span class="text-danger">*</span></label>
                                    <input id="editTitle" name="title" type="text" required class="form-control" placeholder="Title Name">
                                    <span class="text-danger error-title"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="editUser">User Name<span class="text-danger">*</span></label>
                                    <select id="editUser" name="user_id[]" class="form-control" multiple="multiple" required></select>
                                    <span class="text-danger error-user_id"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="editDescription">Project Description</label>
                                    <textarea id="editDescription" name="description" class="form-control" rows="4" placeholder="Project Details"></textarea>
                                    <span class="text-danger error-description"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="editStartDate">Project Start Date <span class="text-danger">*</span></label>
                                    <input id="editStartDate" name="start_date" type="date" required class="form-control" placeholder="Date">
                                    <span class="text-danger error-start_date"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="editEndDate">Project Expected End Date<span class="text-danger">*</span></label>
                                    <input id="editEndDate" name="end_date" type="date" required class="form-control" placeholder="Date">
                                    <span class="text-danger error-end_date"></span>
                                </div>
                                <div class="form-group">
                                    <label for="editAttachment">Attachments</label>
                                    <input type="file" id="editAttachment" name="attachment[]" class="form-control" multiple>
                                    <span class="text-danger error-attachment"></span>
                                    <div id="edit-file-names" class="mt-2"></div> 
                                    <small class="text-muted">
                                        Current Attachments:
                                        <div id="currentAttachments" class="mt-1"></div>
                                    </small>
                                    <!-- Hidden input to store current attachments as JSON -->
                                    <input type="hidden" id="currentAttachmentsData" name="currentAttachments" value="[]">
                                </div>                                
                                <br>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card p-lg-4 p-2">
                <!-- Nav tabs -->
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
                </div>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="Pending" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h5>All Property</h5>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="float-end">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPropertyModal">
                                                <i class="bx bx-edit-alt me-1"></i> Create New Property
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
                                            <th>Title</th>
                                            <th>Price</th>
                                            <th>Beds</th>
                                            <th>Baths</th>
                                            <th>Squre Feet</th>
                                            <th>Build Year</th>
                                            <th>location</th>
                                            <th>Home Type</th>
                                            <th>Buy Type</th>
                                            <th>Agent Name</th>
                                            <th>Property Image</th>
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
                    
                    <div class="tab-pane" id="Incomplete" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h5>Completed Project</h5>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="float-end">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPropertyModal">
                                                <i class="bx bx-edit-alt me-1"></i> Create New Project
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="table-responsive text-nowrap p-3">
                                <table id="datatable2" class="table">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Project Title</th>
                                            <th>Description</th>
                                            <th>Start Date</th>
                                            <th>Expected End Date</th>
                                            <th>Completed Date</th>
                                            <th>Assigned User</th>
                                            <th>Attachment</th>
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
                    
                    <div class="tab-pane" id="Complete" role="tabpanel" aria-labelledby="messages-tab">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h5>Dropped Project</h5>
                                    </div>
                                    @can('Create Project')
                                    <div class="col-12 col-md-6">
                                        <div class="float-end">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPropertyModal">
                                                <i class="bx bx-edit-alt me-1"></i> Create New Project
                                            </button>
                                        </div>
                                    </div>
                                    @endcan
                                </div>
                            </div>
                            
                            <div class="table-responsive text-nowrap p-3">
                                <table id="datatable3" class="table">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Project Title</th>
                                            <th>Description</th>
                                            <th>Start Date</th>
                                            <th>Expected End Date</th>
                                            <th>Assigned User</th>
                                            <th>Attachment</th>
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
        $(document).ready(function() {
            // Initialize CKEditor for the Project Description field
            CKEDITOR.replace('more_info');
            CKEDITOR.replace('editDescription');
        });
    </script>

    {{-- <!-- CSS for Select2 z-index in Modal -->
    <style>
        .select2-container {
            z-index: 9999 !important;
        }
    </style> --}}

<script>
    $(document).ready(function () {
    // Function to fetch and populate data
    function fetchProperties() {
        $.ajax({
            url: "{{ route('property.list') }}", // Replace with your actual route
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    const properties = response.data.property; // Access the nested 'property' key
                    let tableRows = '';

                    properties.forEach((property, index) => {
                        const propertyImage = property.property_image
                            ? `<img src="${property.property_image}" alt="Property Image" style="width: 100px; height: auto;">`
                            : 'No Image Available';

                        tableRows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${property.title || 'No Title'}</td>
                                <td>${property.price || 'N/A'}</td>
                                <td>${property.beds || 'N/A'}</td>
                                <td>${property.baths || 'N/A'}</td>
                                <td>${property.sq_ft || 'N/A'}</td>
                                <td>${property.year_build || 'N/A'}</td>
                                <td>${property.location || 'No Location'}</td>
                                <td>${property.home_type || 'N/A'}</td>
                                <td>${property.buy_type || 'N/A'}</td>
                                <td>${property.agent_name || 'No Agent'}</td>
                                <td>${propertyImage}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit-button" href="javascript:void(0);" data-id="${property.id}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <form id="Delete-task-form-${property.id}" method="POST">
                                                <button type="button" class="dropdown-item" onclick="confirmDeleteTask(${property.id})">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div> 
                                </td>
                            </tr>
                        `;
                    });

                    $('#datatable1 tbody').html(tableRows); // Populate the table body
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
            },
        });
    }

    // Fetch and populate data on page load
    fetchProperties();
});


</script>
@endsection
