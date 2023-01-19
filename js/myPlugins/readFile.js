	let context = document.getElementById('content');
	document.getElementById('fileToUpload').addEventListener('change', function() {
		var files = this.files;
		if (files.length === 0) {
			console.log("No file is selected");
		}
		else{
			const file = files[0];
			var reader = new FileReader();
			reader.onload = function(event) {
				const file = event.target.result;
				const lines = file.split(/\r\n|\n/);
				context.value = lines.join('\n');
			};
			reader.onerror = (e) => alert(e.target.error.name);
			reader.readAsText(file);
		}
	});