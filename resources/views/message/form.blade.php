@extends('layout.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>{{ $title }}</h2>
            <small class="text-muted">Welcome to {{ env('APP_NAME') }}</small>
        </div>
        <div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 ">
				<div class="card">
					<div class="header">
						<h2>Appointment Information <small>Description text here...</small> </h2>
						<ul class="header-dropdown m-r--5">
							<li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="zmdi zmdi-more-vert"></i></a>
								<ul class="dropdown-menu pull-right">
									<li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
									<li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
									<li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="First Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="status" class="form-control" id="status">
                                            <option selected disabled>-- Status --</option>
                                            {!! makeDropdown(siteConfig('status')) !!}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="status" class="form-control" id="status">
                                            <option selected disabled>-- Template Type --</option>
                                            {!! makeDropdown(siteConfig('template_type')) !!}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="type" class="form-control" id="type">
                                            <option selected disabled>-- Template Sub Type --</option>
                                            {!! makeDropdown(siteConfig('template_sub_type')) !!}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea id="template" class="form-control">
                                            <p>Hey [Tenant's Name]! 🎉</p>
                                            <br>
                                            <p>Wishing you a fantastic [Age]th birthday filled with joy and laughter. May this special day mark the beginning of a wonderful year ahead.</p>
                                            <br>
                                            <p>As your property manager, I'm grateful to have you as a tenant. Your positivity and respect for the community make it a pleasure to work with you.</p>
                                            <br>
                                            <p>Here's to a year of success, happiness, and great memories. Enjoy your day to the fullest!</p>
                                            <br>
                                            <p>Best regards,</p>
                                            <br>
                                            <p>[Agent's Name]</p>
                                        </textarea>
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
@push('js')
    <script src="{!! pathAssets('plugins/tinymce/tinymce.js') !!}"></script>
@endpush
@push('script')
    <script>
    applyTinyEditor('template')
    </script>
@endpush
