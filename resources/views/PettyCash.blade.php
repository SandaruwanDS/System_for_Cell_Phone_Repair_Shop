@extends('layouts.topnavbar')
@extends('layouts.sidebar')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>petty Cash</title>

</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">
                                 {{-- Department Data Enter --}}
					<div class="row board-view-header">
						

						<div class="row">
							<div class="col-lg-12">
								<div class="card shadow-lg p-3 mb-10 bg-body-tertiary rounded">
									<div class="card-header">
										<h4 class="card-title mb-0 text-center" >Petty Cash</h4>
										<hr size="10">
									</div>
									<div class="card-body">
										<form action="#">
											<div class="form-group row">
												<label class="col-form-label col-lg-2">CR Account</label>
												<div class="col-lg-7">
													<div class="input-group">
														<input type="text" class="form-control" placeholder="Credit AC" aria-label="Username" aria-describedby="basic-addon1">
													</div>
												</div>
											</div>
                                            <div class="form-group row">
												<label class="col-form-label col-lg-2">DR Account</label>
												<div class="col-lg-7">
													<div class="input-group">
														<input type="text" class="form-control" placeholder="DR Account" aria-label="Username" aria-describedby="basic-addon1">
													</div>
												</div>
											</div>
                                            <div class="form-group row">
												<label class="col-form-label col-lg-2">Description</label>
												<div class="col-lg-7">
													<div class="input-group">
														<input type="text" class="form-control" placeholder="Description" aria-label="Username" aria-describedby="basic-addon1">
													</div>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-form-label col-lg-2">Amount </label>
												<div class="col-lg-7">
													<div class="input-group">
														<input type="text" class="form-control" placeholder="Amount " aria-label="Recipient's username" aria-describedby="basic-addon2">
														<div class="input-group-append">
														</div>
													</div>
												</div>
											</div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                            
                                                  <div class="text-center">
                                                  <div class="btn-group">
                                                    <button type="submit" value="submit_n_add_selling_prices" class="btn btn-warning">Save</button>                            
                                                    <button id=""  type="submit" value="submit_n_add_opening_stock" class="btn btn-secondary">Delete</button> 
                                                    <button type="submit" value="" class="btn btn-success">Exit</button>
                                                    <button type="submit" value="submit" class="btn btn-danger">Cancel</button>
                                                  </div>
                                                  
                                                  </div>
                                                </div>
                                              </div>
										</form>
									</div>
								</div>
						
						</div>		

				<!-- /Page Content -->

            </div>
        </div>
    </div>
    

    
</body>

<script data-cfasync="false" src="../../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
</script>
<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/datatables.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
@endsection
</html>