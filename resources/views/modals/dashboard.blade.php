<!--Modal Edit Company Data-->
<div class="iziModal" id="modal-company" data-iziModal-title="Company Profile">
	<div class="p-3">
		<form class="form-group" method="POST" action="{{url('dashboard/company/update')}}" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label class="form-label text-dark">Company Name</label>
				<input class="form-control input-custom" type="text" name="companyName" placeholder="Company">
				<small>Company Name *</small>
			</div>
			<div class="form-group">
				<div class="d-flex justify-content-center">
					<img class="img-thumbnail text-center" id="companyLogo" alt="company logo">
				</div>
				<label class="form-label text-dark">Company Logo</label>
				<input class="form-control input-custom" type="file" name="companyLogo" placeholder="Logo">
				<small>Company Logo *</small>
			</div>
			<div class="form-group">
				<label class="form-label text-dark">Company Address</label>
				<textarea class="form-control input-custom" name="companyAddress" placeholder="Address"></textarea>
				<small>Company Address *</small>
			</div>
			<div class="form-group">
				<label class="form-label text-dark">Company Slogan</label>
				<input class="form-control input-custom" type="text" name="companySlogan" placeholder="Slogan">
				<small>Company Slogan *</small>
			</div>
			<div class="clearfix">
				<button class="btn btn-custom-rounded float-right" type="submit">Update</button>
			</div>
		</form>
	</div>
</div>

<!--Modal Add Categories-->
<div class="iziModal" id="modal-categories" data-iziModal-title="Add Categories">
	<div class="p-3">
		<form class="form-group" method="POST" action="{{url('dashboard/categories/add')}}" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label class="form-label text-dark">Categories</label>
				<input class="form-control input-custom" type="text" name="categories" placeholder="Categories">
				<small>Categories *</small>
			</div>
			<div class="clearfix">
				<button class="btn btn-custom-rounded float-right" type="submit">Add</button>
			</div>
		</form>
	</div>
</div>

<!--Modal Edit Job Posts-->
<div class="iziModal" id="modal-editjobposts" data-iziModal-title="Edit Job Posts">
	<div class="p-3">
		<div class="alert alert-warning mt-1">
			<p class="font-weight-bolder">Attention!</p>
			When you click <strong>Delete Buttons</strong>, There's no confirmations!<br>
			Take care for your posts!
		</div>
		<div class="clearfix">
			<div class="float-left">
				<p class="display-6">Update a Jobs</p >
			</div>
			<div class="float-right">
				<button class="btn btn-outline-danger btn-sm" id="deleteJobs" hash="" onclick="deleteJobs(this)">Delete</button>
			</div>
		</div>
		<form method="POST" action="{{url('dahsboard/job/edit')}}">
			@csrf
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label class="form-label">Job Title</label>
						<input class="form-control input-custom" name="jobTitle" id="jobTitle">
						<small>Job Title *</small>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="form-label">Job Categories</label>
						<select name="jobCategories" class="form-control input-custom" id="jobCategories">
							@foreach($dataCategories as $dc)
							<option value="{{$dc->categories}}">{{$dc->categories}}</option>
							@endForeach
						</select>
						<small>Job Categories *</small>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="form-label">Job Description</label>
				<textarea id="editJobPosts" name="jobPosts" id="jobPosts"></textarea>
				<small>Job Description *</small>
			</div>
			<input type="hidden" name="hash">
			<div class="clearfix">
				<button class="btn btn-custom-rounded float-right" type="submit">Update</button>
			</div>
		</form>
	</div>
</div>

<!--Modal Edit Categories-->
<div class="iziModal" id="modal-editcategories" data-iziModal-title="Edit Categories">
	<div class="p-3">
		<div class="alert alert-warning mt-1">
			<p class="font-weight-bolder">Attention!</p>
			When you click <strong>Delete Buttons</strong>, There's no confirmations!<br>
			Take care for your categories!
		</div>
		<div class="clearfix">
			<div class="float-left">
				<p class="display-6">Update Categories</p >
			</div>
			<div class="float-right">
				<button class="btn btn-outline-danger btn-sm" id="deleteCategories" data-id="" onclick="deleteCategories(this)">Delete</button>
			</div>
		</div>
		<form class="form-group" method="POST" action="{{url('dashboard/categories/update')}}" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label class="form-label text-dark">Categories</label>
				<input class="form-control input-custom" type="text" id="editCategories" name="categories" placeholder="Categories">
				<small>Categories *</small>
			</div>
			<input type="hidden" name="id" id="idCategories">
			<div class="clearfix">
				<button class="btn btn-custom-rounded float-right" type="submit">Update</button>
			</div>
		</form>
	</div>
