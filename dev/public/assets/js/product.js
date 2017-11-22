
$(document).ready(function(){
	//check if its on products page
	if($('#product-box').length !== 0){
        var dataTable = $('#tblproducts')
            .addClass('table table-striped table-bordered')
            .DataTable({
                "processing": true,
                "serverSide": true,
                "columns": [
                    { "data": 'SKU'},
                    { "data": "name" },
                    { "data": "description" },
                    { "data": "id" }
                ],
                "aoColumnDefs": [
                    {
                        "mRender": function ( data, type, row ) {
                            //console.log(row);
                            var html = '<a href="/products/entry/'+row.id+'" class="btn btn-warning">Edit</a>&nbsp;'+
                                '<button type="submit" class="btn btn-danger" data-id="'+row.id+'">Delete</button>';
                            return html;
                        },
                        "aTargets": [3],
                    },
                ],
                "aaSorting": [[ 0, "desc" ]],
                "bFilter":false,
                "pagingType": "full_numbers",
                "sInfoEmpty": 'No entries to show',
                "sEmptyTable": "No Sources found currently, please add at least one.",
                "ajax":{
                    "url":"/products/search-products",
                    "type":"POST",
                    "data":{
                        filter:function () {
                            return $('#txtFilter').val();
                        }
                    },
                    complete: function(data) {
                        bindDeleteBtn();
                    }
                },
                "fnInitComplete": function (oSettings, json) {
                    bindDeleteBtn();
                },

            });
        function bindDeleteBtn(){
			$('#tblproducts .btn-danger').off('click');
            $('#tblproducts .btn-danger').click(function(e){
                e.preventDefault();
                if(!confirm('Are you sure you want to delete this data')){
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "/products/delete",
                    data: {
                        id:$(this).attr('data-id')
                    },
                    success: function(msg){
                        $('#tblproducts').DataTable().ajax.reload();
                    }
                });
            })
        }
        $('#frmSearch').submit(function(e){
            e.preventDefault();

            dataTable.ajax.reload();

        });
	}
    //product form
    if($('#product-entry-box').length !== 0){

        $("div#dropzone").dropzone(
            {
                url: "/products/upload-product-image" ,
                init: function() {
                    this.on("sending", function(file, xhr, formData) {
                        console.log('dasdas');
                        formData.append('funnlz_csrf',csfrData.funnlz_csrf);
                    });
                    this.on("success", function(file, response){
                        var data = jQuery.parseJSON(response);
                        console.log('xxx',data)
                        $('#picture').val(data.messages.new_name);
                    });

                }
            }
        );

        $('.previewComponent .fileInput').change(function(){
            var input = this;
            var preview = $(input).parent().find('.imgPreview');
            var hidden =  $(input).parent().find('input.imgData');
            var url = $(input).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
            {
            	console.log(input.files);
                var reader = new FileReader();

                reader.onloadend = function(evt){
                	if (evt.target.readyState == FileReader.DONE) { // DONE == 2
                        preview.attr('src', reader.result);
                        hidden.val(reader.result);
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
            else
            {
                preview.attr('src', '/assets/no_preview.png');
            }
        });
    }
});	

