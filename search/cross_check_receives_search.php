<style>
    .dtext{
        text-decoration:underline;
    }
    .linktext{
        font-size:12px;
    }
    .table th, .table td{
        padding:5px;
    }

</style>
<div class="card mb-3">
    <div class="card-body">
        <form class="form-horizontal" action="" id="receive_details_search_form" method="GET">
            <div class="table-responsive">          
                <table class="table table-borderless search-table">
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="todate">MRR NO</label>
                                    <input type="text" class="form-control" id="mrr_no" name="mrr_no">
                                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <label for="todate">.</label>
                                    <button type="button" name="receive_details_search" class="form-control btn btn-primary" onclick="get_all_rcv_details_table('receive_details_search_form')">Search</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12" id="showDataArea"></div>
        </div>
    </div>
</div>


