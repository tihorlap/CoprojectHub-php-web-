function ans() {
    let html = document.getElementById("html-code").value;
    let css = document.getElementById("css-code").value;
    let js = document.getElementById("js-code").value;
    let output = document.getElementById("output");

    output.contentDocument.body.innerHTML = html + "<style>" + css + "</style>"; // for HTML and CSS
    output.contentWindow.eval(js); // for JavaScript
}

// Function to save the project
function saveProject() {
    const projectName = document.getElementById('projectName').value;
    const htmlCode = document.getElementById('html-code').value;
    const cssCode = document.getElementById('css-code').value;
    const jsCode = document.getElementById('js-code').value;
    const messageDiv = document.getElementById('message'); // Select the message <div>

    // Create a JavaScript object to represent the project data
    const projectData = {
        projectName: projectName,
        html: htmlCode,
        css: cssCode,
        js: jsCode,
    };

    // Send the project data to the server for saving
    fetch('save_project.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(projectData), // Sending the projectData object as JSON
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Display success message
                messageDiv.innerHTML = '<div class="alert alert-success">Project saved successfully.</div>';
            } else {
                // Display error message
                messageDiv.innerHTML = '<div class="alert alert-danger">Error saving project: ' + data.message + '</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Display a generic error message
            messageDiv.innerHTML = '<div class="alert alert-danger">An error occurred while saving the project.</div>';
        });
}
