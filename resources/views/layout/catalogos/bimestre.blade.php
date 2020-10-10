@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.bimestreController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; bimestres</h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                    	<th>#</th>
			                        <th>Bimestre</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.bimestreController.bimestres,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                    	<td data-bind="text: id"></td>
                                        <td data-bind="text: nombre"></td>
                                    </tr>

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
            model.bimestreController.initialize();
        });
</script>
@endsection
