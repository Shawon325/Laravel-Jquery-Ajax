@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Exam List</h1>
      <br>
      <div class="container">
		  <button style="margin-left: -14px;" class="btn btn-info" id="addbtn">Add New</button>


		</div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Exam List</h3>
            </div>
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
            <!-- /.box-header -->

            <div class="box-body">

	             <div id="datalist"></div>
            </div>

            </div>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

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
        url     : "{{route('exam.create')}}",
        type    : "get",
        dataType: "html",
        success: function(data) {
          $("#modal-div").find(".modal-body").html(data);
        }
      });
      $("#modal-div").modal();
    });

    $("#datalist").on("click", ".edit", function() {
      var data = $(this).attr("data");

      $.ajax({
        url      : "{{url('exam')}}"+"/"+data+"/edit",
        type     : "get",
        dataType : "html",
        success:function(data) {
          $("#modal-div").find(".modal-body").html(data);
        }
      });

      $("#modal-div").modal();
    });

    $("#datalist").on("click", ".delete", function() {
      var data = $(this).attr("data");

      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
          url: "{{url('exam')}}"+"/"+data+"/destroy",
          data: {_token: "{{ csrf_token() }}"},
          type: "post",
          dataType: "json",
          success: function(data){
            if(data.msgType=='success') {
              swal(data.message, { icon: "success" });
              loadDataList();
            } else {
              swal(data.message, { icon: "error" });
            }
          }
        });
        } else {
          swal("Your data is safe!");
        }
      });
    });

    $("#modal-form").submit(function(e) {
      e.preventDefault();
      var data = $(this).serializeArray();

      $.ajax({
        url     : "{{route('exam.store')}}",
        data    : data,
        type    : "post",
        dataType: "json",
        success: function(data) {
          $("#modal-form").find(".alert-danger").remove();
          $("#modal-form").find(".help-block").remove();
          $("#modal-form").find(".form-group").removeClass('has-error');

          if(data.msgType=='success') {
            toastr["success"](data.message);
            $("#modal-div").modal('hide');
            loadDataList();
          } else {
            toastr["error"](data.message);
          }
        },
        error:function(errors) {
          var error = errors.responseJSON;
          $("#modal-form").find(".alert-danger").remove();

          $("#modal-form").find(".modal-body").prepend('<div class="alert alert-danger">'+error.message+'</div>');

          $("#modal-form").find('.form-group').each(function(){
            var $that = $(this);
            $(this).removeClass('has-error');
            $(this).find('.help-block').remove();

            var inputName = $(this).find('[name]').first().attr('name');
            var inputName = inputName.replace('[]', '');

            if(error.errors[inputName]) {
              $(this).addClass('has-error');

              $.each(error.errors[inputName], function(i, massage){
                $that.append('<span class="help-block">'+massage+'</span>');
              });
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
        $("#datalist").find(".sorting").removeClass("sorting_asc").removeClass("sorting_desc");
        $(this).addClass(sortingClass);
        loadDataList();
    });
  });

  function loadDataList(pagelink = "{{route('tablelist')}}") {
      var perpage = $("#perpage").val();
      var search = $("#search").val();

      if($("#datalist").find(".sorting").hasClass("sorting_asc")) {
        var sortingOrder = 'asc';
        var sorting = $("#datalist").find(".sorting_asc").attr("sorting");
      } else if($("#datalist").find(".sorting").hasClass("sorting_desc")) {
        var sortingOrder = 'desc';
        var sorting = $("#datalist").find("sorting_desc").attr("sorting");
      } else {
        var sortingOrder = "";
        var sorting = '';
      }

      $.ajax({
        url      : pagelink,
        data     : {
          perpage      : perpage,
          search       : search,
          sorting      : sorting,
          sortingOrder : sortingOrder
        },
        type     : "get",
        dataType : "html",
        success:function(data) {
          $("#datalist").html(data);
        }
      });
  }
</script>
@endsection
