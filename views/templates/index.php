<h1><?= htmlspecialchars($this->title) ?></h1>
<?php if ($this->isLoggedIn) :?>
	<form method="post" enctype="multipart/form-data">
		<div class="form-data">
			<input type="file" name="fileToUpload" id="fileToUpload" />
		</div>

		<div class="form-data">
			<button type="button" class="btn" onclick="addPosition()">Добави позиция</button>
		</div>

		<div id="positions">
			<div class="form-data">
				<input class="custom-input" style="width:40%;display:inline;" name="texts[0]" placeholder="Текст" type="text" />
				<input class="custom-input" style="width:15%;display:inline;" name="xarray[0]" placeholder="X" type="text" />
				<input class="custom-input" style="width:15%;display:inline;" name="yarray[0]" placeholder="Y" type="text" />
			</div>
		</div>
		
		<div class="form-data">
			<label class="control-label" for="password">Наименование</label>
			<input class="custom-input" id="meme-name" name="meme-name" type="text" />
		</div>
		<div class="form-data">
			<input type="submit" class="btn" value="Качи картинка" name="submit" />
		</div>
	</form>
	
	<?php
		if ($this->isPost()) {
			$this->add();
		}
	?>
<?php endif; ?>

<?php foreach ($this->templates as $template) : ?>
	<div>
		<img title="<?= htmlspecialchars($template['name']) ?>" class="template-img"
			src="<?= $this->templatesPath . '/' . $template['file_name'] ?>"/>
	</div>
<?php endforeach ?>

<?php if ($this->isLoggedIn) :?>
	<script>
		function addPosition() {
			var parent = $("#positions");
			var positions = parent.find('.form-data');
			var newElement = $('<div class="form-data"></div>');
			var idx = positions.length;

			var textEl = $('<input class="custom-input" type="text" />')
				.css('display', 'inline')
				.css('width', '40%')
				.attr('name', 'texts[' + idx + ']')
				.attr('placeholder', 'Текст')[0];

			var xEl = $('<input class="custom-input" type="text" />')
				.css('display', 'inline')
				.css('width', '15%')
				.attr('name', 'xarray[' + idx + ']')
				.attr('placeholder', 'X')[0];

			var yEl = $('<input class="custom-input" type="text" />')
				.css('display', 'inline')
				.css('width', '15%')
				.attr('name', 'yarray[' + idx + ']')
				.attr('placeholder', 'Y')[0];

			var resultHtml = textEl.outerHTML + "\n" + xEl.outerHTML + "\n" + yEl.outerHTML + "\n";
			newElement.html(resultHtml);

			parent.append(newElement);
		}
	</script>
<?php endif; ?>