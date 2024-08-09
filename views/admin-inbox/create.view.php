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

 /* Style the suggestion box */
 #suggestions {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
        }
        #suggestions div {
            padding: 8px;
            cursor: pointer;
            background-color: #fff;
        }
        #suggestions div:hover {
            background-color: #e9e9e9;
        }

</style>

<div class="container-fluid d-flex flex-column align-items-center text-light">
    <h3 class="my-3 text-dark">New Message</h3>
    <form class="w-75" method="POST" action="/admin/sent" enctype="multipart/form-data">
        <!-- Added enctype -->

        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">To:</span>
            <input class="form-control" type="text" aria-describedby="inputGroup-sizing-sm" placeholder="Search Name" name="receiver_name" id="receiver_name" required>
		</div>
		<div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">From:</span>
            <input class="form-control" type="text" aria-describedby="inputGroup-sizing-sm" placeholder="Search Name" name="sender_name" id="sender_name" required>
		</div>
		<div class="sugesstions">
            <ul class="me-3 bg-light text-primary list-unstyled" id="email-suggestions" class="list-group" style="position: relative; z-index: 1000;"></ul>
        </div>
		
      
        <!-- @ User Suggestions Dropdown -->
        <ul id="mention-suggestions" class="list-group"></ul>

        <textarea id="message-body" name="body"  placeholder="write-message-here"></textarea>
        
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
<script>
	 
    const receiverEmailInput = document.getElementById('receiver_email');
    const emailSuggestions = document.getElementById('email-suggestions');

    function fetchUserSuggestions(query) {
        fetch('/admin/create?query=' + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                displaySuggestions(data);
            })
            .catch(error => {
                console.error('Error fetching user suggestions:', error);
            });
    }

    function displaySuggestions(users) {
        emailSuggestions.innerHTML = '';
        if (users.length > 0) {
            emailSuggestions.style.display = 'block';
            users.forEach(user => {
                const li = document.createElement('li');
                li.classList.add('list-group-item', 'list-group-item-action');
                li.textContent = `${user.email} (${user.username}, ${user.full_name})`;
                li.addEventListener('click', function() {
                    receiverEmailInput.value = user.email;
                    emailSuggestions.innerHTML = '';
                    emailSuggestions.style.display = 'none';
                });
                emailSuggestions.appendChild(li);
            });
        } else {
            emailSuggestions.style.display = 'none';
        }
    }

    receiverEmailInput.addEventListener('input', function() {
        const query = this.value.trim();
        if (query.length > 1) {
            fetchUserSuggestions(query);
        } else {
            emailSuggestions.innerHTML = '';
            emailSuggestions.style.display = 'none';
        }
    });

    document.addEventListener('click', function(event) {
        if (!emailSuggestions.contains(event.target) && event.target !== receiverEmailInput) {
            emailSuggestions.innerHTML = '';
            emailSuggestions.style.display = 'none';
        }
    });

</script>


<?php require base_path('views/partials/footer.php'); ?>