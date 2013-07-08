<div class="left">
	<p>
		<label for="imgUpload"><button id="mskUpload" class="btn">Upload Image</button></label>
		<input id="imgUpload" type="file" name="imgUpload" class="visuallyhidden">
		<div id="progress" class="progress progress-success progress-striped"></div>
	</p>

	<p id="uploaded">
		@if ( Session::has('uploadedImg') )
			{{ HTML::image( URL::to_asset( Session::get('uploadedImg') ), '', array('id' => 'userImg') ) }}
		@endif
	</p>
</div>

<div class="cardPreview">
<div class="wrap">
	<img src="" alt="" class="usereCard" /> 
	<div id="preview-pane">
		<div class="preview-container {{ !Session::has('uploadedImg') ? 'hide' : '' }}">
			<img src="{{ URL::to_asset( Session::get('uploadedImg') ) }}" class="jcrop-preview" alt="Preview" />
		</div>
	</div>
</div>
</div>

<a href="#/{{ $step['next'] }}" class="btn saveBtn {{ !Session::has('uploadedImg') ? 'visuallyhidden' : '' }}">Save</a>