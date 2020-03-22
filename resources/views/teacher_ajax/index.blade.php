@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Teacher List</h1>
      <br>
    <button class="btn btn-warning" id="addbtn">Add New</button>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="dataTables_length" id="example1_length">
                          <label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm" id="perpage">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                          </select> entries</label>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div id="example1_filter" class="dataTables_filter pull-right">
                          <label>Search:<input type="search" class="form-control input-sm" id="search" placeholder="" aria-controls="example1">
                          </label>
                        </div>
                      </div>
                  </div>
              </div>

              <div id="datalist"></div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <div class="modal fade" id="modal-div">
      <div class="modal-dialog">
        <form id="modal-form">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {

    $("#addbtn").click(function() {
      $("#modal-div").find(".modal-title").text("ADD NEW");

      $.ajax({
        url      : "{{route('teacher_ajax.create')}}",
        tyoe     : "get",
        dataTyoe : "html",
        success: function(data) {
          $("#modal-div").find(".modal-body").html(data);
        }
      });
      $("#modal-div").modal();
    });

    $("#datalist").on("click", ".edit", function() {
      var data = $(this).attr("data");

      $.ajax({
        url      : "{{url('teacher_ajax')}}"+"/"+data+"/edit",
        type     : "get",
        dataType : "html",
        success: function(data) {
          $("#modal-div").find(".modal-body").html(data);
        }
      });
        $("#modal-div").modal();
    });

    $("#datalist").on("click", ".delete", function() {
      var data = $(this).attr("data");

      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

          $.ajax({
            url      : "{{url('teacher_ajax')}}"+"/"+data,
            data     : {_token : "{{ csrf_token() }}"},
            type     : "delete",
            dataType : "json",
            success: function(data) {
              if(data.msgType=='success') {
                swal(data.message, {icon: "success"});
                loadDataList();
              }
            }
          });
        } else {
          swal("Your imaginary file is safe!");
        }
      });
    });

    $("#modal-form").submit(function(e) {
      e.preventDefault();
      var data = $(this).serializeArray();

      $.ajax({
        url      : "{{route('teacher_ajax.store')}}",
        data     : data,
        type     : "post",
        dataType : "json",
        success :function(data) {
          toastr["success"](data.message);
          $("#modal-div").modal('hide');
          loadDataList();
        },
        error: function(errors) {
          var error = errors.responseJSON;
          $("#modal-form").find(".alert-danger").remove();
          $("#modal-form").find(".modal-body").prepend('<div class="alert alert-danger">'+error.message+'</div>');

          $("#modal-form").find(".form-group").each(function() {
            var $that = $(this);
            $(this).removeClass('has-error');

            var inputname = $(this).find('[name]').first().attr("name");

            if(error.errors[inputname]) {
              $(this).addClass('has-error');
            }
          });
        }
      });
    });

    loadDataList();

    $("#perpage").change(function() {
      loadDataList();
    });

    $("#search").keyup(function() {
      loadDataList();
    });

    $("#datalist").on("click", ".page-link", function(e) {
      e.preventDefault();
      var pagelink = $(this).attr("href");
      loadDataList(pagelink);
    });

    $("#datalist").on("click", ".sorting", function() {
      var sortingClass = $(this).hasClass("sorting_asc") ? 'sorting_desc' : 'sorting_asc';
      $("#datalist").find(".sorting").removeClass('sorting_asc').removeClass('sorting_desc');
      $(this).addClass(sortingClass);
      loadDataList();
    });
  });

  function loadDataList(pagelink = "{{route('teacherlist')}}") {
    var perpage = $("#perpage").val();
    var search = $("#search").val();

    if($("#datalist").find(".sorting").hasClass('sorting_asc')) {
      var sortingOrder = 'asc';
      var sorting = $("#datalist").find(".sorting_asc").attr("sorting");
    } else if($("#datalist").find(".sorting").hasClass('sorting_desc')) {
      var sortingOrder = 'desc';
      var sorting = $("#datalist").find(".sorting_desc").attr("sorting");
    } else {
      var sortingOrder = '';
      var sorting = '';
    }

    $.ajax({
      url      : pagelink,
      data     : {
        perpage        : perpage,
        search         : search,
        sortingOrder   : sortingOrder,
        sorting        : sorting
      },
      type     : "get",
      dataType : "html",
      success: function(data) {
        $("#datalist").html(data);
      }
    });
  }
</script>
@endsection
