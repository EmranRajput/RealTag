@extends('layout.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>{!! $title !!}</h2>
            <small class="text-muted">{!! env('APP_NAME') !!}</small>
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 ">
				<div class="card">
					<div class="header m-r--5">
					</div>
					<div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="landlord" class="form-control select2" data-placeholder="Select Landlord">
                                            <option></option>
                                            {!! makeDropdown($landlord) !!}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="tenant" class="form-control select2" data-placeholder="Select Tanent">
                                            <option></option>
                                            {!! makeDropdown($tanent) !!}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="datetimepicker form-control" placeholder="Agreement Date & Time">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group drop-custum">
                                    <input type="text" class="datepicker form-control" placeholder="Agreement Start Date">
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="datepicker form-control" placeholder="Agreement End Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Phone">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea class="form-control no-resize" placeholder="property Address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-raised g-bg-cyan">Submit</button>
                                <button type="submit" class="btn btn-raised">Cancel</button>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
    </div>
</section>
@endsection
