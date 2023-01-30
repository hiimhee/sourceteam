<div class="photoUpload-zone">
	<div class="photoUpload-detail" id="photoUpload-preview4">
		<img class="rounded" src="<?=$photoDetail4?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo" style="<?=$config['news'][$type]['css_hinh']?>"/>
	<label class="photoUpload-file" id="photo-zone4" for="file-zone4">
		<input type="file" name="file4" id="file-zone4">
		<i class="fas fa-cloud-upload-alt"></i>
		<p class="photoUpload-drop">Kéo và thả hình vào đây</p>
		<p class="photoUpload-or">hoặc</p>
		<p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
	</label>
	<div class="photoUpload-dimension"><?=@$dimension4?></div>
</div>