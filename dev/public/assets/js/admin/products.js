
$(document).ready(function(){
    //check if its on products page
    if($('#admin-products-box').length !== 0){
        var dataTable = $('#tblproducts')
            .addClass('table table-striped table-bordered')
            .DataTable({
                "processing": true,
                "serverSide": true,
                "columns": [
                    { "data": 'id'},
                    { "data": "SKU" },
                    { "data": "name" },
                    { "data": "description" },
                    { "data": "salePrice" },
                    { "data": "regularPrice" },
                    { "data": 'id'}
                ],
                "aoColumnDefs": [
                    {
                        "mRender": function ( data, type, row ) {
                            //console.log(row);
                            var html = '&nbsp;'+
                                '<button type="submit" class="btn btn-danger" data-id="'+row.id+'">Delete</button>';
                            return html;
                        },
                        "aTargets": [6],
                    },
                ],
                "aaSorting": [[ 0, "desc" ]],
                "bFilter":false,
                "pagingType": "full_numbers",
                "sInfoEmpty": 'No entries to show',
                "sEmptyTable": "No Sources found currently, please add at least one.",
                "ajax":{
                    "url":"/admin/search-products",
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
                    url: "/admin/delete-product",
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

});

