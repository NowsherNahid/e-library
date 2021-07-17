
@extends('layouts.master')
@section('content')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Category</a></li>
        </ol>
    </nav>
    
    <div class="row">
        <div class="col-md-5 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Add Category</h6>
                    <form class="forms-sample" id="add-category-form">
                        @csrf
                        <div class="form-group">
                            <label for="category-name">Category Name</label>
                            <input type="text" name="category_name" class="form-control" id="add-category-name" placeholder="Enter category name">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">All Categories</h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($categories as $category)
                      <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-icon" data-toggle="modal" data-target="#exampleModal" onclick="edit_data('{{ $category->id }}')">
								              <i data-feather="edit"></i>
							              </button>
                            <button type="button" class="btn btn-danger btn-icon" onclick="delete_row('{{ $category->id }}')">
                              <i data-feather="trash"></i>
                            </button>
                        </td>
                      </tr>
                    @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
		</div>
    </div>
</div>

{{-- Edit modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="update-category-form">
        @csrf
        <div class="modal-body">
            {{-- content here --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    // Insert category
    $("#add-category-form").submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url: '/add-categories',
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(data) {
          if (data == true) {
            Swal.fire("Done!", "Category added!", "success");
            window.setTimeout(function() {
              location.reload()
            }, 1000); 
          } 
          else{
            Swal.fire("Error!", "Category already exists!", "error");
          }  
        },
        cache: false,
        contentType: false,
        processData: false
      });
    });

    // Edit category
    function edit_data(id){
      $.ajax({
        url: '/edit-category/'+id,
        type: 'GET',
        success: function(data) {
          if (data != "") {
             $('.modal-body').html(data);
          }  
        },
        cache: false,
        contentType: false,
        processData: false
      });
    }

    // Update category
    $("#update-category-form").submit(function(e) {
      e.preventDefault();
      var categoryID = $('#edit-category-id').val();
      var formData = new FormData(this);
      $.ajax({
        url: '/update-category/'+categoryID,
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function(data) {
          if (data == true) {
            Swal.fire("Done!", "Category updated!", "success");
            window.setTimeout(function() {
              location.reload()
            }, 1000); 
          } 
          else {
            Swal.fire("Error!", "Category already exists!", "error");
          }  
        },
        cache: false,
        contentType: false,
        processData: false
      });
    });

    // Delete category
    function delete_row(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
		  }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '/delete-category/'+id,
            crossDomain: true,
            cache: false,
            success: function(data) {
              if (data == true) {
                  Swal.fire("Done!", "Category deleted!", "success");
                  window.setTimeout(function() {
                  location.reload()
                  }, 1000); 
              } 
              else{
                  Swal.fire("Error!", "Something went wrong!", "error");
              } 
            }
          });
        }
      });
    }
</script>

@endsection