</div>

<!--Modal See Candidates-->
<div class="iziModal" id="modal-candidates" data-iziModal-title="Candidates Name">
	<div class="p-3">
		<div class="alert alert-warning mt-1">
			<p class="font-weight-bolder">Attention!</p>
			When you click <strong>Delete Buttons</strong>, There's no confirmations!<br>
			Take care for your candidates!
		</div>
		<div class="clearfix">
			<div class="float-left">
				<p class="head text-custom" name="candidateName">Candidates Names</p>
			</div>
			<div class="float-right">
				<a class="btn btn-danger btn-sm" href="#" name="deleteCandidates">Delete Candidates</a>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			<img src="" alt="Candidate Photos" class="img-thumbnail shadow shadow-sm" name="candidatePhotos">
		</div>
		<div class="mt-3">
			<table class="table table-bordered table-sm">
				<thead>
					<tr>
						<th>
							Name
						</th>
						<th>
							Age
						</th>
						<th>
							Address
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td name="candidateName">
							Name
						</td>
						<td name="candidateAge">
							Age
						</td>
						<td name="candidateAddress">
							Address
						</td>
					</tr>
				</tbody>
			</table>
			<table class="table table-bordered table-sm">
				<thead>
					<tr>
						<th>
							Education
						</th>
						<th>
							Email
						</th>
						<th>
							Number Phones
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td name="candidateEducation">
							Education
						</td>
						<td name="candidateEmail">
							Email
						</td>
						<td name="candidatePhones">
							Phones
						</td>
					</tr>
				</tbody>
			</table>
			<table class="table table-bordered table-sm">
				<thead>
					<tr>
						<th>
							Status
						</th>
						<th>
							Date Applied
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td name="candidateStatus">
							Status
						</td>
						<td name="candidateAppliedAt">
							Date Applied
						</td>
					</tr>
				</tbody>
			</table>
			<div class="d-none alert" name="statusAlert">
				<p class="font-weight-bolder">Info!</p>
				<div name="statusText"></div>
			</div>
			<div class="clearfix">
				<div class="float-left">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<span class="form-label" name="whiteListedStatus">Whitelisted ?</span>
							</div>
						</div>
						<select class="form-control input-custom" name="whiteListedChange">
							<option value="0">Ignore</option>
							<option value="1">Select</option>
						</select>
					</div>
				</div>
				<div class="float-right">
					<a class="btn btn-custom-rounded" name="candidateArchive" href="#" target="__blank">Download Archive</a>
				</div>
			</div>
		</div>
	</div>
</div>

<!--Modal For Change Auth-->
<div class="iziModal" id="modal-settings" data-iziModal-title="Edit Categories">
	<div class="p-3">
		<p class="display-6 text-custom">Settings</p >
		<form class="form-group" method="POST" action="{{url('dashboard/settings/update')}}">
			@csrf
			<div class="form-group">
				<label class="form-label text-dark">Username</label>
				<input class="form-control input-custom" value="{{Session::get('username')}}" type="text" name="username" placeholder="Username" required>
				<small>Username *</small>
			</div>
			<div class="form-group">
				<label class="form-label text-dark">New Password</label>
				<input class="form-control input-custom" type="password" name="password" placeholder="********" required>
				<small>Password *</small>
			</div>
			<div class="form-group">
				<label class="form-label text-dark">Password Confirmation</label>
				<input class="form-control input-custom" type="password" name="password_confirmation" placeholder="********" required>
				<small>Password Confirmation *</small>
			</div>
			<div class="form-group">
				<label class="form-label text-dark">Old Password</label>
				<input class="form-control input-custom" type="password" autocomplete="none" name="oldPassword" placeholder="********" required>
				<small>Old Password *</small>
			</div>
			<div class="clearfix">
				<button class="btn btn-custom-rounded float-right" name="changePass" type="submit">Update</button>
			</div>
		</form>
	</div>
</div>