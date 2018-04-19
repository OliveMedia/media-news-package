@if (session('error'))
<div class="alert alert-danger">
	 <a href="#" class="close xs" data-dismiss="alert" aria-label="close">&times;</a> 
	{{ session('error') }}
</div>
@endif
@if (session('status'))
<div class="alert alert-success">
	 <a href="#" class="close " data-dismiss="alert" aria-label="close">&times;</a> 
	{{ session('status') }}
</div>
@endif
@if (session('success'))
	<div class="alert alert-success">
		<a href="#" class="close " data-dismiss="alert" aria-label="close">&times;</a>
		{{ session('success') }}
	</div>
@endif