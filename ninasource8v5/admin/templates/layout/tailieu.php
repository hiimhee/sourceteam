<div class="photoUpload-zone">
	<div class="photoUpload-detail" id="photoUpload-preview">
		<a class="btn btn-sm bg-gradient-primary text-white d-inline-block p-1 rounded" href="<?=@$tailieuDetail?>" title="Download tập tin" target="_blank"><i class="fas fa-download mr-2"></i>Download tập tin</a>
	</div>
	<label class="photoUpload-file" id="photo-zone" for="file-zone-tailieu">
		<input type="file" name="file-tailieu" id="file-zone-tailieu">
		<i class="fas fa-cloud-upload-alt"></i>
		<p class="photoUpload-drop">Kéo và thả file vào đây</p>
		<p class="photoUpload-or">hoặc</p>
		<p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn file</p>
	</label>
	<div class="photoUpload-dimension"><?=@$dimensiontailieu?></div>
</div>