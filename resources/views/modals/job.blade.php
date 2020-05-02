<!--Modal Apply Candidate-->
<div class="iziModal" id="modal-apply" data-iziModal-title="Apply This Jobs">
	<div class="p-3">
		<form class="form-group" method="POST" action="{{url('job/apply')}}" enctype="multipart/form-data">
			@csrf
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label class="form-label text-dark">Name</label>
						<input class="form-control input-custom" type="text" name="candidateName" placeholder="Your Name" required>
						<small>Name *</small>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="form-label text-dark">Age</label>
						<input class="form-control input-custom" type="number" name="candidateAge" placeholder="Age" required>
						<small>Age *</small>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="form-label text-dark">Education / Degree</label>
						<select name="candidateEducation" class="form-control input-custom" required>
							<option value="High School">High Schools</option>
							<option value="Diploma">Diploma</option>
							<option value="Bachelor">Bachelor</option>
							<option value="Magister">Magister</option>
							<option value="Doctor">Doctor</option>
						</select>
						<small>Education *</small>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="form-label text-dark">Photos</label>
						<input class="form-control input-custom" type="file" name="candidatePhotos" placeholder="Photos" required>
						<small>Photos (Max 2mb) (jpg,jpeg,png) *</small>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="form-label text-dark">Email</label>
						<input class="form-control input-custom" type="email" name="candidateEmail" placeholder="yourname@example.com" required>
						<small>Email *</small>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="form-label text-dark">Phone Number</label>
						<input class="form-control input-custom" type="number" name="candidatePhone" placeholder="Phone" required>
						<small>Phone Number *</small>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="form-label text-dark">Address</label>
						<textarea class="form-control input-custom" name="candidateAddress" placeholder="Address" required></textarea>
						<small>Address *</small>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="form-label text-dark">CV / Archive</label>
						<input class="form-control input-custom" type="file" name="candidateArchive" placeholder="Archive" required>
						<small>CV / Archive (zip,rar,pdf,docx) (Max 5mb) *</small>
					</div>
				</div>
				<input type="hidden" name="candidateApply">
			</div>
			<div class="clearfix">
				<button class="btn btn-custom-rounded float-right" type="submit">Apply</button>
			</div>
		</form>
	</div>
</div>