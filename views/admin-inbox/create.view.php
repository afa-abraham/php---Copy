<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/sidebar.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400;1,700&display=swap');

@media print {
	body {
		margin: 0 !important;
	}
}

.main-container {
	font-family: 'Lato';
	width: fit-content;
	margin-left: auto;
	margin-right: auto;
}

.ck-content {
	font-family: 'Lato';
	line-height: 1.6;
	word-break: break-word;
    p {
        color: black;
    }
}

.editor-container_classic-editor .editor-container__editor {
	min-width: 795px;
	max-width: 795px;
}

</style>

<div class="container-fluid d-flex flex-column align-items-center text-light">
    <h3 class="my-3 text-dark">New Message</h3>
    <form class="w-75" method="POST" action="send_mail.php" enctype="multipart/form-data">
        <!-- Added enctype -->

        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">To:</span>
            <input class="form-control" type="text" aria-describedby="inputGroup-sizing-sm" placeholder="Search Name" name="receiver_email" id="receiver_email" required>
        </div>
        <div class="suggestions">
            <ul class="me-3 bg-light text-primary list-unstyled" id="email-suggestions" class="list-group" style="position: relative; z-index: 1000;"></ul>
        </div>

        <!-- @ User Suggestions Dropdown -->
        <ul id="mention-suggestions" class="list-group"></ul>

        <textarea id="message-body" name="body"  placeholder="write-message-here"></textarea>

        <input type="hidden" name="thread_id" value="">
        <label for="attachments" class="text-dark">Attachments:</label>
        <input class="form-control" type="file" name="attachments[]" id="attachments" multiple><br>
        <button class="btn btn-primary mb-3" type="submit">Send</button>
    </form>
</div>
<script type="importmap">
		{
			"imports": {
				"ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.js",
				"ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.0.0/"
			}
		}
		</script>


<script type="module">
    import {
	ClassicEditor,
	
	Autosave,
	Bold,
	Essentials,
	GeneralHtmlSupport,
	Italic,
	Paragraph,
	SelectAll,
	Undo
} from 'ckeditor5';

const editorConfig = {
	toolbar: {
		items: ['undo', 'redo', '|', 'selectAll', '|', 'bold', 'italic', '|'],
		shouldNotGroupWhenFull: false
	},
	plugins: [ Autosave, Bold, Essentials, GeneralHtmlSupport, Italic, Paragraph, SelectAll, Undo],
	htmlSupport: {
		allow: [
			{
				name: /^.*$/,
				styles: true,
				attributes: true,
				classes: true
			}
		]
	},

	placeholder: 'Type or paste your content here!'
};

ClassicEditor.create(document.querySelector('#message-body'), editorConfig);

</script>


<?php require base_path('views/partials/footer.php'); ?>